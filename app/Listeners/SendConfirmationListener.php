<?php

namespace App\Listeners;

use App\Events\NewMembershipEvent;
use App\Mail\SendMembershipConfirmation;
use App\Models\Member;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationListener
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
        $member = Member::where('id', $event->membership->member->id)->first();
        $membership = $event->membership;
        Mail::to($event->membership->member->email)->send(new SendMembershipConfirmation($member, $membership));
    }
}
