<?php

namespace App\Exports;

use App\Models\Club;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClubStatusExport implements FromCollection, WithMapping, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Club::orderBy('name', 'asc')->get();
    }

    public function map($club): array
    {
        return [
            $club->name,
            $club->province,
            $club->compliant,
            $club->voting_rights,
        ];
    }

    public function headings(): array {
        return [
            'Name',
            'Province',
            'Compliant',
            'Voting Rights',
        ];
    }

    public function title(): string
    {
        return 'Club Status';
    }

    public function prepareRows($rows): array
    {
        return array_map(function ($club){
            if ($club->compliant) {
                $club->compliant = 'Yes';
            } else {
                $club->compliant = 'No';
            }
            if ($club->voting_rights) {
                $club->voting_rights = 'Yes';
            } else {
                $club->voting_rights = 'No';
            }
            return $club;
        }, $rows);
    }
}
