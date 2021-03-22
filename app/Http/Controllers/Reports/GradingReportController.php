<?php

namespace App\Http\Controllers\Reports;

use App\Exports\GradingListExport;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradingReportController extends Controller
{
    public function index()
    {
        $members = Member::where('active', 1)
            ->with('grade:id,grade_level', 'club:id,name')
            ->has('grade')->limit(100)
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.grading', compact('members'));
    }

    public function export()
    {
        return Excel::download(new GradingListExport(), 'grading-list.xlsx');
    }
}
