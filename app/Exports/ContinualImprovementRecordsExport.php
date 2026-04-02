<?php

namespace App\Exports;

use App\Models\Modules\ContinualImprovementRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContinualImprovementRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'CIR ID',
            'Site',
            'CIR Concise Description',
            'Improvement Opportunity',
            'Originator',
            'Date Originated',
            'CIR Type',
            'Department',
            'Responsible Manager',
            'Responsible Mgr Approval Date',
            'Action To Be Taken',
            'File Attachment 1',
            'File Attachment 2',
            'Assigned To',
            'Target Completion Date',
            'Action That Was Taken',
            'Action Completed By',
            'Date Action Was Completed',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return ContinualImprovementRecords::all();
    }
}
