<?php

namespace App\Livewire;

use Livewire\Component;

class GradeModal extends Component
{
    public $grade_id;

    public function render()
    {
        return view('livewire.grade-modal');
    }
}
