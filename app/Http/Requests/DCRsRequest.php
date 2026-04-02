<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DCRsRequest extends FormRequest
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
            'document_for_approval' => 'mimes:csv,txt,png,jpeg,jpg,pdf,doc,docx,xls,xlsx',
        ];
    }
}
