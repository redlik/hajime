<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMembershipConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $membership;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($member, $membership)
    {
        //
        $this->member = $member;
        $this->membership = $membership;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New membership confirmation')
            ->markdown('email.membership.confirmation-email');
    }
}
