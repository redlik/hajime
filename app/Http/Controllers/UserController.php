<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivated;
use App\Mail\UserInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function activateAccount(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'active'
        ]);

        Mail::to($user)->send(new AccountActivated($user));

        \Session::flash('message', 'User account activated');

        return redirect()->back();
    }

    public function userActivationLink($user_id)
    {
        $user = User::find($user_id);
        if ($user->status == 'active') {
            abort(403, 'Account is already activated');
        }

        return view('club-access.registration', compact('user'));
    }

    public function userActivatedAccount(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

        $user = User::find($request->input('id'));

        $user->update([
           'name' => $request->input('name'),
           'password' => Hash::make($request->input('password')),
            'status' => 'active',
        ]);

        return view('home')->with('activated', 'Congratulations, your account has been activated.');
    }

    public function deactivateUser(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'deactivated'
        ]);

        \Session::flash('message', 'User account deactivated');

        return redirect()->back();
    }

    public function inviteUser(Request $request)
    {
        if (User::whereEmail($request->input('email'))->first()) {
            abort(403, "User with this email already exists");
        }
        $user = User::create(
            [
                'name' => 'Invite Pending',
                'email' => $request->input('email'),
                'club_id' => $request->input('club'),
                'password' => Hash::make(Str::uuid()->toString()),
            ]
        );

        $user->assignRole('manager');

        Mail::to($user)->send(new UserInvitation($user));

        return redirect()->back()->with('invited', "Account invitation has been sent");
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        \Session::flash('message', 'User account deleted');

        return redirect()->back();
    }
}
