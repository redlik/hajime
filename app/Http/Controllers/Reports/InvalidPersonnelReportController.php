<?php

namespace App\Http\Controllers\Reports;

use App\Exports\InvalidPersonnelExport;
use App\Http\Controllers\Controller;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvalidPersonnelReportController extends Controller
{
    public function index()
    {
        $personnel = Personnel::where('vetting_expiry', '<', now())
            ->orWhere('safeguarding_expiry', '<', now())
            ->orderBy('club_id', 'asc')->orderBy('role', 'desc')->with('club')->get();
        return view('report.invalid-personnel', compact('personnel'));
    }

    public function export()
    {
        return Excel::download(new InvalidPersonnelExport(), 'invalid-personnel.xlsx');
    }
}
