<?php

namespace App\Http\Controllers\Reports;

use App\Exports\GradingListExport;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradingReportController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('name', 'asc')->get();
        $members = Member::where('active', 1)
            ->with('grade:id,grade_level', 'club:id,name')
            ->has('grade')->limit(100)
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.grading', compact('members', 'clubs'));
    }

    public function filteredResults(Request $request)
    {
        $clubs = Club::orderBy('name', 'asc')->get();
        $selectedClub = Club::find($request->input('club'));
        $members = Member::where('active', 1)
            ->when($selectedClub, function ($query, $selectedClub) {
                return $query->where('club_id', $selectedClub->id);
            })
            ->with('grade:id,grade_level', 'club:id,name')
            ->has('grade')
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.grading', compact('members', 'clubs', 'selectedClub'));
    }

    public function export()
    {
        return Excel::download(new GradingListExport(), 'grading-list.xlsx');
    }
}
