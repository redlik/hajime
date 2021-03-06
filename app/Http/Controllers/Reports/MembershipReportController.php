<?php

namespace App\Http\Controllers\Reports;

use App\Exports\MembershipsExport;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MembershipReportController extends Controller
{
    public function index()
    {
        return view('report.membership-list');
    }

    public function showMembers(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|max:10',
            'end_date' => 'required|date|after:start_date|max:10'
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $memberships = Membership::whereBetween('join_date', [$start_date, $end_date])
            ->orderBy('join_date', 'desc')
            ->limit(100)->get();
        return view('report.membership-list', compact('memberships', 'start_date', 'end_date'));
    }

    public function export($start_date, $end_date)
    {
        return Excel::download(new MembershipsExport($start_date, $end_date), 'memberships.xlsx');
    }
}
