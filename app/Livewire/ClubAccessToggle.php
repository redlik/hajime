<?php

namespace App\Livewire;

use App\Models\Options;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ClubAccessToggle extends Component
{
    public Options $clubAccess;

    public $status = '';

    public function mount()
    {
        if(!Options::where('option_name','club_access')->first()){
            $this->clubAccess = Options::create([
                'option_name' => 'club_access',
                'option_value' => 'enabled',
            ]);
        } else {
            $this->clubAccess = Options::where('option_name','club_access')->first();
        }

        Cache::put('club_access', $this->clubAccess->option_value);
        $this->status = Cache::get('club_access');

    }

    public function render()
    {
        return view('livewire.club-access-toggle');
    }

    public function toggleClubAccess()
    {
        if($this->status == 'enabled') {
            $this->status = 'disabled';
            Cache::put('club_access', $this->status);
            $this->clubAccess->update([
                'option_value' => $this->status,]);
        } else {
            $this->status = 'enabled';
            Cache::put('club_access', $this->status);
            $this->clubAccess->update([
                'option_value' => $this->status,]);
        }
    }
}
