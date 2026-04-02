<?php

namespace App\Exports;

use App\Models\Modules\RecordSummary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecordSummaryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Id',
            'Record Title',
            'Doc Id',
            'Site',
            'Location',
            'Type',
            'File Manual Title',
            'Maintained By',
            'Minimum Retention',
            'Record Status',
            'Comments',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return RecordSummary::all();
    }
}
