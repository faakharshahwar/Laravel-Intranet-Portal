<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncrs', function (Blueprint $table) {
            $table->id();
            $table->string('ncr_id')->nullable();
            $table->string('originating_site');
            $table->string('date_of_issue')->nullable();
            $table->string('results_area');
            $table->string('responsible_site');
            $table->string('quantity')->nullable();
            $table->string('process_description')->nullable();
            $table->string('order_num')->nullable();
            $table->string('nonconformance_type')->nullable();
            $table->string('customer_if_applicable')->nullable();
            $table->longText('description_of_nonconformance')->nullable();
            $table->string('originator');
            $table->string('date_originated');
            $table->string('ncr_category')->nullable();
            $table->string('system_type')->nullable();
            $table->string('disposition_decision')->nullable();
            $table->longText('disposition_if_other')->nullable();
            $table->longText('root_cause')->nullable();
            $table->longText('action_to_be_taken')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('target_date')->nullable();
            $table->longText('comments_if_any')->nullable();
            $table->string('authorized_by')->nullable();
            $table->string('authorization_date')->nullable();
            $table->longText('action_taken')->nullable();
            $table->string('effectiveness_evaluated')->nullable();
            $table->string('action_taken_effective')->nullable();
            $table->string('what_action_was_taken')->nullable();
            $table->string('action_taken_by')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('date_completed')->nullable();
            $table->string('cpar_required')->nullable();
            $table->string('cpar_num')->nullable();
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
        Schema::dropIfExists('ncrs');
    }
}
