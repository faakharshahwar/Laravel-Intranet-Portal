<?php

namespace App\Exports;

use App\Models\Modules\ManagementReviews;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManagementReviewsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Date Of Management Review',
            'Site',
            'Status',
            'Agenda',
            'Minutes Attachment',
            'Attachment 1',
            'Attachment 2',
            'Attachment 3',
            'Comments',
            'Created At',
            'Updated At'
        ];
    }
    public function collection()
    {
        return ManagementReviews::all();
    }
}
