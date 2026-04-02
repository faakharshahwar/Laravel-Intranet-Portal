<?php

namespace App\Exports;

use App\Models\modules\AuditSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditScheduleExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Audit ID',
            'Audit Type',
            'Sub Type',
            'Start Date',
            'Dates',
            'Audit Year',
            'Status',
            'Audit Completion Date',
            'Num Of Issues',
            'Comments',
            'Audit Schedule',
            'Audit Checklist',
            'Audit Report',
            'ABS CPAR Acceptance',
            'Nonconformity Note Attachment',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return AuditSchedule::all();
    }
}
