<?php

namespace App\Exports;

use App\Models\Modules\CustomerSatisfactionRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerSatisfactionRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'CSR Id',
            'Date Data Collected',
            'Customer Company Name',
            'Customer Contact(s)',
            'Customer Location',
            'Contact Phone (If Applicable)',
            'Contact Email Address (If Any)',
            'Site Representative',
            'Site',
            'Customer Service and Assistance',
            'Quality of Product/Service',
            'Our Performance vs. Expectations',
            'On Time Shipment',
            'Does Company have permission to reprint your comments?',
            'Like a Sales Rep. to Call?',
            'Average - All Applicable Ratings Comments & Suggestions (If Any)',
            'CFR # (If Any)',
            'Sales Notes (If Any)',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return CustomerSatisfactionRecords::all();
    }
}
