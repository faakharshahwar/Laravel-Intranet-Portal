<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_history', function (Blueprint $table) {
            $table->id();
            $table->string('trr_id')->unique();
            $table->string('employee_name')->nullable();
            $table->string('assessment_date');
            $table->string('must_be_completed_by');
            $table->string('learning_session_title');
            $table->string('training_type')->nullable();
            $table->string('instructor');
            $table->string('learning_time');
            $table->string('learning_session_completion_date')->nullable();
            $table->string('link_to_learning_module')->nullable();
            $table->longText('comments')->nullable();
            $table->string('attachment_1')->nullable();
            $table->string('attachment_2')->nullable();
            $table->string('attachment_3')->nullable();
            $table->string('training_expiry_date')->nullable();
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
        Schema::dropIfExists('training_history');
    }
}
