<?php

namespace App\Imports;

use App\Models\Modules\CalibratedDevices;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class CalibratedDevicesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CalibratedDevices([
            'device_id' => $row['device_id'] ?? '-',
            'calibration_device_front_image' => $row['calibration_device_front_image'] ?? '-',
            'calibration_device_back_image' => $row['calibration_device_back_image'] ?? '-',
            'site' => $row['site'] ?? '-',
            'calibration_category' => $row['calibration_category'] ?? '-',
            'calibration_report' => $row['calibration_report'] ?? '-',
            'calibration_supplier' => $row['calibration_supplier'] ?? '-',
            'serial_no' => $row['serial_no'] ?? '-',
            'device_description' => $row['device_description'] ?? '-',
            'manufacturer' => $row['manufacturer'] ?? '-',
            'model' => $row['model'] ?? '-',
            'location' => $row['location'] ?? '-',
            'calibration_type' => $row['calibration_type'] ?? '-',
            'calibration_frequency' => $row['calibration_frequency'] ?? '-',
            'accuracy_required' => $row['accuracy_required'] ?? '-',
            'standards_used' => $row['standards_used'] ?? '-',
            'method_of_calibration' => $row['method_of_calibration'] ?? '-',
            'readings_nominal_values' => $row['readings_nominal_values'] ?? '-',
            'readings_actual_values_1' => $row['readings_actual_values_1'] ?? '-',
            'readings_actual_values_2' => $row['readings_actual_values_2'] ?? '-',
            'readings_actual_values_3' => $row['readings_actual_values_3'] ?? '-',
            'readings_corrected_values' => $row['readings_corrected_values'] ?? '-',
            'date_last_calibrated' => $row['date_last_calibrated'] ?? '-',
            'next_calibration_due_date' => $row['next_calibration_due_date'] ?? '-',
            'temperature' => $row['temperature'] ?? '-',
            'temp_unit' => $row['temp_unit'] ?? '-',
            'humidity' => $row['humidity'] ?? '-',
            'calibrated_by' => $row['calibrated_by'] ?? '-',
            'approved_by' => $row['approved_by'] ?? '-',
            'device_status' => $row['device_status'] ?? '-',
            'calibration_status' => $row['calibration_status'] ?? '-',
            'tp_calibrated_results_as_found' => $row['tp_calibrated_results_as_found'] ?? '-',
            'tp_calibrated_results_as_left' => $row['tp_calibrated_results_as_left'] ?? '-',
            'attachment' => $row['attachment'] ?? '-',
            'ncr' => $row['ncr'] ?? '-',
            'comments' => $row['comments'] ?? '-',
            'created_by' => $row['created_by'] ?? '-',
            'updated_by' => $row['updated_by'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            'device_id' => \Illuminate\Validation\Rule::unique('calibrated_devices', 'device_id'),
        ];
    }
}
