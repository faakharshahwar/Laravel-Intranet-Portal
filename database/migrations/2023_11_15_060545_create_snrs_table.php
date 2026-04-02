<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snrs', function (Blueprint $table) {
            $table->id();
            $table->string('snr_id')->nullable();
            $table->string('site');
            $table->string('origination_date');
            $table->string('supplier');
            $table->string('supplier_representative')->nullable();
            $table->string('our_po')->nullable();
            $table->string('supplier_order')->nullable();
            $table->string('product_name');
            $table->string('quantity')->nullable();
            $table->string('product_description')->nullable();
            $table->string('supplier_rma')->nullable();
            $table->string('requisition')->nullable();
            $table->string('sales_order')->nullable();
            $table->string('customer')->nullable();
            $table->string('other')->nullable();
            $table->longText('description_of_nonconformance');
            $table->string('originator');
            $table->longText('root_cause')->nullable();
            $table->longText('action_to_be_taken')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('effectiveness_evaluated')->nullable();
            $table->string('action_taken_effective')->nullable();
            $table->string('what_action_was_taken')->nullable();
            $table->string('action_taken_by')->nullable();
            $table->string('target_completion_date')->nullable();
            $table->string('action_that_was_taken')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('disposition_decision')->nullable();
            $table->string('date_completed')->nullable();
            $table->string('cpar_required')->nullable();
            $table->string('cpar_num')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('closure_date')->nullable();
            $table->string('file_attachment_1')->nullable();
            $table->string('file_attachment_2')->nullable();
            $table->string('file_attachment_3')->nullable();
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
        Schema::dropIfExists('snrs');
    }
}
