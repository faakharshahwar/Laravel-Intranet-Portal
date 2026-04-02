<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspectionReportRequest extends FormRequest
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
            'description' => 'required',
            'report_type' => 'required',
            'completion_date' => 'required',
            'status' => 'required',
            'attachment_1' => request()->has('old_attachment_1') ? 'nullable|file' : 'required|file',
        ];
    }
}
