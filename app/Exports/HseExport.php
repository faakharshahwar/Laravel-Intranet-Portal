<?php

namespace App\Exports;

use App\Models\Modules\Hse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'For Month Starting',
            'Site',
            'Num of First Aids',
            'Num of Near Misses',
            'Num of Safety Violations',
            'Num of Medical Cases',
            'Num of Restricted Cases',
            'Num of Lost Time Cases',
            'Num of Recordable Cases',
            'Num of Environmental Issues',
            'Comments',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return Hse::all();
    }
}
