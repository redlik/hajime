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
        $this->searchQuery = '';
        $this->members = Member::paginate(25);
    }
    
    public function render()
    {
        $members = Member::when($this->searchQuery != '', function($query) {
            $query->where('name', 'like', '%'.$this->searchQuery.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(25);
        
        return view('livewire.members-table', ['members' => $members ]);
    }
}
