<?php

namespace App\Http\Controllers;

use App\Helpers\SpatieRoleCheck;
use App\Http\Requests\ClubManagerRequest;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
        dd($user);
        return view('home');
    }
}
