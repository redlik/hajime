<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserView extends Component
{

    public $searchQuery;


    public function render()
    {
        $users = User::whereHas('club_manager')
            ->when($this->searchQuery != '', function($query) {
                $query
                    ->where('name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhereHas('club_manager', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchQuery . '%');
                    });
            })
            ->orderBy('club_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->with('club_manager')
            ->paginate(25);

        return view('livewire.user-view', compact('users'));
    }
}
