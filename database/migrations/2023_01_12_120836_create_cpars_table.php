<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCparsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpars', function (Blueprint $table) {
            $table->id();
            $table->string('cpar_id');
            $table->string('site');
            $table->string('date_of_issue');
            $table->string('cpar_type');
            $table->string('reason');
            $table->string('reason_if_other');
            $table->longText('description_of_issue');
            $table->string('originator');
            $table->string('date_originated');
            $table->string('results_area');
            $table->string('responsible_manager');
            $table->string('manager_acceptance_date')->nullable();
            $table->string('root_cause')->nullable();
            $table->string('attachment_1')->nullable();
            $table->string('attachment_2')->nullable();
            $table->longText('action_to_be_taken')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('target_completion_date')->nullable();
            $table->string('date_action_was_completed')->nullable();
            $table->longText('effectiveness_evaluated')->nullable();
            $table->string('action_taken_effective')->nullable();
            $table->string('what_action_was_taken')->nullable();
            $table->string('action_taken_by')->nullable();
            $table->string('documents_revised')->nullable();
            $table->string('date_documents_revised')->nullable();
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
        Schema::dropIfExists('cpars');
    }
}
