<?php

namespace App\Livewire;

use App\Models\Club;
use App\Models\Coach;
use App\Models\Personnel;
use App\Models\Volunteer;
use Livewire\Component;
use function PHPUnit\Framework\isNull;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return view('livewire.compliance-report');
    }

    public function generateReport($selected)
    {
        $this->report = true;
        $this->selectedClub = Club::find($selected);

        $this->secretary = Personnel::secretary()->where('club_id', $this->selectedClub->id)->first() ?? new Personnel();
        $this->headCoach = Personnel::headcoach()->where('club_id', $this->selectedClub->id)->first() ?? new Personnel();
        $this->designated = Personnel::designatedofficer()->where('club_id', $this->selectedClub->id)->first() ?? new Personnel();
        $this->childrens = Personnel::childrenofficer()->where('club_id', $this->selectedClub->id)->first() ?? new Personnel();

        $this->coaches = Coach::where('club_id', $this->selectedClub->id)->get();
        $this->volunteers = Volunteer::where('club_id', $this->selectedClub->id)->get();

    }
}
