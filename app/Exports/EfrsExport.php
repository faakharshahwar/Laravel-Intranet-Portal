<?php

namespace App\Exports;

use App\Models\Modules\Efr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EfrsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Type',
            'Interested Party',
            'IP Location',
            'IP Contact',
            'IP Contact Telephone',
            'Feedback',
            'Originator',
            'Date Originated',
            'Action Taken',
            'Completed By',
            'Feedback to IP',
            'Feedback to IP By',
            'Date of Feedback',
            'Closed By',
            'Closure Date',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return Efr::all();
    }
}
