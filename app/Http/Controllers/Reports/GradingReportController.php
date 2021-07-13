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
    public function index(Request $request)
    {
        $selectedClub = NULL;
        $gender = NULL;
        $selected_membership = NULL;
        $selected_grade = NULL;

        if ($request->get('club') && $request->get('club') != 'all') {
            $selectedClub = $request->get('club');
        }

        if ($request->get('gender')) {
            $gender = $request->get('gender');
        }

        if ($request->get('membership')) {
            $selected_membership = $request->get('membership');
        }

        if ($request->get('grade')) {
            $selected_grade = $request->get('grade');
        }

        $clubs = Club::orderBy('name', 'asc')->get();
        $members = Member::where('active', 1)
            ->when($selectedClub, function ($query, $selectedClub) {
                return $query->where('club_id', $selectedClub);
            })
            ->when($gender, function($query, $gender){
                return $query->where('gender', $gender);
            })
            ->when($selected_membership, function ($query) use ($selected_membership) {
                return $query->whereHas('currentMembership', function ($query) use ($selected_membership)
                {
                    $query->where('membership_type', '=', $selected_membership);
                });
            })
            ->when($selected_grade, function ($query) use ($selected_grade) {
                return $query->whereHas('currentGrade', function ($query) use ($selected_grade)
                {
                    $query->where('grade_level', '=', $selected_grade);
                });
            })
            ->with('grade:id,grade_level', 'club:id,name', 'currentMembership:membership_type')
            ->has('grade')
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.grading',
            compact('members', 'clubs', 'selectedClub'));
    }

    public function filteredResults(Request $request)
    {
        if ($request->input('club') == 'all') {
            $selectedClub = NULL;
        } else {
            $selectedClub = $request->input('club');
        }

        $clubs = Club::orderBy('name', 'asc')->get();

        $members = Member::where('active', 1)
            ->when($selectedClub, function ($query, $selectedClub) {
                return $query->where('club_id', $selectedClub);
            })
            ->with('grade:id,grade_level', 'club:id,name')
            ->has('grade')
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.grading', compact('members', 'clubs', 'selectedClub'));
    }

    public function export($club = NULL, $gender = NULL, $current_membership = NULL, $current_grade = NULL)
    {
        return Excel::download(new GradingListExport($club, $gender, $current_membership, $current_grade), 'grading-list.xlsx');
    }
}
