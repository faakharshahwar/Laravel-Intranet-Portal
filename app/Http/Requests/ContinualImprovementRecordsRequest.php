<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContinualImprovementRecordsRequest extends FormRequest
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
            'cir_concise_description' => 'required',
            'improvement_opportunity' => 'required',
            'originator' => 'required',
            'date_originated' => 'required',
            'cir_type' => 'required',
            'file_attachment_1' => 'mimes:csv,txt,png,jpeg,jpg,pdf',
            'file_attachment_2' => 'mimes:csv,txt,png,jpeg,jpg,pdf',
        ];
    }
}
