<?php

namespace App\Imports;

use App\Models\Modules\Cpars;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class CparsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cpars([
            'cpar_id' => $row['cpar_no'],
            'site' => $row['site'],
            'date_of_issue' => $row['date_of_issue'],
            'cpar_type' => $row['cpar_type'],
            'reason' => $row['reason'],
            'reason_if_other' => $row['reason_if_other'],
            'description_of_issue' => $row['description_of_issue'],
            'originator' => $row['originator'],
            'date_originated' => $row['date_originated'],
            'results_area' => $row['results_areadept'],
            'responsible_manager' => $row['responsible_manager'],
            'manager_acceptance_date' => $row['resp_manager_acceptance_date'],
            'root_cause' => $row['root_cause'],
            'attachment_1' => $row['attachment_1_if_any'],
            'attachment_2' => $row['attachment_2_if_any'],
            'action_to_be_taken' => $row['action_to_be_taken'],
            'assigned_to' => $row['assigned_to'],
            'target_completion_date' => $row['target_completion_date'],
            'date_action_was_completed' => $row['date_action_was_completed'],
            'effectiveness_evaluated' => $row['how_was_effectiveness_evaluated'],
            'action_taken_effective' => $row['was_action_taken_effective'],
            'what_action_was_taken' => $row['if_no_what_action_was_taken'],
            'action_taken_by' => $row['if_no_action_taken_by'],
            'documents_revised' => $row['documents_revisedreissued'],
            'date_documents_revised' => $row['date_documents_revisedreissued'],
            'closed_by' => $row['closed_by'],
            'closure_date' => $row['closure_date'],
        ]);
    }

    public function rules(): array
    {
        return [
            'cpar_no' => \Illuminate\Validation\Rule::unique('cpars', 'cpar_id'),
        ];
    }
}
