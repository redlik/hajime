<?php

namespace Tests\Feature;

use App\Livewire\GradeList;
use App\Models\Club;
use App\Models\Grade;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GradeClubTest extends TestCase
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
        return $extra + [
            'member_id' => $member->id,
            'grade_level' => '1st Dan',
            'grade_date' => '2026-05-01',
        ];
    }

    public function test_new_grade_stores_selected_club(): void
    {
        $club = Club::factory()->create();
        $member = Member::factory()->for(Club::factory())->create();

        $this->actingAs($this->admin())->post(route('grade.store'), $this->payload($member, ['club_id' => $club->id]));

        $this->assertSame($club->id, Grade::firstOrFail()->club_id);
    }

    public function test_new_grade_with_blank_club_saves_without_club(): void
    {
        $member = Member::factory()->for(Club::factory())->create();

        $this->actingAs($this->admin())->post(route('grade.store'), $this->payload($member, ['club_id' => '']));

        $this->assertNull(Grade::firstOrFail()->club_id);
    }

    public function test_unknown_club_is_rejected(): void
    {
        $member = Member::factory()->for(Club::factory())->create();

        $this->actingAs($this->admin())->post(route('grade.store'), $this->payload($member, ['club_id' => 9999]))
            ->assertSessionHasErrors('club_id');

        $this->assertDatabaseCount('grades', 0);
    }

    public function test_grade_list_shows_club_and_blank_for_existing_rows(): void
    {
        $member = Member::factory()->for(Club::factory())->create();
        $club = Club::factory()->create(['name' => 'Galway City School of Judo']);
        Grade::create($this->payload($member, ['club_id' => $club->id]));
        Grade::create($this->payload($member, ['grade_level' => '2nd Dan', 'grade_date' => '2025-05-01']));

        Livewire::actingAs($this->admin())
            ->test(GradeList::class, ['member' => $member->id])
            ->assertSee('Galway City School of Judo')
            ->assertSee('—');
    }

    public function test_edit_changes_and_clears_club_and_lists_all_clubs_alphabetically(): void
    {
        $member = Member::factory()->for(Club::factory(['name' => 'Zeta']))->create();
        $closed = Club::factory()->create(['name' => 'Alpha', 'status' => 'Closed']);
        $grade = Grade::create($this->payload($member));

        $component = Livewire::actingAs($this->admin())
            ->test(GradeList::class, ['member' => $member->id])
            ->call('editModal', $grade->id);

        $html = $component->html();
        $this->assertNotFalse(strpos($html, 'Alpha (Closed)'));
        $this->assertLessThan(strpos($html, 'Zeta'), strpos($html, 'Alpha (Closed)'));

        $component->set('club_id', $closed->id)->call('updateGrade');
        $this->assertSame($closed->id, $grade->fresh()->club_id);

        Livewire::actingAs($this->admin())
            ->test(GradeList::class, ['member' => $member->id])
            ->call('editModal', $grade->id)
            ->set('club_id', '')
            ->call('updateGrade');
        $this->assertNull($grade->fresh()->club_id);
    }
}
