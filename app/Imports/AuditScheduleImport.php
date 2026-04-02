<?php

namespace App\Imports;

use App\Models\modules\AuditSchedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class AuditScheduleImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AuditSchedule([
            'site' => $row['site'],
            'audit_id' => $row['audit_id'],
            'audit_type' => $row['audit_type'],
            'sub_type' => $row['sub_type'],
            'start_date' => $row['start_date'],
            'dates' => $row['dates'],
            'audit_schedule' => $row['audit_schedule'],
            'audit_checklist' => $row['audit_checklist'],
            'audit_year' => $row['audit_year'],
            'status' => $row['status'],
            'audit_completion_date' => $row['audit_completion_date'],
            'audit_report' => $row['audit_report'],
            'num_of_issues' => $row['num_of_issues'],
            'abs_cpar_acceptance' => $row['abs_cpar_acceptance'],
            'nonconformity_note_attachment' => $row['nonconformity_note_attachment'],
            'comments' => $row['comments'],
        ]);
    }
}
