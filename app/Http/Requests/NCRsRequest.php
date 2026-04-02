<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NCRsRequest extends FormRequest
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
            'originating_site' => 'required',
            'results_area' => 'required',
            'responsible_site' => 'required',
            'nonconformance_type' => 'required',
            'originator' => 'required',
            'date_originated' => 'required',
        ];
    }
}
