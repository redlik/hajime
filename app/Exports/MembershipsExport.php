<?php

namespace App\Exports;

use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class MembershipsExport implements FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
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
        return Membership::query()->whereBetween('join_date', [$this->start_date, $this->end_date])->orderBy('join_date', 'desc');
    }

    /**
     * @param mixed $membership
     * @return array
     */
    public function map($membership): array {
        if($membership->member->adaptive) {
            $adaptive = $membership->member->special;
        } else {
            $adaptive = 'No';
        }

        return [
            $membership->member->number,
            $membership->member->first_name." ".$membership->member->last_name,
            $membership->member->gender,
            $membership->membership_type,
            $membership->member->source,
            $membership->join_date,
            $membership->member->club->name,
            ucfirst($membership->member->club->province),
            $adaptive,
        ];
    }

    public function headings(): array {
        return [
            'Number',
            'Name',
            'Gender',
            'Type',
            'Source',
            'Join Date',
            'Club Name',
            'Province',
            'Adaptive Judo'
        ];
    }

    public function title(): string
    {
        return 'Memberships List';
    }

}
