<?php

namespace App\Exports;

use App\Personnel;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvalidPersonnelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Personnel::where('vetting_expiry');
    }
}
