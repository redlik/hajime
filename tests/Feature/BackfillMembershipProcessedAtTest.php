<?php

namespace Tests\Feature;

use App\Models\Club;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackfillMembershipProcessedAtTest extends TestCase
{
    use RefreshDatabase;

    private function membership(Member $member, ?string $processedAt, string $createdAt): Membership
    {
        $m = Membership::create([
            'member_id' => $member->id,
            'membership_type' => 'Student Membership',
            'join_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'processed_at' => $processedAt,
        ]);
        $m->forceFill(['created_at' => $createdAt])->saveQuietly();

        return $m;
    }

    public function test_copies_created_at_only_where_blank(): void
    {
        $member = Member::factory()->for(Club::factory())->create();
        $blank = $this->membership($member, null, '2025-05-05 08:00:00');
        $filled = $this->membership($member, '2026-02-02 10:00:00', '2025-06-06 09:00:00');

        $this->artisan('memberships:backfill-processed-at')->expectsOutput('Updated 1 membership(s).')->assertSuccessful();

        $this->assertSame('2025-05-05 08:00:00', $blank->fresh()->processed_at->format('Y-m-d H:i:s'));
        $this->assertSame('2026-02-02 10:00:00', $filled->fresh()->processed_at->format('Y-m-d H:i:s'));
    }

    public function test_dry_run_changes_nothing(): void
    {
        $member = Member::factory()->for(Club::factory())->create();
        $blank = $this->membership($member, null, '2025-05-05 08:00:00');

        $this->artisan('memberships:backfill-processed-at --dry-run')->expectsOutput('1 membership(s) would be updated.')->assertSuccessful();

        $this->assertNull($blank->fresh()->processed_at);
    }
}
