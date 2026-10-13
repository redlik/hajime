<?php

namespace App\Livewire;

use App\Models\Club;
use App\Models\Grade;
use Livewire\Component;

class GradeList extends Component
{
    public $grades;

    public Grade $grade;

    public $grade_level = '';
    public $grade_date;
    public $grade_points = '';
    public $competition = '';
    public $club_id = '';

    public $showModal = false;

    public $member;

    public function render()
    {
        $this->grades = Grade::where('member_id', $this->member)->orderBy('grade_date', 'desc')->get();
        $clubs = Club::orderBy('name')->get(['id', 'name', 'status']);
        return view('livewire.grade-list', compact('clubs'));
    }

    public function editModal($grade)
    {
        $this->grade = Grade::find($grade);
        $this->competition = $this->grade->competition;
        $this->grade_level = $this->grade->grade_level;
        $this->grade_date = $this->grade->grade_date;
        $this->grade_points = $this->grade->grade_points;
        $this->club_id = $this->grade->club_id ?? '';
        $this->showModal = true;
    }

    public function updateGrade()
    {
        $this->validate(['club_id' => 'nullable|exists:clubs,id']);

        $this->grade->update([
            'grade_level' => $this->grade_level,
            'grade_date' => $this->grade_date,
            'grade_points' => $this->grade_points,
            'competition' => $this->competition,
            'club_id' => $this->club_id ?: null,
        ]);
        $this->showModal = false;
    }
}
