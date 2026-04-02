<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalibratedDevicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site' => 'required',
            'calibration_category' => 'required',
            'calibration_device_front_image' => 'mimes:png,jpeg,jpg,heic,heif',
            'calibration_device_back_image' => 'mimes:png,jpeg,jpg,heic,heif',
            'calibration_report' => 'required',
            'calibration_supplier' => 'required',
            'serial_no' => 'required',
            'device_description' => 'required',
            'manufacturer' => 'required',
            'model' => 'required',
            'location' => 'required',
            'calibration_type' => 'required',
            'calibration_frequency' => 'required',
            'accuracy_required' => 'required',
            'standards_used' => 'required',
            'method_of_calibration' => 'required',
            'readings_nominal_values' => 'required',
            'readings_actual_values_1' => 'required',
            'readings_corrected_values' => 'required',
            'date_last_calibrated' => 'required',
            'next_calibration_due_date' => 'required',
            'temperature' => 'required',
            'temp_unit' => 'required',
            'humidity' => 'required',
            'calibrated_by' => 'required',
            'approved_by' => 'required',
            'device_status' => 'required',
            'calibration_status' => 'required',
            'attachment' => 'mimes:csv,txt,png,jpeg,jpg,pdf,doc,docx,xls,xlsx',
            'past_attachment_1' => 'mimes:csv,txt,png,jpeg,jpg,pdf,doc,docx,xls,xlsx',
            'past_attachment_2' => 'mimes:csv,txt,png,jpeg,jpg,pdf,doc,docx,xls,xlsx',
        ];
    }
}
