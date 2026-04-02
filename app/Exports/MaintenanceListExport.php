<?php

namespace App\Exports;

use App\Models\Modules\MaintenanceList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaintenanceListExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Equipment Id',
            'Site',
            'Serial Num',
            'Equipment Description',
            'Manufacturer',
            'Model',
            'Location',
            'Frequency',
            'Last Maintenance Performed',
            'Next Maintenance Performed',
            'Maintenance By',
            'Comments',
            'Equipment Status',
            'Action Required',
            'Attachment',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return MaintenanceList::all();
    }
}
