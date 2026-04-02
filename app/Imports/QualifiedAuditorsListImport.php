<?php

namespace App\Imports;

use App\Models\Modules\QualifiedAuditorsLists;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QualifiedAuditorsListImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QualifiedAuditorsLists([
            'auditor_name' => $row['auditor_name'] ?? '-',
            'site' => $row['site'] ?? '-',
            'auditor_status' => $row['auditor_status'] ?? '-',
            'qualification_basis_1' => $row['qualification_basis_1'] ?? '-',
            'qualification_basis_2' => $row['qualification_basis_2'] ?? '-',
            'qualification_basis_3' => $row['qualification_basis_3'] ?? '-',
            'comments' => $row['comments'] ?? '-',
            'file_attachment_1' => $row['file_attachment_1'] ?? '-',
            'file_attachment_2' => $row['file_attachment_2'] ?? '-',
            'web_link_1' => $row['web_link_1'] ?? '-',
            'web_link_2' => $row['web_link_2'] ?? '-',
            'created_at' => $row['created_at'] ?? '-',
            'updated_at' => $row['updated_at'] ?? '-',
        ]);
    }
}
