<?php

namespace App\Imports;

use App\Models\Modules\CustomerSatisfactionRecords;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomerSatisfactionReportImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CustomerSatisfactionRecords([
            'csr_id' => $row['csr_id'],
            'date_data_collected' => $row['date_data_collected'],
            'customer_company_name' => $row['customer_company_name'],
            'customer_contact' => $row['customer_contacts'],
            'customer_location' => $row['customer_location'],
            'contact_phone' => $row['contact_phone_if_applicable'],
            'contact_email_address' => $row['contact_email_address_if_any'],
            'site_representative' => $row['site_representative'],
            'site' => $row['site'],
            'customer_service_assistance' => $row['customer_service_and_assistance'],
            'quality_of_product' => $row['quality_of_productservice'],
            'performance_vs_expectation' => $row['our_performance_vs_expectations'],
            'on_time_shipment' => $row['on_time_shipment'],
            'permission' => $row['does_company_have_permission_to_reprint_your_comments'],
            'like_a_sales_rep' => $row['like_a_sales_rep_to_call'],
            'comments' => $row['average_all_applicable_ratings_comments_suggestions_if_any'],
            'cfr_no' => $row['cfr_if_any'],
            'sales_note' => $row['sales_notes_if_any'],
        ]);
    }
}
