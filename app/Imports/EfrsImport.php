<?php

namespace App\Imports;

use App\Models\Modules\Efr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EfrsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Efr([
            'id' => $row['id'],
            'site' => $row['site'],
            'type' => $row['type'],
            'interested_party' => $row['interested_party'],
            'ip_location' => $row['ip_location'],
            'ip_contact' => $row['ip_contact'],
            'ip_contact_telephone' => $row['ip_contact_telephone'],
            'feedback' => $row['feedback'],
            'originator' => $row['originator'],
            'date_originated' => $row['date_originated'],
            'action_taken' => $row['action_taken'],
            'completed_by' => $row['completed_by'],
            'feedback_to_ip' => $row['feedback_to_ip'],
            'feedback_to_ip_by' => $row['feedback_to_ip_by'],
            'date_of_feedback' => $row['date_of_feedback'],
            'closed_by' => $row['closed_by'],
            'closure_date' => $row['closure_date'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
