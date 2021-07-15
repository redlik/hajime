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
    private $query;

    public function __construct(array $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        $club = NULL;
        $gender = NULL;
        $membership = NULL;
        $grade = NULL;

        extract($this->query, EXTR_OVERWRITE);

        return $members = Member::where('active', 1)
            ->when($club, function ($query, $club) {
                return $query->where('club_id', $club);
            })
            ->when($gender, function($query, $gender){
                return $query->where('gender', $gender);
            })
            ->when($membership, function ($query) use ($membership) {
                return $query->whereHas('currentMembership', function ($query) use ($membership)
                {
                    $query->where('membership_type', '=', $membership);
                });
            })
            ->when($grade, function ($query) use ($grade) {
                return $query->whereHas('currentGrade', function ($query) use ($grade)
                {
                    $query->where('grade_level', '=', $grade);
                });
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
