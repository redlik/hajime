<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;

class GradeList extends Component
{
    public $grades;

    public Grade $grade;

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
        $this->showModal = true;
    }
}
