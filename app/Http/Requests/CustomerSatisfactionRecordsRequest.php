<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSatisfactionRecordsRequest extends FormRequest
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
            'date_data_collected' => 'required',
            'customer_company_name' => 'required',
            'customer_contact' => 'required',
            'customer_location' => 'required',
            'site_representative' => 'required',
            'site' => 'required',
            'customer_service_assistance' => 'required',
            'quality_of_product' => 'required',
            'performance_vs_expectation' => 'required',
            'on_time_shipment' => 'required',
            'permission' => 'required',
            'like_a_sales_rep' => 'required',
        ];
    }
}
