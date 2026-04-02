<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('audit_id');
            $table->string('audit_type');
            $table->string('sub_type');
            $table->string('start_date')->nullable();
            $table->string('dates')->nullable();
            $table->string('audit_year');
            $table->string('status');
            $table->string('audit_completion_date')->nullable();
            $table->string('num_of_issues')->nullable();
            $table->longText('comments')->nullable();
            $table->string('audit_schedule')->nullable();
            $table->string('audit_checklist')->nullable();
            $table->string('audit_report')->nullable();
            $table->string('abs_cpar_acceptance')->nullable();
            $table->string('nonconformity_note_attachment')->nullable();
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
        Schema::dropIfExists('audit_schedules');
    }
}
