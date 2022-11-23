<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Coach;
use App\Models\Member;
use App\Models\Personnel;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ComplianceStatusReportController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('name', 'asc')->get();

        return view('report.compliance-status', compact('clubs'));
    }

    public function generatePdf($selected)
    {
        $club = Club::find($selected);
        $headCoach = Personnel::headcoach()->where('club_id', $selected)->first();
        $secretary = Personnel::secretary()->where('club_id', $selected)->first();
        $designated = Personnel::designatedofficer()->where('club_id', $selected)->first();
        $childrens = Personnel::childrenofficer()->where('club_id', $selected)->first();
        $coaches = Coach::where('club_id', $selected)->get();
        $volunteers = Volunteer::where('club_id', $selected)->get();
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.compliance-report', compact('club', 'secretary', 'headCoach', 'designated', 'childrens', 'coaches', 'volunteers'));
        return $pdf->download('compliance-report.pdf');
    }

    public function toArray($club)
    {
        return $club->toArray();
    }
}
