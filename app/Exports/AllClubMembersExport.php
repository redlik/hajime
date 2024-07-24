<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Grade;
use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AllClubMembersExport implements FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    private int $club;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Int $club)
    {

        $this->club = $club;
    }

    public function query()
    {

        return Member::query()
            ->where('club_id', $this->club)
            ->orderBy('last_name')
            ->orderBy('active', 'desc');
    }

    public function headings(): array
    {
        return [
            'Number',
            'Name',
            'Gender',
            'Age',
            'Club Name',
            'Phone',
            'Email',
            'Active',
            'Type',
            'Join Date',
            'Last Grade',
            'Adaptive Judo',
        ];
    }

    public function map($member): array {

        $membership = Membership::where('member_id', $member->id)->latest('join_date')->first();
        $grade = Grade::where('member_id', $member->id)->latest('grade_date')->first();
        if (is_null($grade)) {
            $grade = 'Not set';
        } else
            $grade = $member->latestGrade()->grade_level;

        $adaptive = isset($member->adaptive) ? $member->special : 'No';

        return [
            $member->number,
            $member->first_name." ".$member->last_name,
            $member->gender,
            $member->age,
            $member->club->name,
            $member->phone,
            $member->email,
            $member->active ? 'Active' : 'Not Active',
            $membership->membership_type ?? 'None',
            $membership->join_date ?? 'None',
            $grade,
            $adaptive,
        ];
    }

    public function title(): string
    {
        return 'Club All Members List';
    }
}
