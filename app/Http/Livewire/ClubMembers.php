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
    public $active = 1;
    public $sortby = 'last_name';

    public function mount($club_id)
    {
        $this->club_id = $club_id;
        $this->searchQuery = '';
    }

    public function updatingSearchquery()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->active) {
            $query = Member::when($this->searchQuery != '', function ($query) {
                $query->where('active', $this->active)
                    ->where('first_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('number', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('eircode', 'like', '%' . $this->searchQuery . '%');
            })->where('active', $this->active)
                ->where('club_id', $this->club_id)
                ->orderBy($this->sortby, 'asc')
                ->paginate(15);
        } else {
            $query = Member::when($this->searchQuery != '', function ($query) {
                $query->where('first_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('number', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('eircode', 'like', '%' . $this->searchQuery . '%');
            })->where('club_id', $this->club_id)
                ->orderBy($this->sortby, 'asc')
                ->paginate(15);
        }

        $members = $query;
        return view('livewire.club-members', compact('members'));
    }
}
