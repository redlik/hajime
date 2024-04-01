<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class PagesController extends Controller
{
    public function logsPage()
    {
        $logs = Activity::all();

        ray($logs);

        return view('pages.logspage', compact('logs'));
    }
}
