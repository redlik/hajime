<?php

namespace Tests\Unit;

use App\Support\ExpiryEmailSettings;
use PHPUnit\Framework\TestCase;

class ExpiryEmailSettingsTest extends TestCase
{
    public function test_placeholders_are_replaced(): void
    {
        $out = ExpiryEmailSettings::render(ExpiryEmailSettings::DEFAULT_BODY, [
            'name' => 'Jane Doe',
            'certificate' => 'Vetting',
            'expiry_date' => '01/10/2026',
            'club' => 'Test Judo Club',
        ]);

        $this->assertStringContainsString('Dear Jane Doe', $out);
        $this->assertStringContainsString('Vetting certificate (Test Judo Club) expired on 01/10/2026', $out);
        $this->assertStringNotContainsString('{', $out);
    }
}
