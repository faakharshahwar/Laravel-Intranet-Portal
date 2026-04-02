<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $id = $this->request->get('id');

        $rules = [
            'status' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'person_to_notify' => ['required'],
            'site' => ['required'],
            'current_job_title' => ['required'],
            'department' => ['required'],
            'work_phone' => ['required'],
            'date_of_birth' => ['required'],
            'home_airport'      => ['required','string'], // IATA
            'home_airport_text' => ['required','string','max:255'],
            'nationality' => ['required'],

            'residency'      => ['required','array','min:1'],
            'residency.*'    => ['string'],

            'work_permits'   => ['required','array','min:1'],
            'work_permits.*' => ['string'],

            'current_visas'  => ['required','array','min:1'],
            'current_visas.*'=> ['string'],

            'valid_us_visa' => ['required'],
            'passport_number' => ['required'],
            'passport_issuing_country' => ['required'],
            'passport_expiry_date' => ['required'],
            'traveler_numbers' => ['required'],
            'loyalty_numbers' => ['required'],
            'twic_card' => ['required'],
            'safety_training_list' => ['required'],
            'emergency_contact_name' => ['required'],
            'emergency_contact_phone' => ['required'],
        ];

        // Only require password if a new password is provided
        if ($this->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }
}
