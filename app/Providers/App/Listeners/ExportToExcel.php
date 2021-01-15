<?php

namespace App\Providers\App\Listeners;

use App\Providers\App\Events\NewMembershipEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExportToExcel
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewMembershipEvent  $event
     * @return void
     */
    public function handle(NewMembershipEvent $event)
    {
        //
    }
}
