<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ActiveCoachExport;
use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ActiveCoachReportController extends Controller
{
    public function index()
    {
        $coaches = Coach::where('vetting_expiry', '>=', now())
            ->where('safeguarding_expiry', '>=', now())
            ->orderBy('club_id', 'asc')->with('club:id,name')->get();
        return view('report.active-coach', compact('coaches'));
    }

    public function export()
    {
        $filename = 'active-coaches-'.date('d-m-y');
        return Excel::download(new ActiveCoachExport(), $filename, \Maatwebsite\Excel\Excel::XLSX);
    }
}
