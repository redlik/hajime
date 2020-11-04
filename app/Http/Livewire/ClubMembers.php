<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ClubMembers extends Component
{
    use WithPagination;
    
    public $club_id;

    // public function mount($club_id) {
    //     $this->club_id = $club_id;
    // }

    public function render()
    {
        $members = Club::find($this->club_id)->member;
        return view('livewire.club-members', compact('members'));
    }
}
