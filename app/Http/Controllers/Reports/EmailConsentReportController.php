<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ClubStatusExport;
use App\Exports\EmailConsentExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Maatwebsite\Excel\Facades\Excel;

class EmailConsentReportController extends Controller
{
    public function index()
    {
        $members = Member::where('active', 1)
            ->where('email_consent', 'Yes')
            ->with('club:id,name')->limit(100)
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
        return view('report.email-consent', compact('members'));
    }

    public function export()
    {
        return Excel::download(new EmailConsentExport(), 'email-consent-list.xlsx');
    }
}
