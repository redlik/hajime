<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Club;

class ClubsTable extends Component
{

    use WithPagination;

    public $searchQuery;

    public function mount() {
        $this->searchQuery = '';
    }

    public function updatingSearchquery()
    {
        $this->resetPage();
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
