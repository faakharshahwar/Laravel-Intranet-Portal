<?php

namespace App\Imports;

use App\Models\Modules\Ncrs;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class NcrsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ncrs([
            'ncr_id' => $row['ncr_no'] ?? '-',
            'originating_site' => $row['originating_site'] ?? '-',
            'date_of_issue' => $row['date_of_issue'] ?? '-',
            'results_area' => $row['results_area'] ?? '-',
            'responsible_site' => $row['responsible_site'] ?? '-',
            'quantity' => $row['quantity'] ?? '-',
            'process_description' => $row['process_description'] ?? '-',
            'order_num' => $row['order_no'] ?? '-',
            'nonconformance_type' => $row['nonconformance_type'] ?? '-',
            'customer_if_applicable' => $row['customer_if_applicable'] ?? '-',
            'description_of_nonconformance' => $row['description_of_nonconformance'] ?? '-',
            'originator' => $row['originator'] ?? '-',
            'date_originated' => $row['date_originated'] ?? '-',
            'ncr_category' => $row['ncr_category'] ?? '-',
            'system_type' => $row['system_type'] ?? '-',
            'disposition_decision' => $row['disposition_decision'] ?? '-',
            'disposition_if_other' => $row['disposition_if_other'] ?? '-',
            'root_cause' => $row['root_cause'] ?? '-',
            'action_to_be_taken' => $row['action_to_be_taken'] ?? '-',
            'assigned_to' => $row['assigned_to'] ?? '-',
            'target_date' => $row['target_date'] ?? '-',
            'comments_if_any' => $row['comments_if_any'] ?? '-',
            'authorized_by' => $row['authorized_by'] ?? '-',
            'authorization_date' => $row['authorization_date'] ?? '-',
            'action_taken' => $row['action_taken'] ?? '-',
            'effectiveness_evaluated' => $row['effectiveness_evaluated'] ?? '-',
            'action_taken_effective' => $row['action_taken_effective'] ?? '-',
            'what_action_was_taken' => $row['what_action_was_taken'] ?? '-',
            'action_taken_by' => $row['action_taken_by'] ?? '-',
            'completed_by' => $row['completed_by'] ?? '-',
            'date_completed' => $row['date_completed'] ?? '-',
            'cpar_required' => $row['cpar_required'] ?? '-',
            'cpar_num' => $row['cpar_num'] ?? '-',
            'closed_by' => $row['closed_by'] ?? '-',
            'closure_date' => $row['closure_date'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            'ncr_no' => \Illuminate\Validation\Rule::unique('ncrs', 'ncr_id'),
        ];
    }
}
