<?php

namespace App\Exports;

use App\Models\Modules\FirstAids;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FirstAidExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Item Name',
            'Description',
            'Production Date',
            'Expiry Date',
            'Required Quantity',
            'Available Quantity',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return FirstAids::all();
    }
}
