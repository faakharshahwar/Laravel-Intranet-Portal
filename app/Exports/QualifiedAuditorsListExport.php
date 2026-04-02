<?php

namespace App\Exports;

use App\Models\Modules\QualifiedAuditorsLists;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QualifiedAuditorsListExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Auditor Name',
            'Site',
            'Auditor Status',
            'Qualification Basis 1',
            'Qualification Basis 2',
            'Qualification Basis 3',
            'Comments',
            'File Attachment 1',
            'File Attachment 2',
            'Web Link 1',
            'Web Link 2',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return QualifiedAuditorsLists::all();
    }
}
