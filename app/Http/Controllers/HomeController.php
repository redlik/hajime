<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function home()
    {
        $clubs = Club::count();
        $members = Member::count();
        return view('home-new', compact('clubs', 'members'));
    }
}
