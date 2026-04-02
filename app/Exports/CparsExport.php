<?php

namespace App\Exports;

use App\Models\Modules\Cpars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CparsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'ID',
            'CPAR No',
            'Site',
            'Date of Issue',
            'CPAR Type',
            'Reason',
            'Reason (If Other)',
            'Description of Issue',
            'Originator',
            'Date Originated',
            'Results Area/Dept.',
            'Responsible Manager',
            'Resp. Manager Acceptance Date',
            'Root Cause',
            'Attachment 1 (If Any)',
            'Attachment 2 (If Any)',
            'Action To Be Taken',
            'Assigned To',
            'Target Completion Date',
            'Date Action Was Completed',
            'How Was Effectiveness Evaluated?',
            'Was Action Taken Effective?',
            'If NO, What Action Was Taken?',
            'If NO, Action Taken By',
            'Documents Revised/Reissued',
            'Date Documents Revised/Reissued',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'

        ];
    }

    public function collection()
    {
        return Cpars::all();
    }
}
