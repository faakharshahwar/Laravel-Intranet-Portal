<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_reports', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('description');
            $table->string('report_type');
            $table->string('completion_date');
            $table->string('next_due_date')->nullable();
            $table->string('attachment_1');
            $table->string('attachment_2')->nullable();
            $table->string('attachment_3')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('inspection_reports');
    }
}
