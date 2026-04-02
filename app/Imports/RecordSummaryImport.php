<?php

namespace App\Imports;

use App\Models\Modules\RecordSummary;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecordSummaryImport implements ToModel, WithHeadingRow, SkipsOnFailure
{

    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RecordSummary([
            'id' => $row['id'],
            'record_title' => $row['record_title'] ?? '-',
            'doc_id' => $row['doc_id'] ?? '-',
            'site' => $row['site'] ?? '-',
            'location' => $row['location'] ?? '-',
            'type' => $row['type'] ?? '-',
            'file_manual_title' => $row['file_manual_title'] ?? '-',
            'maintained_by' => $row['maintained_by'] ?? '-',
            'minimum_retention' => $row['minimum_retention'] ?? '-',
            'record_status' => $row['record_status'] ?? '-',
            'comments' => $row['comments'] ?? '-',
            'created_at' => $row['created_at'] ?? '-',
            'updated_at' => $row['updated_at'] ?? '-',
        ]);
    }
}
