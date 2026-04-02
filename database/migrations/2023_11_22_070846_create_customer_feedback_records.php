<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerFeedbackRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_feedback_records', function (Blueprint $table) {
            $table->id();
            $table->string('cfr_id')->nullable();
            $table->string('site');
            $table->string('type');
            $table->string('customer');
            $table->string('customer_location');
            $table->string('customer_contact');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->longText('description');
            $table->string('cfr_category')->nullable();
            $table->string('originator');
            $table->string('date_originated');
            $table->string('root_cause')->nullable();
            $table->longText('action_to_be_taken')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('target_completion_date')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('date_completed')->nullable();
            $table->longText('feedback_to_customer')->nullable();
            $table->string('feedback_by')->nullable();
            $table->string('effectiveness_evaluated')->nullable();
            $table->string('action_taken_effective')->nullable();
            $table->string('what_action_was_taken')->nullable();
            $table->string('action_taken_by')->nullable();
            $table->string('date_of_feedback')->nullable();
            $table->string('cpar_required')->nullable();
            $table->string('if_yes_cpar')->nullable();
            $table->string('attachment_field')->nullable();
            $table->string('photo_field')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('closure_date')->nullable();
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
        Schema::dropIfExists('customer_feedback_records');
    }
}
