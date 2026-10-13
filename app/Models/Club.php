<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\CertificateExpiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Club extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function personnel()
    {
        return $this->hasMany('App\Models\Personnel');
    }

    public function member() {
        return $this->hasMany('App\Models\Member');
    }

    public function activeMembersCount()
    {
        return $this->member->where('active', 1)->count();
    }

    public function getProvinceAttribute($value)
    {
        return ucwords($value);
    }

    public function manager()
    {
        return $this->hasMany(User::class);
    }

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }

    public function volunteer()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function coach()
    {
        return $this->hasMany(Coach::class);
    }

    /**
     * Linked people (personnel, coaches, volunteers) as [type => records].
     */
    private function linkedPeople(): array
    {
        return [
            'Personnel' => $this->personnel,
            'Coach' => $this->coach,
            'Volunteer' => $this->volunteer,
        ];
    }

    /**
     * Certificate problems for a check, as
     * [['person' => name, 'role' => role, 'certificate' => label], ...].
     */
    private function certificateIssues(callable $check): array
    {
        $issues = [];

        foreach ($this->linkedPeople() as $type => $records) {
            foreach ($records as $record) {
                foreach ($check($record) as $certificate) {
                    $issues[] = [
                        'person' => $record->name,
                        'role' => $record->role ?? $type,
                        'certificate' => $certificate,
                    ];
                }
            }
        }

        return $issues;
    }

    public function hasNoLinkedPeople(): bool
    {
        return collect($this->linkedPeople())->every(fn ($records) => $records->isEmpty());
    }

    public function expiredCertificates(): array
    {
        return $this->certificateIssues([CertificateExpiry::class, 'expiredCertificates']);
    }

    public function missingCertificates(): array
    {
        return $this->certificateIssues([CertificateExpiry::class, 'missingCertificates']);
    }

    /**
     * 'no' when any certificate has expired, 'missing' when none has expired
     * but a required expiry date is blank or nobody is linked to the club,
     * otherwise 'yes'.
     */
    public function complianceStatus(): string
    {
        if (count($this->expiredCertificates()) > 0) {
            return 'no';
        }

        return $this->hasNoLinkedPeople() || count($this->missingCertificates()) > 0 ? 'missing' : 'yes';
    }

    public function isCompliant(): bool
    {
        return $this->complianceStatus() === 'yes';
    }

    /**
     * Recalculate from current data and persist to the `compliant` column.
     */
    public function recalculateCompliance(): bool
    {
        $this->load(['personnel', 'coach', 'volunteer']);
        $compliant = $this->isCompliant();

        if ((bool) $this->compliant !== $compliant) {
            $wasCompliant = (bool) $this->compliant;
            $this->forceFill(['compliant' => $compliant])->saveQuietly();

            if ($wasCompliant && ! $compliant) {
                $this->logComplianceDeactivated();
            }
        }

        return $compliant;
    }

    /**
     * Audit entry (Spatie Activitylog) each time the club stops being compliant.
     * The causer is the logged-in user, or empty when the nightly job did it.
     */
    private function logComplianceDeactivated(): void
    {
        activity()
            ->performedOn($this)
            ->causedBy(Auth::id())
            ->withProperties([
                'name' => $this->name,
                'status' => $this->complianceStatus(),
                'expired' => $this->expiredCertificates(),
                'missing' => $this->missingCertificates(),
                'no_people' => $this->hasNoLinkedPeople(),
            ])
            ->log('Club compliance deactivated');
    }
}
