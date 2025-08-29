<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class RetentionLog extends Component
{
    public $retentionLogTime;

    public function mount()
    {
        if (!Cache::has('retentionLogTime')) {
            Cache::put('retentionLogTime', 90, now()->addDays(60));
            $this->retentionLogTime = 90;
        } else {
            $this->retentionLogTime = Cache::get('retentionLogTime');
        }
    }
    public function render()
    {
        return view('livewire.retention-log');
    }

    public function update()
    {
        Cache::put('retentionLogTime', $this->retentionLogTime, now()->addDays(60));
    }
}
