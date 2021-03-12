<?php

namespace App\Exports;

use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class MembershipsExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $start_date, $end_date;

    public function __construct(String $start_date, String $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function query()
    {
        return Membership::query()->whereBetween('join_date', [$this->start_date, $this->end_date]);
    }
}
