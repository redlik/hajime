<?php

namespace App\Exports;

use App\Models\app\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllClubMembersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Member::all();
    }
}
