<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSatisfactionRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_satisfaction_records', function (Blueprint $table) {
            $table->id();
            $table->string('csr_id')->nullable();
            $table->string('date_data_collected')->nullable();
            $table->string('customer_company_name')->nullable();
            $table->string('customer_contact')->nullable();
            $table->string('customer_location')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email_address')->nullable();
            $table->string('site_representative')->nullable();
            $table->string('site')->nullable();
            $table->string('customer_service_assistance')->nullable();
            $table->string('quality_of_product')->nullable();
            $table->string('performance_vs_expectation')->nullable();
            $table->string('on_time_shipment')->nullable();
            $table->longText('permission')->nullable();
            $table->string('like_a_sales_rep')->nullable();
            $table->string('comments')->nullable();
            $table->string('cfr_no')->nullable();
            $table->string('sales_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_satisfaction_records');
    }
}
