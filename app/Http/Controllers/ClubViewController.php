<?php

namespace App\Http\Controllers;

use App\Helpers\SpatieRoleCheck;
use App\Http\Requests\ClubManagerRequest;
use App\Mail\AccountActivated;
use App\Mail\AccountSubmitted;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ClubViewController extends Controller
{
    use SpatieRoleCheck;
    public function register()
    {
        if ($this->checkIfRoleDoesntExists('manager')) {
            $role= Role::create([
                'name'=> 'manager'
            ]);
        }
        $clubs= Club::orderBy('name', 'asc')->get();

        return view('club-access.registration', compact('clubs'));
    }

    public function createClubManager(ClubManagerRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' =>$validated['email'],
            'club_id' => $validated['clubs'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->assignRole('manager');

        $message = "Account created";
        $admin = User::whereEmail('info@collage.ie')->first();
        Mail::to($admin)->send(new AccountSubmitted($user));

        \Session::flash('registered', $message);

        return view('club-access.account-created');
    }

    public function usersView()
    {

        return view('club-access.users-list');
    }

    public function clubIndex()
    {
        $club = Club::find(Auth::user()->club_id);

       return true;
    }

}
