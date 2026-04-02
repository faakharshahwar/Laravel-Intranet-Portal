<?php

namespace App\Exports;

use App\Models\Modules\ExternalDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExternalDocumentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'ID',
            'Site',
            'Doc Id',
            'Document Type',
            'Organization',
            'Title',
            'Effective Date',
            'Verification Date',
            'Verification Method',
            'Verified By',
            'Next Verification Due Date',
            'Primary Location Held',
            'Attachment',
            'Web Linked File',
            'Comments',
            'Created At',
            'Updated At'
        ];
    }


    public function collection()
    {
        return ExternalDocument::all();
    }
}
