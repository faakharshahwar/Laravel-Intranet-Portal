<?php

namespace App\Exports;

use App\Models\Modules\Snrs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SnrsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'ID',
            'SNR No',
            'Site',
            'Origination Date',
            'Supplier',
            'Supplier Representative',
            'Our PO',
            'Supplier Order',
            'Product Name',
            'Quantity',
            'Product Description',
            'Supplier RMA',
            'Requisition',
            'Sales Order',
            'Customer',
            'Other',
            'Description of Nonconformance',
            'Originator',
            'Root Cause',
            'Action to Be Taken',
            'Assigned To',
            'Effectiveness Evaluated',
            'Action Taken Effective',
            'What Action Was Taken',
            'Action Taken By',
            'Target Completion Date',
            'Action That Was Taken',
            'Completed By',
            'Disposition Decision',
            'Date Completed',
            'CPAR Required',
            'CPAR Num',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return Snrs::all();
    }
}
