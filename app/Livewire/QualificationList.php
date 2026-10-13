<?php

namespace App\Livewire;

use App\Models\Qualification;
use Livewire\Component;

class QualificationList extends Component
{
    public $qualifications;

    public Qualification $qualification;

    public $level = '';
    public $date_attained;
    public $notes = '';

    public $showModal = false;

    public $member;
    public $type;

    public function render()
    {
        $this->qualifications = Qualification::where('member_id', $this->member)
            ->where('type', $this->type)
            ->orderBy('date_attained', 'desc')
            ->get();

        return view('livewire.qualification-list');
    }

    public function editModal($qualification)
    {
        $this->qualification = Qualification::find($qualification);
        $this->level = $this->qualification->level;
        $this->date_attained = $this->qualification->date_attained;
        $this->notes = $this->qualification->notes;
        $this->showModal = true;
    }

    public function updateQualification()
    {
        $this->qualification->update([
            'level' => $this->level,
            'date_attained' => $this->date_attained,
            'notes' => $this->notes,
        ]);
        $this->showModal = false;
    }
}
