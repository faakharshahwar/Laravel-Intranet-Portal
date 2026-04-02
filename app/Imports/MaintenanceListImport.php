<?php

namespace App\Imports;

use App\Models\Modules\MaintenanceList;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class MaintenanceListImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MaintenanceList([
            'equipment_id' => $row['equipment_id'],
            'site' => $row['site'],
            'serial_num' => $row['serial_num'],
            'equipment_description' => $row['equipment_description'],
            'manufacturer' => $row['manufacturer'],
            'model' => $row['model'],
            'location' => $row['location'],
            'frequency' => $row['frequency'],
            'last_maintenance_performed' => $row['last_maintenance_performed'],
            'next_maintenance_performed' => $row['next_maintenance_performed'],
            'maintenance_by' => $row['maintenance_by'],
            'comments' => $row['comments'],
            'equipment_status' => $row['equipment_status'],
            'action_required' => $row['action_required'],
            'attachment' => $row['attachment'],
        ]);
    }
}
