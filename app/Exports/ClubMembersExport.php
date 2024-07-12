<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Builder;
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

        return Member::query()->where('club_id', $this->club)
            ->where('active', 1)
            ->whereHas('membership', function (Builder $q) {
            $q->whereBetween('join_date', [$this->start_date, $this->end_date]);
        })
            ->orderBy('last_name', 'asc');
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

        if($membership->member->adaptive) {
            $adaptive = $member->special;
        } else {
            $adaptive = 'No';
        }

        return [
            $member->number,
            $member->first_name." ".$member->last_name,
            $member->gender,
            $member->age,
            $member->club->name,
            $membership->membership_type,
            $membership->join_date,
            $grade,
            $adaptive,
        ];
    }

    public function title(): string
    {
        return 'Club Member List';
    }
}
