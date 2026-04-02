<?php

namespace App\Imports;

use App\Models\Modules\FirstAids;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstAidImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FirstAids([
            'site' => $row['site'],
            'item_name' => $row['item_name'],
            'description' => $row['description'],
            'production_date' => $row['production_date'],
            'expiry_date' => $row['expiry_date'],
            'required_quantity' => $row['required_quantity'],
            'available_quantity' => $row['available_quantity'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
