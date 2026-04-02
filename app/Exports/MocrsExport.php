<?php

namespace App\Exports;

use App\Models\Modules\Mocr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MocrsExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Change Requested By',
            'Date Requested',
            'MOCR Id',
            'Proposed QMS Change',
            'Purpose of Change',
            'Potential Consequence of Change',
            'Impact on Integrity of QMS',
            'Availability of Resources',
            'Allocation or Reallocation',
            'Additional Considerations',
            'Change Authorized By',
            'Date Authorized',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return Mocr::all();
    }
}
