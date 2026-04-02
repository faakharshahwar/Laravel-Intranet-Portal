<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingHistoryRequest extends FormRequest
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
            'employee_name' => 'required',
            'assessment_date' => 'required',
            'must_be_completed_by' => 'required',
            'learning_session_title' => 'required',
            'instructor' => 'required',
            'learning_time' => 'required',
            'attachment_1' => 'mimes:pdf',
            'attachment_2' => 'mimes:pdf',
            'attachment_3' => 'mimes:pdf',
        ];
    }
}
