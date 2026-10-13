<?php

namespace Tests\Feature;

use App\Models\Club;
use App\Models\Member;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MembershipProcessedAtTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole(Role::findOrCreate('admin'));

        return $user;
    }

    private function payload(Member $member, array $extra = []): array
    {
        return array_merge([
            'member_id' => $member->id,
            'membership_type' => 'Over 18 – Adult Membership',
            'join_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
        ], $extra);
    }

    public function test_new_membership_is_stamped_and_ignores_submitted_value(): void
    {
        $member = Member::factory()->for(Club::factory())->create();

        $this->actingAs($this->admin())
            ->post(route('membership.store'), $this->payload($member, ['processed_at' => '2000-01-01 00:00:00']));

        $membership = Membership::firstOrFail();
        $this->assertTrue($membership->processed_at->isToday());
        $this->assertSame('2026-01-01', substr($membership->join_date, 0, 10));
    }

    public function test_later_edits_do_not_change_timestamp(): void
    {
        $member = Member::factory()->for(Club::factory())->create();
        $membership = Membership::create($this->payload($member) + ['processed_at' => '2026-02-02 10:00:00']);

        $membership->update(['membership_type' => 'Student Membership']);

        $this->assertSame('2026-02-02 10:00:00', $membership->fresh()->processed_at->format('Y-m-d H:i:s'));
    }
}
