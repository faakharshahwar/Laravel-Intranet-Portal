<?php

namespace App\Imports;

use App\Models\Modules\ContinualImprovementRecords;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class ContinualImprovementRecordsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ContinualImprovementRecords([
            'cir_id' => $row['cir_id'],
            'site' => $row['site'],
            'cir_concise_description' => $row['cir_concise_description'],
            'improvement_opportunity' => $row['improvement_opportunity'],
            'originator' => $row['originator'],
            'date_originated' => $row['date_originated'],
            'cir_type' => $row['cir_type'],
            'department' => $row['department'],
            'responsible_mgr_approval_date' => $row['responsible_mgr_approval_date'],
            'action_to_be_taken' => $row['action_to_be_taken'],
            'file_attachment_1' => $row['file_attachment_1'],
            'file_attachment_2' => $row['file_attachment_2'],
            'assigned_to' => $row['assigned_to'],
            'target_completion_date' => $row['target_completion_date'],
            'action_that_was_taken' => $row['action_that_was_taken'],
            'action_completed_by' => $row['action_completed_by'],
            'date_action_was_completed' => $row['date_action_was_completed'],
            'closed_by' => $row['closed_by'],
            'closure_date' => $row['closure_date'],
        ]);
    }
}
