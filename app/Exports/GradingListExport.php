<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Club;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class GradingListExport implements FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    private $club;

    public function __construct($club)
    {
        $this->club = $club;
    }

    public function query()
    {
        return $members = Member::where('active', 1)
            ->when($this->club, function ($query, $club) {
                return $query->where('club_id', $club);
            })
            ->with('grade:id,grade_level', 'club:id,name')
            ->orderBy('club_id', 'asc')
            ->orderBy('last_name', 'asc')
            ->has('grade');
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
