<?php

namespace App\Exports;

use App\Models\Modules\InspectionReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InspectionReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Description',
            'Report Type',
            'Completion Date',
            'Status',
            'Next Due Date',
            'Attachment 1',
            'Attachment 2',
            'Attachment 3',
            'Remarks',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return InspectionReport::all();
    }
}
