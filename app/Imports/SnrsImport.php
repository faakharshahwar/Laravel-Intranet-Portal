<?php

namespace App\Imports;

use App\Models\Modules\Snrs;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SnrsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Snrs([
            'snr_id' => $row['snr_no'] ?? '-',
            'site' => $row['site'] ?? '-',
            'origination_date' => $row['origination_date'] ?? '-',
            'supplier' => $row['supplier'] ?? '-',
            'supplier_representative' => $row['supplier_representative'] ?? '-',
            'our_po' => $row['our_po'] ?? '-',
            'supplier_order' => $row['supplier_order'] ?? '-',
            'product_name' => $row['product_name'] ?? '-',
            'quantity' => $row['quantity'] ?? '-',
            'product_description' => $row['product_description'] ?? '-',
            'supplier_rma' => $row['supplier_rma'] ?? '-',
            'requisition' => $row['requisition'] ?? '-',
            'sales_order' => $row['sales_order'] ?? '-',
            'customer' => $row['customer'] ?? '-',
            'other' => $row['other'] ?? '-',
            'description_of_nonconformance' => $row['description_of_nonconformance'] ?? '-',
            'originator' => $row['originator'] ?? '-',
            'root_cause' => $row['root_cause'] ?? '-',
            'action_to_be_taken' => $row['action_to_be_taken'] ?? '-',
            'assigned_to' => $row['assigned_to'] ?? '-',
            'effectiveness_evaluated' => $row['effectiveness_evaluated'] ?? '-',
            'action_taken_effective' => $row['action_taken_effective'] ?? '-',
            'what_action_was_taken' => $row['what_action_was_taken'] ?? '-',
            'action_taken_by' => $row['action_taken_by'] ?? '-',
            'target_completion_date' => $row['target_completion_date'] ?? '-',
            'action_that_was_taken' => $row['action_that_was_taken'] ?? '-',
            'completed_by' => $row['completed_by'] ?? '-',
            'disposition_decision' => $row['disposition_decision'] ?? '-',
            'date_completed' => $row['date_completed'] ?? '-',
            'cpar_required' => $row['cpar_required'] ?? '-',
            'cpar_num' => $row['cpar_num'] ?? '-',
            'closed_by' => $row['closed_by'] ?? '-',
            'closure_date' => $row['closure_date'] ?? '-',
        ]);
    }
}
