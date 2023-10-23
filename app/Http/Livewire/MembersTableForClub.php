<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class MembersTableForClub extends Component
{
    use WithPagination;

    public $club_id;
    public $searchQuery = '';
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
        $members = Member::where('club_id', $this->club_id)
        ->when($this->searchQuery != '', function ($query) {
            $query->where('club_id', $this->club_id)
                ->where(function ($query) {
                    $query->where('first_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('number', $this->searchQuery);
                });
        })
            ->orderBy('active', 'desc')
            ->paginate(25);

        return view('livewire.members-table-for-club', compact('members'));
    }
}
