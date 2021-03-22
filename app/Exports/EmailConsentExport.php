<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmailConsentExport implements FromCollection, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $members = Member::where('active', 1)
            ->where('email_consent', 'Yes')
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
    }

    public function map($member): array
    {
        return [
            $member->number,
            $member->first_name.' '.$member->last_name,
            $member->email,
            $member->gender,
            $member->club->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Number',
            'Name',
            'Email',
            'Gender',
            'Club',
        ];
    }

    public function title(): string
    {
        return 'Email Consent List';
    }

}
