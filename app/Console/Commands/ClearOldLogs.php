<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class ClearOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-old-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = Cache::get('retentionLogTime');
        if (!$days) {
            Log::info('Retention day not defined');
            return;
        }
        $deletedCount = Activity::where('created_at', '<', now()->subDays($days))->delete();
        Log::info("Deleted {$deletedCount} activity log(s) older than {$days} days.");
    }
}
