<?php

namespace App\Exports;

use App\Models\Coach;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class InvalidCoachesExport implements FromCollection, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Coach::where('vetting_expiry', '<', now())
            ->orWhere('safeguarding_expiry', '<', now())
            ->orderBy('club_id', 'asc')->with('club:id,name')->get();
    }

    public function map($coach): array
    {
        $vetting = '';
        $safe = '';
        if ($coach->vetting_expiry < now() and !empty($coach->vetting_expiry)) {
            $vetting = "Vetting   ";
        }
        elseif (is_null($coach->vetting_expiry)) {
            $vetting = "Vetting not Set   ";
        }

        if($coach->safeguarding_expiry < now() and !empty($coach->safeguarding_expiry)) {
            $safe = 'Safeguarding';
        } elseif (is_null($coach->safeguarding_expiry)) {
            $safe = "Safeguarding not Set";
        }
        $reason = $vetting.$safe;

        if ($coach->vetting_expiry > now()) {
            $coach->vetting_expiry = '';
        }

        if ($coach->safeguarding_expiry > now()) {
            $coach->safeguarding_expiry = '';
        }

        return [
            $coach->club->name,
            $coach->name,
            $reason,
            $coach->vetting_expiry,
            $coach->safeguarding_expiry,
            $coach->coaching_qualification,
        ];
    }

    public function headings(): array {
        return [
            'Club',
            'Name',
            'Reason',
            'Vetting Expiry',
            'Safeguarding Expiry',
            'Qualification',
        ];
    }

    public function title(): string
    {
        return 'Invalid Coaches '.date('m-d-y');
    }
}
