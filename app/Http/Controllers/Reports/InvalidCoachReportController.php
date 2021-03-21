<?php

namespace App\Http\Controllers\Reports;

use App\Exports\InvalidCoachesExport;
use App\Exports\InvalidPersonnelExport;
use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvalidCoachReportController extends Controller
{
    public function index()
    {
        $coaches = Coach::where('vetting_expiry', '<', now())
            ->orWhere('safeguarding_expiry', '<', now())
            ->orderBy('club_id', 'asc')->with('club:id,name')->get();
        return view('report.invalid-coach', compact('coaches'));
    }

    public function export()
    {
        $filename = 'invalid-coaches-'.date('d-m-y');
        return Excel::download(new InvalidCoachesExport(), $filename, \Maatwebsite\Excel\Excel::XLSX);
    }
}
