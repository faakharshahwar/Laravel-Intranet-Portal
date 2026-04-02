<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditScheduleRequest extends FormRequest
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
            'audit_id' => 'required',
            'audit_type' => 'required',
            'sub_type' => 'required',
            'audit_year' => 'required',
            'status' => 'required',
        ];
    }
}
