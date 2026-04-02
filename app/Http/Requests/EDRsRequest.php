<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EDRsRequest extends FormRequest
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
            'date_and_time_drill' => 'required',
            'site' => 'required',
            'type_of_emergency_simulated' => 'required',
            'person_conducting_the_drill' => 'required',
            'notification_used' => 'required',
            'staff_on_duty' => 'required',
            'number_evacuated' => 'required',
            'weather_conditions' => 'required',
            'time_required' => 'required',
            'problems_encountered' => 'required',
        ];
    }
}
