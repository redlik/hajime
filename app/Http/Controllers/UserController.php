<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function deactivateUser(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'deactivated'
        ]);

        \Session::flash('message', 'User account deactivated');

        return redirect()->back();
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        \Session::flash('message', 'User account deleted');

        return redirect()->back();
    }

    public function settings()
    {
        $user = Auth::user();

        return view('user.settings', compact('user'));
    }
}
