<?php

namespace App\Imports;

use App\Models\Modules\Hse;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HseImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Hse([
            'id' => $row['id'],
            'for_month_starting' => $row['for_month_starting'],
            'site' => $row['site'],
            'num_of_first_aids' => $row['num_of_first_aids'],
            'num_of_near_misses' => $row['num_of_near_misses'],
            'num_of_safety_violations' => $row['num_of_safety_violations'],
            'num_of_medical_cases' => $row['num_of_medical_cases'],
            'num_of_restricted_cases' => $row['num_of_restricted_cases'],
            'num_of_lost_time_cases' => $row['num_of_lost_time_cases'],
            'num_of_recordable_cases' => $row['num_of_recordable_cases'],
            'num_of_environmental_issues' => $row['num_of_environmental_issues'],
            'comments' => $row['comments'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
