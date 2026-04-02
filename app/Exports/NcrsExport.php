<?php

namespace App\Exports;

use App\Models\Modules\Ncrs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NcrsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'NCR No',
            'Originating Site',
            'Date of Issue',
            'Results Area',
            'Responsible Site',
            'Quantity',
            'Process Description',
            'Order No',
            'Nonconformance Type',
            'Customer If Applicable',
            'Description of Nonconformance',
            'Originator',
            'Date Originated',
            'NCR Category',
            'System Type',
            'Disposition Decision',
            'Disposition If Other',
            'Root Cause',
            'Action To Be Taken',
            'Assigned To',
            'Target Date',
            'Comments If Any',
            'Authorized By',
            'Authorization Date',
            'Action Taken',
            'Effectiveness Evaluated',
            'Action Taken Effective',
            'What Action Was Taken',
            'Action Taken By',
            'Completed By',
            'Date Completed',
            'CPAR Required?',
            'CPAR Num',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return Ncrs::all();
    }
}
