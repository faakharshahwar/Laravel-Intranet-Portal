<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QualifiedAuditorsListRequest extends FormRequest
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
            'auditor_name' => 'required',
            'site' => 'required',
            'auditor_status' => 'required',
            'qualification_basis_1' => 'required',
            'qualification_basis_2' => 'required',
            'qualification_basis_3' => 'required',
        ];
    }
}
