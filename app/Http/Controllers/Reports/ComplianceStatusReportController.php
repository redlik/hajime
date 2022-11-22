<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ComplianceStatusReportController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('name', 'asc')->get();

        return view('report.compliance-status', compact('clubs'));
    }
}
