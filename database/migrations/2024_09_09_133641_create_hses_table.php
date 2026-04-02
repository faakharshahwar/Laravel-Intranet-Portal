<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hses', function (Blueprint $table) {
            $table->id();
            $table->string('for_month_starting');
            $table->string('site');
            $table->string('num_of_first_aids')->nullable();
            $table->string('num_of_near_misses')->nullable();
            $table->string('num_of_safety_violations')->nullable();
            $table->string('num_of_medical_cases')->nullable();
            $table->string('num_of_restricted_cases')->nullable();
            $table->string('num_of_lost_time_cases')->nullable();
            $table->string('num_of_recordable_cases')->nullable();
            $table->string('num_of_enviromental_issues')->nullable();
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('hses');
    }
}
