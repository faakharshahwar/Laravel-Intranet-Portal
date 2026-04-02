<?php

namespace App\Exports;

use App\Models\Modules\Rars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RarsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'ID',
            'RAR ID',
            'Site',
            'Date Identified',
            'Department',
            'Risk Type',
            'Risk Title',
            'Risk Description',
            'Risk Source',
            'Risk Category',
            'Risk Probability',
            'Risk Impact',
            'Mitigation',
            'Risk Priority',
            'Responsible Person',
            'Next Risk Review Date',
            'Effectiveness Evaluated',
            'Action Taken Effective',
            'What Action Was Taken',
            'Action Taken By',
            'CPAR Num',
            'Status',
            'Comments',
            'Closed Date',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return Rars::all();
    }
}
