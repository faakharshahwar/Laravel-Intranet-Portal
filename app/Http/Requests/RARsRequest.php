<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RARsRequest extends FormRequest
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
            'date_identified' => 'required',
            'department' => 'required',
            'risk_type' => 'required',
            'risk_title' => 'required',
            'risk_description' => 'required',
            'risk_source' => 'required',
            'risk_category' => 'required',
        ];
    }
}
