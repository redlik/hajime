<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function membershipsReport(Request $request)
    {
        return view('reports.memberships', compact());
    }
}
