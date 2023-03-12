<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function activateAccount(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'active'
        ]);
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
}
