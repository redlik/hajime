<?php

namespace App\Exports;

use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class InvalidPersonnelExport implements FromCollection, WithMapping, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Personnel::where('vetting_expiry', '<', now())
            ->orWhere('safeguarding_expiry', '<', now())
            ->orderBy('club_id', 'asc')->orderBy('role', 'desc')->with('club')->get();
    }

    public function map($personnel): array
    {
        $vetting = '';
        $safe = '';
        if ($personnel->vetting_expiry < now() and !empty($personnel->vetting_expiry)) {
            $vetting = "Vetting   ";
        }
        elseif (is_null($personnel->vetting_expiry)) {
            $vetting = "Vetting not Set   ";
        }

        if($personnel->safeguarding_expiry < now() and !empty($personnel->safeguarding_expiry)) {
                $safe = 'Safeguarding';
        } elseif (is_null($personnel->safeguarding_expiry)) {
            $safe = "Safeguarding not Set";
        }
        $reason = $vetting.$safe;

        if ($personnel->vetting_expiry > now()) {
            $personnel->vetting_expiry = '';
        }

        if ($personnel->safeguarding_expiry > now()) {
            $personnel->safeguarding_expiry = '';
        }

        return [
            $personnel->club->name,
            $personnel->name,
            $personnel->role,
            $reason,
            $personnel->vetting_expiry,
            $personnel->safeguarding_expiry,
        ];
    }

    public function headings(): array {
        return [
            'Club',
            'Name',
            'Role',
            'Reason',
            'Vetting Expiry',
            'Safeguarding Expiry',
        ];
    }

    public function title(): string
    {
        return 'Invalid Personnel '.date('m-d-y');
    }
}
