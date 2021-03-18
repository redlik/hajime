<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ClubStatusExport;
use App\Exports\MembershipsExport;
use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClubStatusReportController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('report.club-status', compact('clubs'));
   }

    public function export()
    {
        return Excel::download(new ClubStatusExport(), 'club-status.xlsx');
   }
}
