<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExternalDocumentRequest extends FormRequest
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
            'doc_id' => 'required',
            'document_type' => 'required',
            'organization' => 'required',
            'title' => 'required',
            'effective_date' => 'required',
            'verification_date' => 'required',
            'verification_method' => 'required',
            'verified_by' => 'required',
            'next_verification_due_date' => 'required',
            'primary_location_held' => 'required',
            'comments' => 'required',
            'attachment' => 'mimes:csv,txt,png,jpeg,jpg,pdf,doc,docx,xls,xlsx',
        ];
    }
}
