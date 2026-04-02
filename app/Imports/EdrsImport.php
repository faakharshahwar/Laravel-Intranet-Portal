<?php

namespace App\Imports;

use App\Models\Modules\Edr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EdrsImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Edr([
            'id' => $row['id'],
            'edr_id' => $row['edr_id'],
            'date_and_time_drill' => $row['date_and_time_drill'],
            'site' => $row['site'],
            'type_of_emergency_simulated' => $row['type_of_emergency_simulated'],
            'person_conducting_the_drill' => $row['person_conducting_the_drill'],
            'notification_used' => $row['notification_used'],
            'staff_on_duty' => $row['staff_on_duty'],
            'attachment_staff_participating' => $row['attachment_staff_participating'],
            'number_evacuated' => $row['number_evacuated'],
            'weather_conditions' => $row['weather_conditions'],
            'time_required' => $row['time_required'],
            'problems_encountered' => $row['problems_encountered'],
            'cpars' => $row['cpars'],
            'comments' => $row['comments'],
            'photo_1_description' => $row['photo_1_description'],
            'photo_1' => $row['photo_1'],
            'photo_2_description' => $row['photo_2_description'],
            'photo_2' => $row['photo_2'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }

    public function rules(): array
    {
        return [
            'edr_id' => \Illuminate\Validation\Rule::unique('edrs', 'edr_id'),
        ];
    }
}
