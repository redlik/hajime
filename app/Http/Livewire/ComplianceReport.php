<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Coach;
use App\Models\Personnel;
use App\Models\Volunteer;
use Livewire\Component;
use function PHPUnit\Framework\isNull;

class ComplianceReport extends Component
{
    public $clubs;

    public $selected = '';

    public Personnel $secretary;

    public Personnel $headCoach;

    public Personnel $designated;

    public Personnel $childrens;

    public Club $selectedClub;

    public $coaches;

    public $volunteers;

    public $report = false;

    protected $rules = [
        'selected' => 'required',
        ];

    public function mount()
    {
        $this->report = false;
    }

    public function render()
    {
        ray($this->report);
        return view('livewire.compliance-report');
    }

    public function generateReport($selected)
    {
        $this->report = true;
        $this->selectedClub = Club::find($selected);
        if(!empty(Personnel::secretary()->where('club_id', $this->selectedClub->id)->first())){
            $this->secretary = Personnel::secretary()->where('club_id', $this->selectedClub->id)->first();
            ray($this->secretary);
        }
        if(!empty(Personnel::headcoach()->where('club_id', $this->selectedClub->id)->first())) {
            $this->headCoach = Personnel::headcoach()->where('club_id', $this->selectedClub->id)->first();
        }
        if(!empty(Personnel::designatedofficer()->where('club_id', $this->selectedClub->id)->first())){
            $this->designated = Personnel::designatedofficer()->where('club_id', $this->selectedClub->id)->first();
        }
        if(!empty(Personnel::childrenofficer()->where('club_id', $this->selectedClub->id)->first())){
            $this->childrens = Personnel::childrenofficer()->where('club_id', $this->selectedClub->id)->first();
        }

        $this->coaches = Coach::where('club_id', $this->selectedClub->id)->get();
        $this->volunteers = Volunteer::where('club_id', $this->selectedClub->id)->get();

    }
}
