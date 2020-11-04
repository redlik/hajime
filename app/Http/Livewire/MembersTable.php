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
        $this->members = Member::paginate(50);
    }
    
    public function render()
    {
        $members = Member::when($this->searchQuery != '', function($query) {
            $query->where('first_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('last_name', 'like', '%'.$this->searchQuery.'%');
        })
        ->orderBy('last_name', 'asc')
        ->paginate(50);
        
        return view('livewire.members-table', ['members' => $members ]);
    }
}
