<?php

namespace App\Livewire;

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

    public $showModal = false;

    public $member;

    public function render()
    {
        $this->grades = Grade::where('member_id', $this->member)->orderBy('grade_date', 'desc')->get();
        return view('livewire.grade-list');
    }

    public function editModal($grade)
    {
        $this->grade = Grade::find($grade);
        $this->competition = $this->grade->competition;
        $this->grade_level = $this->grade->grade_level;
        $this->grade_date = $this->grade->grade_date;
        $this->grade_points = $this->grade->grade_points;
        $this->showModal = true;
    }

    public function updateGrade()
    {
        ray($this->grade);
        $this->grade->update([
            'grade_level' => $this->grade_level,
            'grade_date' => $this->grade_date,
            'grade_points' => $this->grade_points,
            'competition' => $this->competition,
        ]);
        $this->showModal = false;
    }
}
