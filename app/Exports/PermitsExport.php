<?php

namespace App\Exports;

use App\Models\Modules\Permits;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermitsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Permit Type',
            'Permit Id',
            'Agency Type',
            'Agency Name',
            'Expiration Date',
            'Attachment',
            'Copy of Permit',
            'Monthly Requirements',
            'Quarterly Requirements',
            'Annual Requirements',
            'Comments',
            'created_by',
            'updated_by',
        ];
    }

    public function collection()
    {
        return Permits::all();
    }
}
