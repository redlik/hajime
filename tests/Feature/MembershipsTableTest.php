<?php

namespace Tests\Feature;

use App\Livewire\MembershipsTable;
use App\Models\Club;
use App\Models\Member;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MembershipsTableTest extends TestCase
{
    use RefreshDatabase;

    private function membership(Member $member, string $expiry, array $extra = []): Membership
    {
        return Membership::create([
            'member_id' => $member->id,
            'membership_type' => 'Student Membership',
            'join_date' => '2026-01-01',
            'expiry_date' => $expiry,
        ] + $extra);
    }

    public function test_lists_only_this_members_memberships(): void
    {
        $club = Club::factory()->create();
        $member = Member::factory()->for($club)->create();
        $other = Member::factory()->for($club)->create();
        $mine = $this->membership($member, '2027-01-01', ['processed_at' => '2026-02-02 10:00:00']);
        $theirs = $this->membership($other, '2027-06-01');

        Livewire::actingAs(User::factory()->create())
            ->test(MembershipsTable::class, ['member_id' => $member->id])
            ->assertCanSeeTableRecords([$mine])
            ->assertCanNotSeeTableRecords([$theirs])
            ->assertSee('02/02/2026 10:00');
    }

    public function test_delete_action_removes_record_and_deactivates_member(): void
    {
        $member = Member::factory()->for(Club::factory())->create(['active' => 1]);
        $membership = $this->membership($member, '2027-01-01');

        Livewire::actingAs(User::factory()->create())
            ->test(MembershipsTable::class, ['member_id' => $member->id])
            ->callTableAction('delete', $membership);

        $this->assertModelMissing($membership);
        $this->assertEquals(0, $member->fresh()->active);
    }

    public function test_all_columns_are_sortable(): void
    {
        $member = Member::factory()->for(Club::factory())->create();
        $a = $this->membership($member, '2027-01-01', ['processed_at' => '2026-01-01 09:00:00']);
        $b = $this->membership($member, '2028-01-01', ['processed_at' => '2026-03-01 09:00:00']);

        foreach (['membership_type', 'join_date', 'expiry_date', 'processed_at'] as $column) {
            Livewire::actingAs(User::factory()->create())
                ->test(MembershipsTable::class, ['member_id' => $member->id])
                ->sortTable($column)
                ->assertCanSeeTableRecords([$a, $b]);
        }

        Livewire::actingAs(User::factory()->create())
            ->test(MembershipsTable::class, ['member_id' => $member->id])
            ->sortTable('processed_at', 'desc')
            ->assertCanSeeTableRecords([$b, $a], inOrder: true);
    }
}
