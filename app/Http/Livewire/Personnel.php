<?php

namespace App\Http\Livewire;

use App\Models\Club;
use Livewire\Component;

class Personnel extends Component
{
    public $club_id;

    public function render()
    {
        return view('livewire.personnel');
    }
}
