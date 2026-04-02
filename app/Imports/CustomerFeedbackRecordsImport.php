<?php

namespace App\Imports;

use App\Models\Modules\CustomerFeedbackRecords;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class CustomerFeedbackRecordsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CustomerFeedbackRecords([
            'cfr_id' => $row['cfr_id'],
            'site' => $row['site'],
            'type' => $row['type'],
            'customer' => $row['customer'],
            'customer_location' => $row['customer_location'],
            'customer_contact' => $row['customer_contact'],
            'customer_phone' => $row['customer_phone'],
            'customer_email' => $row['customer_email'],
            'description' => $row['description'],
            'cfr_category' => $row['cfr_category'],
            'originator' => $row['originator'],
            'date_originated' => $row['date_originated'],
            'root_cause' => $row['root_cause'],
            'action_to_be_taken' => $row['action_to_be_taken'],
            'assigned_to' => $row['assigned_to'],
            'target_completion_date' => $row['target_completion_date'],
            'completed_by' => $row['completed_by'],
            'date_completed' => $row['date_completed'],
            'feedback_to_customer' => $row['feedback_to_customer'],
            'feedback_by' => $row['feedback_by'],
            'effectiveness_evaluated' => $row['effectiveness_evaluated'],
            'action_taken_effective' => $row['action_taken_effective'],
            'what_action_was_taken' => $row['what_action_was_taken'],
            'action_taken_by' => $row['action_taken_by'],
            'date_of_feedback' => $row['date_of_feedback'],
            'cpar_required' => $row['cpar_required'],
            'if_yes_cpar' => $row['if_yes_cpar'],
            'closed_by' => $row['closed_by'],
            'closure_date' => $row['closure_date'],
            'attachment_field' => $row['attachment_field'],
            'photo_field' => $row['photo_field'],
        ]);
    }

    public function rules(): array
    {
        return [
            'cfr_id' => \Illuminate\Validation\Rule::unique('customer_feedback_records', 'cfr_id'),
        ];
    }
}
