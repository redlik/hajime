<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\Member;
use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClubMembersExport implements FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $club, $start_date, $end_date;

    public function __construct(Int $club, String $start_date, String $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->club = $club;
    }


    public function query()
    {
        return Member::query()->where('club_id', $this->club)->has('membership');
    }

    public function headings(): array
    {
        return [
            'Number',
            'Name',
            'Gender',
            'Club Name',
            'Type',
            'Join Date',
            'Last Grade',
        ];
    }


    public function map($member): array {
        $membership = Membership::where('member_id', $member->id)->latest('join_date')->first();
        $grade = Grade::where('member_id', $member->id)->latest('grade_date')->first();
        if (is_null($grade)) {
            $grade = 'Not set';
        } else
            $grade = $member->latestGrade()->grade_level;

        return [
            $member->number,
            $member->first_name." ".$member->last_name,
            $member->gender,
            $member->club->name,
            $membership->membership_type,
            $membership->join_date,
            $grade,
        ];
    }

    public function title(): string
    {
        return 'Club Member List';
    }
}
