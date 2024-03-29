<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Member;

class MembersTable extends Component
{
    use WithPagination;
    public $searchQuery;

    public function mount() {
        $searchQuery = '';
//        $this->members = Member::simplePaginate(50);
    }

    public function updatingSearchquery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = Member::when($this->searchQuery != '', function($query) {
            $query->where('first_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('last_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('number', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('eircode', 'like', '%'.$this->searchQuery.'%');
        })
        ->orderBy('last_name', 'asc')
        ->simplePaginate(50);

        return view('livewire.members-table', ['members' => $members ]);
    }
}
