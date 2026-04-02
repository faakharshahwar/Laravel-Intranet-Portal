<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinualImprovementRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continual_improvement_records', function (Blueprint $table) {
            $table->id();
            $table->string('cir_id')->nullable();
            $table->string('site');
            $table->string('cir_concise_description');
            $table->longText('improvement_opportunity');
            $table->string('originator');
            $table->string('date_originated');
            $table->string('cir_type');
            $table->string('department')->nullable();
            $table->string('responsible_manager')->nullable();
            $table->string('responsible_mgr_approval_date')->nullable();
            $table->longText('action_to_be_taken')->nullable();
            $table->string('file_attachment_1')->nullable();
            $table->string('file_attachment_2')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('target_completion_date')->nullable();
            $table->longText('action_that_was_taken')->nullable();
            $table->string('action_completed_by')->nullable();
            $table->string('date_action_was_completed')->nullable();
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
        Schema::dropIfExists('continual_improvement_records');
    }
}
