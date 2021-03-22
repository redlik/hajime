<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ClubMembersExport;
use App\Exports\MembershipsExport;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Grade;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MembersReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) {
            $selectedClub = Club::find($request->input('club_id'));
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $members = Member::where('club_id', $selectedClub->id)->whereHas('membership', function($q) use ($start_date, $end_date) {
                $q->where('join_date', '>=', $start_date);
//                ->where('expiry_date','>=', $end_date)
            })->orderBy('last_name', 'asc')
                ->get();
            $memberships = collect([]);
            $grades = collect([]);
            foreach ($members as $member) {
                $memberships->push(Membership::where('member_id', $member->id)->latest('join_date')->first());
                $grades->push(Grade::where('member_id', $member->id)->latest('grade_date')->first());
            }
            $clubs = Club::orderBy('name', 'asc')->get();
            return view('report.members-list-query', compact('clubs', 'selectedClub', 'members', 'start_date', 'end_date', 'memberships', 'grades'));
        }
        else {
            $clubs = Club::orderBy('name', 'asc')->get();
            return view('report.members-list', compact('clubs'));
        }
    }

    public function export($club, $start_date, $end_date)
    {
        return Excel::download(new ClubMembersExport($club, $start_date, $end_date), 'club_members.xlsx');
    }

}
