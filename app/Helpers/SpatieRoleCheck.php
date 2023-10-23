<?php

namespace App\Helpers;

trait SpatieRoleCheck {

    public function checkIfRoleDoesntExists($role)
    {
        return \Spatie\Permission\Models\Role::where('name', '=', $role)->count() < 1;
    }

    public function registerClubManager()
    {

    }
}
