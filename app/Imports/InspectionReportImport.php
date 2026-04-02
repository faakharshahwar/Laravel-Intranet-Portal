<?php

namespace App\Imports;

use App\Models\Modules\InspectionReport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InspectionReportImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new InspectionReport([
            'id' => $row['id'] ?? '-',
            'site' => $row['site'] ?? '-',
            'description' => $row['description'] ?? '-',
            'report_type' => $row['report_type'] ?? '-',
            'completion_date' => $row['completion_date'] ?? '-',
            'status' => $row['status'] ?? '-',
            'next_due_date' => $row['next_due_date'] ?? '-',
            'attachment_1' => $row['attachment_1'] ?? '-',
            'attachment_2' => $row['attachment_2'] ?? '-',
            'attachment_3' => $row['attachment_3'] ?? '-',
            'remarks' => $row['remarks'] ?? '-',
            'created_at' => $row['created_at'] ?? '-',
            'updated_at' => $row['updated_at'] ?? '-',
        ]);
    }
}
