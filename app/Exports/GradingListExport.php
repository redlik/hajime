<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class GradingListExport implements FromCollection, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return $members = Member::where('active', 1)->with('grade:id,grade_level', 'club:id,name')->has('grade')->get();
    }

    public function map($member): array
    {
        return [
            $member->number,
            $member->first_name.' '.$member->last_name,
            $member->club->name,
            $member->gender,
            $member->latestMembership()->membership_type,
            $member->latestGrade()->grade_level,
        ];
    }

    public function headings(): array
    {
        return [
            'Number',
            'Name',
            'Club',
            'Gender',
            'Membership Type',
            'Current Grade',
        ];
    }

    public function title(): string
    {
        return 'Grading List';
    }
}
