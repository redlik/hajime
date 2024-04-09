<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class PagesController extends Controller
{
    public function logsPage()
    {
        $logs = Activity::latest()->get();

        return view('pages.logs-page', compact('logs'));
    }

    public function adminList()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $admins = User::role($adminRole)->get();

        return view('pages.admin-list', compact('admins'));
    }
}
