<?php

namespace App\Imports;

use App\Models\Modules\Rars;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RarsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rars([
            'rar_id' => $row['rar_id'],
            'site' => $row['site'],
            'date_identified' => $row['date_identified'],
            'department' => $row['department'],
            'risk_type' => $row['risk_type'],
            'risk_title' => $row['risk_title'],
            'risk_description' => $row['risk_description'],
            'risk_source' => $row['risk_source'],
            'risk_category' => $row['risk_category'],
            'risk_probability' => $row['risk_probability'],
            'risk_impact' => $row['risk_impact'],
            'mitigation' => $row['mitigation'],
            'risk_priority' => $row['risk_priority'],
            'responsible_person' => $row['responsible_person'],
            'next_risk_review_date' => $row['next_risk_review_date'],
            'effectiveness_evaluated' => $row['effectiveness_evaluated'],
            'action_taken_effective' => $row['action_taken_effective'],
            'what_action_was_taken' => $row['what_action_was_taken'],
            'action_taken_by' => $row['action_taken_by'],
            'cpar_num' => $row['cpar_num'],
            'status' => $row['status'],
            'comments' => $row['comments'],
            'closed_date' => $row['closed_date'],
        ]);
    }
}
