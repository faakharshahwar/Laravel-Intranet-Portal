<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFeedbackRecordsRequest extends FormRequest
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
            'customer' => 'required',
            'customer_location' => 'required',
            'customer_contact' => 'required',
            'description' => 'required',
            'originator' => 'required',
            'date_originated' => 'required',
            'attachment_field' => 'mimes:csv,txt,png,jpeg,jpg,pdf',
            'photo_field' => 'mimes:csv,txt,png,jpeg,jpg,pdf',
        ];
    }
}
