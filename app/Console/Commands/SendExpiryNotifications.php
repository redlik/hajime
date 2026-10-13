<?php

namespace App\Console\Commands;

use App\Mail\CertificateExpiredMail;
use App\Models\Coach;
use App\Models\ExpiryNotificationLog;
use App\Models\Personnel;
use App\Models\Volunteer;
use App\Support\CertificateExpiry;
use App\Support\ExpiryEmailSettings;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendExpiryNotifications extends Command
{
    protected $signature = 'app:send-expiry-notifications {--dry-run : List what would be sent without sending or logging}';

    protected $description = 'Email people whose Safeguarding, Vetting or First Aid certificate has expired';

    /**
     * Only certificates that expired within this many days are notified, so
     * switching the feature on does not email the whole historical backlog.
     */
    private const WINDOW_DAYS = 7;

    public function handle()
    {
        if (! ExpiryEmailSettings::enabled()) {
            $this->info('Expiry emails are disabled in Settings > Options. Nothing sent.');

            return Command::SUCCESS;
        }

        $dryRun = (bool) $this->option('dry-run');
        $today = Carbon::today();
        $earliest = $today->copy()->subDays(self::WINDOW_DAYS);
        $counts = ['sent' => 0, 'skipped' => 0, 'failed' => 0];

        $sources = [
            'personnel' => Personnel::class,
            'coach' => Coach::class,
            'volunteer' => Volunteer::class,
        ];

        foreach ($sources as $type => $model) {
            $model::with('club')->whereNotNull('club_id')->chunkById(200, function ($people) use ($type, $today, $earliest, $dryRun, &$counts) {
                foreach ($people as $person) {
                    foreach (CertificateExpiry::CERTIFICATES as $key => $label) {
                        $expiry = $person->getAttribute($key.'_expiry');

                        // Expired (valid through the expiry date), within the window, not renewed.
                        if (! CertificateExpiry::isExpired($expiry, $today)
                            || Carbon::parse($expiry)->startOfDay()->lt($earliest)) {
                            continue;
                        }

                        $this->notify($type, $person, $key, $label, Carbon::parse($expiry), $dryRun, $counts);
                    }
                }
            });
        }

        $this->info(sprintf(
            '%s sent: %d, skipped (no email): %d, failed: %d',
            $dryRun ? '[dry run]' : 'Done.',
            $counts['sent'],
            $counts['skipped'],
            $counts['failed']
        ));

        return Command::SUCCESS;
    }

    private function notify($type, $person, $key, $label, Carbon $expiry, bool $dryRun, array &$counts): void
    {
        $keys = [
            'person_type' => $type,
            'person_id' => $person->id,
            'certificate' => $key,
            'expiry_date' => $expiry->toDateString(),
        ];

        // Never send twice for the same expiry event.
        if (ExpiryNotificationLog::where($keys)->where('status', 'sent')->exists()) {
            return;
        }

        $recipient = trim((string) $person->email);
        $details = [
            'club_id' => $person->club_id,
            'person_name' => $person->name,
            'recipient' => $recipient ?: null,
        ];

        if ($recipient === '' || ! filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $counts['skipped']++;
            if (! $dryRun) {
                ExpiryNotificationLog::updateOrCreate($keys, $details + ['status' => 'skipped_no_email']);
            }

            return;
        }

        if ($dryRun) {
            $this->line("Would email {$recipient}: {$label} expired {$expiry->format('d/m/Y')}");
            $counts['sent']++;

            return;
        }

        try {
            Mail::to($recipient)->send(new CertificateExpiredMail($key, [
                'name' => $person->name,
                'certificate' => $label,
                'expiry_date' => $expiry->format('d/m/Y'),
                'club' => optional($person->club)->name ?? '',
            ]));

            ExpiryNotificationLog::updateOrCreate($keys, $details + [
                'status' => 'sent',
                'error' => null,
                'sent_at' => now(),
            ]);
            $counts['sent']++;
        } catch (Throwable $e) {
            ExpiryNotificationLog::updateOrCreate($keys, $details + [
                'status' => 'failed',
                'error' => $e->getMessage(),
            ]);
            $counts['failed']++;
        }
    }
}
