<?php

namespace App\Imports;

use App\Models\Modules\Permits;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PermitsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Permits([
            'site' => $row['site'],
            'permit_type' => $row['permit_type'],
            'permit_id' => $row['permit_id'],
            'agency_type' => $row['agency_type'],
            'agency_name' => $row['agency_name'],
            'expiration_date' => $row['expiration_date'],
            'attachment' => $row['attachment'],
            'copy_of_permit' => $row['copy_of_permit'],
            'monthly_requirements' => $row['monthly_requirements'],
            'quarterly_requirements' => $row['quarterly_requirements'],
            'annual_requirements' => $row['annual_requirements'],
            'comments' => $row['comments'],
        ]);
    }
}
