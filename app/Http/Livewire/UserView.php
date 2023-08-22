<?php

namespace App\Http\Livewire;

use App\Mail\EmailVerificationGranted;
use App\Mail\EmailVerificationRejected;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class UserView extends Component
{

    public $searchQuery;

    public $status;

    public $email_status;

    public function grantAccess(User $user)
    {
        $user->update([
            'email_request_status' => 'granted'
        ]);

        Mail::to($user->email)->send(new EmailVerificationGranted($user));

        session()->flash('email_status', 'Permission to use email authentication granted');
    }

    public function rejectAccess(User $user)
    {
        $user->update([
            'email_request_status' => 'rejected'
        ]);

        Mail::to($user->email)->send(new EmailVerificationRejected($user));

        session()->flash('email_status_rejected', 'Permission to use email authentication rejected');
    }

    public function clear()
    {
        $this->searchQuery = '';
    }


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
            ->when($this->status != '', function($s){
                $s->where('status', $this->status);
            })
            ->when($this->email_status != '', function($s){
                $s->where('email_request_status', $this->email_status);
            })
            ->orderBy('club_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->with('club_manager')
            ->paginate(25);

        return view('livewire.user-view', compact('users'));
    }
}
