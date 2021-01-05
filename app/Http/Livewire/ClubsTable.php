<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Club;
USE App\Models\Member;

class ClubsTable extends Component
{

    use WithPagination;

    public $searchQuery;

    public function mount() {
        $this->searchQuery = '';
    }

    public function render()
    {
        $clubs = Club::when($this->searchQuery != '', function($query) {
            $query->where('name', 'like', '%'.$this->searchQuery.'%');
        })
        ->orderBy('name', 'asc')
        ->paginate(25);


        return view('livewire.clubs-table', [
            'clubs' => $clubs,
        ]);
    }
}
