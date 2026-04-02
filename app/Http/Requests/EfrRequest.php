<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EfrRequest extends FormRequest
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
            'type' => 'required',
            'interested_party' => 'required',
            'feedback' => 'required',
            'originator' => 'required',
            'date_originated' => 'required',
        ];
    }
}
