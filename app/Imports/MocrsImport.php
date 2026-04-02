<?php

namespace App\Imports;

use App\Models\Modules\Mocr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MocrsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mocr([
            'change_requested_by' => $row['change_requested_by'] ?? '-',
            'date_requested' => $row['date_requested'] ?? '-',
            'mocr_id' => $row['mocr_id'] ?? '-',
            'proposed_qms_change' => $row['proposed_qms_change'] ?? '-',
            'purpose_of_change' => $row['purpose_of_change'] ?? '-',
            'potential_consequence_of_change' => $row['potential_consequence_of_change'] ?? '-',
            'impact_on_integrity_of_qms' => $row['impact_on_integrity_of_qms'] ?? '-',
            'availability_of_resources' => $row['availability_of_resources'] ?? '-',
            'allocation_or_reallocation' => $row['allocation_or_reallocation'] ?? '-',
            'additional_considerations' => $row['additional_considerations'] ?? '-',
            'change_authorized_by' => $row['change_authorized_by'] ?? '-',
            'date_authorized' => $row['date_authorized'] ?? '-',
            'created_at' => $row['created_at'] ?? '-',
            'updated_at' => $row['updated_at'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            'mocr_id' => \Illuminate\Validation\Rule::unique('mocrs', 'mocr_id'),
        ];
    }
}
