<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSatisfactionRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'csr_id',
        'date_data_collected',
        'customer_company_name',
        'customer_contact',
        'customer_location',
        'contact_phone',
        'contact_email_address',
        'site_representative',
        'site',
        'customer_service_assistance',
        'quality_of_product',
        'performance_vs_expectation',
        'on_time_shipment',
        'permission',
        'like_a_sales_rep',
        'comments',
        'cfr_no',
        'sales_note',
    ];
}
