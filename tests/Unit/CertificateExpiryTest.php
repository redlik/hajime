<?php

namespace Tests\Unit;

use App\Support\CertificateExpiry;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class CertificateExpiryTest extends TestCase
{
    private function today(): Carbon
    {
        return Carbon::parse('2026-10-08 15:30:00');
    }

    public function test_missing_date_is_not_expired(): void
    {
        $this->assertFalse(CertificateExpiry::isExpired(null, $this->today()));
    }

    public function test_past_date_is_expired(): void
    {
        $this->assertTrue(CertificateExpiry::isExpired('2026-10-07', $this->today()));
    }

    public function test_expiry_today_is_still_valid(): void
    {
        $this->assertFalse(CertificateExpiry::isExpired('2026-10-08', $this->today()));
    }

    public function test_future_date_is_valid(): void
    {
        $this->assertFalse(CertificateExpiry::isExpired('2027-01-01', $this->today()));
    }

    public function test_expired_certificates_are_labelled(): void
    {
        $record = (object) [
            'safeguarding_expiry' => '2026-01-01',
            'vetting_expiry' => '2027-01-01',
            'first_aid_expiry' => '2025-06-30',
        ];

        $this->assertSame(
            ['Safeguarding', 'First Aid'],
            CertificateExpiry::expiredCertificates($record, $this->today())
        );
    }

    public function test_blank_required_certificates_are_reported_missing(): void
    {
        $record = (object) [
            'safeguarding_expiry' => null,
            'vetting_expiry' => '2027-01-01',
            'first_aid_expiry' => null,
        ];

        $this->assertSame(['Safeguarding'], CertificateExpiry::missingCertificates($record));
    }

    public function test_columns_a_record_does_not_have_are_not_missing(): void
    {
        $record = (object) ['safeguarding_expiry' => '2027-01-01', 'vetting_expiry' => '2027-01-01'];

        $this->assertSame([], CertificateExpiry::missingCertificates($record));
    }
}
