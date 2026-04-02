<?php

namespace App\Exports;

use App\Models\Modules\Edr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EdrsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Edr ID',
            'Date and Time Drill',
            'Site',
            'Type of Emergency Simulated',
            'Person Conducting the Drill',
            'Notification Used',
            'Staff on Duty',
            'Attachment Staff Participating',
            'Number Evacuated',
            'Weather Conditions',
            'Time Required',
            'Problems Encountered',
            'Cpars',
            'Comments',
            'Photo 1 Description',
            'Photo 1',
            'Photo 2 Description',
            'Photo 2',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return Edr::all();
    }
}
