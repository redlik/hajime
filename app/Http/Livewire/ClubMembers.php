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
    public $searchQuery = '';

    // public function mount($club_id) {
    //     $this->club_id = $club_id;
    // }

    public function render()
    {
        $members = Member::where('club_id',$this->club_id)->paginate(10);
        return view('livewire.club-members', compact('members'));
    }
}
