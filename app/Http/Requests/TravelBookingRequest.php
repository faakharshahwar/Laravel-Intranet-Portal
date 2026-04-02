<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelBookingRequest extends FormRequest
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
            'booking_date' => 'required',
            'travel_type' => 'required',
            'purpose_of_travel' => 'required',
            'traveler' => 'required',
            'destination' => 'required',
            'client' => 'required',
            'departure_date' => 'required',
            'return_date' => 'required',
            'mode_of_travel' => 'required',
            'risk_status' => 'required',
            'remarks' => 'nullable|string|max:2000',
        ];
    }
}
