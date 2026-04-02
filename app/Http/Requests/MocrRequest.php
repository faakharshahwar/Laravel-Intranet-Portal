<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MocrRequest extends FormRequest
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
            'change_requested_by' => 'required',
            'date_requested' => 'required',
            'proposed_qms_change' => 'required',
            'purpose_of_change' => 'required',
            'potential_consequence_of_change' => 'required',
            'impact_on_integrity_of_qms' => 'required',
            'availability_of_resources' => 'required',
            'allocation_or_reallocation' => 'required',
            'additional_considerations' => 'required',
            'change_authorized_by' => 'required',
            'date_authorized' => 'required',
        ];
    }
}
