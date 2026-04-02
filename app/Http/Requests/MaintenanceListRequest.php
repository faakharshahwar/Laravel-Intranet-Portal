<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceListRequest extends FormRequest
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
            'equipment_id' => 'required',
            'site' => 'required',
            'serial_num' => 'required',
            'equipment_description' => 'required',
            'manufacturer' => 'required',
            'model' => 'required',
            'location' => 'required',
            'frequency' => 'required',
            'last_maintenance_performed' => 'required',
            'next_maintenance_performed' => 'required',
            'maintenance_by' => 'required',
            'equipment_status' => 'required',
        ];
    }
}
