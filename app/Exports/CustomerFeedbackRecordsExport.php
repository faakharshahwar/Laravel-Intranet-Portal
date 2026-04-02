<?php

namespace App\Exports;

use App\Models\Modules\CustomerFeedbackRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerFeedbackRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'CFR ID',
            'Site',
            'Type',
            'Customer',
            'Customer Location',
            'Customer Contact',
            'Customer Phone',
            'Customer Email',
            'Description',
            'CFR Category',
            'Originator',
            'Date Originated',
            'Root Cause',
            'Action To Be Taken',
            'Assigned To',
            'Target Completion Date',
            'Completed By',
            'Date Completed',
            'Feedback to Customer',
            'Feedback By',
            'Effectiveness Evaluated',
            'Action Taken Effective',
            'What Action Was Taken',
            'Action Taken By',
            'Date of Feedback',
            'CPAR Required?',
            'If Yes CPAR',
            'Attachment Field',
            'Photo Field',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return CustomerFeedbackRecords::all();
    }
}
