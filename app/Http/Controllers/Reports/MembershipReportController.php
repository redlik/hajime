<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipReportController extends Controller
{
    public function index()
    {
        return view('report.membership-list');
    }

    public function showMembers(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $memberships = Membership::whereBetween('join_date', ['$start_date', '$end_date'])->get();
        dd($memberships);
        return view('report.membership-list', compact('memberships'));

    }
}
