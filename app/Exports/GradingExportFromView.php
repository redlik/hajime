<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GradingExportFromView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('report.grading', [
            'members' =>Member::all()
        ]);
    }
}
