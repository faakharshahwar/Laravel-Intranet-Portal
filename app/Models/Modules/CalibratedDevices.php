<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibratedDevices extends Model
{
    use HasFactory;

    protected $fillable = [
        'cd_num',
        'device_id',
        'calibration_device_front_image',
        'calibration_device_back_image',
        'site',
        'calibration_category',
        'calibration_report',
        'calibration_supplier',
        'serial_no',
        'device_description',
        'manufacturer',
        'model',
        'location',
        'calibration_type',
        'calibration_frequency',
        'accuracy_required',
        'standards_used',
        'method_of_calibration',
        'readings_nominal_values',
        'readings_actual_values_1',
        'readings_actual_values_2',
        'readings_actual_values_3',
        'readings_corrected_values',
        'date_last_calibrated',
        'next_calibration_due_date',
        'temperature',
        'temp_unit',
        'humidity',
        'calibrated_by',
        'approved_by',
        'device_status',
        'calibration_status',
        'tp_calibrated_results_as_found',
        'tp_calibrated_results_as_left',
        'attachment',
        'ncr',
        'comments',
        'created_by',
        'updated_by',
    ];
}
