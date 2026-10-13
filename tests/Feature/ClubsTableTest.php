<?php

namespace Tests\Feature;

use App\Livewire\ClubsTable;
use App\Models\Club;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ClubsTableTest extends TestCase
{
    use RefreshDatabase;

    public function testClubsTableRendersComplianceColumnAndPillows()
    {
        $clubMissing = Club::create([
            'name' => 'Test Club Missing',
            'status' => 'Active',
            'city' => 'Dublin',
            'county' => 'Dublin',
            'province' => 'Leinster',
            'type' => 'Full',
            'address1' => '123 Main St',
        ]);

        $clubCompliant = Club::create([
            'name' => 'Test Club Compliant',
            'status' => 'Active',
            'city' => 'Dublin',
            'county' => 'Dublin',
            'province' => 'Leinster',
            'type' => 'Full',
            'address1' => '456 Main St',
        ]);
        Personnel::create([
            'club_id' => $clubCompliant->id,
            'name' => 'John Doe',
            'role' => 'Secretary',
            'vetting_expiry' => now()->addYear(),
            'safeguarding_expiry' => now()->addYear(),
        ]);

        $clubExpired = Club::create([
            'name' => 'Test Club Expired',
            'status' => 'Inactive',
            'city' => 'Dublin',
            'county' => 'Dublin',
            'province' => 'Leinster',
            'type' => 'Full',
            'address1' => '789 Main St',
        ]);
        Personnel::create([
            'club_id' => $clubExpired->id,
            'name' => 'Jane Doe',
            'role' => 'Secretary',
            'vetting_expiry' => now()->subDay(),
            'safeguarding_expiry' => now()->addYear(),
        ]);

        Livewire::test(ClubsTable::class)
            ->assertSee('Club Compliance')
            ->assertSeeHtml('<span class="orange-pillow">Missing data</span>')
            ->assertSeeHtml('<span class="green-pillow">YES</span>')
            ->assertSeeHtml('<span class="red-pillow">NO</span>');
    }
}
