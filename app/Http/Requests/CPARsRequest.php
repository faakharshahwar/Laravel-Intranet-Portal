<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CPARsRequest extends FormRequest
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
            'date_of_issue' => 'required',
            'cpar_type' => 'required',
            'reason' => 'required',
            'reason_if_other' => 'required',
            'description_of_issue' => 'required',
            'originator' => 'required',
            'date_originated' => 'required',
            'results_area' => 'required',
            'responsible_manager' => 'required',
        ];
    }
}
