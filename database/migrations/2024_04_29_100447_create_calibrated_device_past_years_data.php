<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibratedDevicePastYearsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrated_device_past_years_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calibrated_device_id');
            $table->foreign('calibrated_device_id')->references('id')->on('calibrated_devices')->onDelete('cascade');
            $table->string('past_year');
            $table->string('past_attachment_1')->nullable();
            $table->string('past_attachment_2')->nullable();
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
        Schema::dropIfExists('calibrated_device_past_years_data');
    }
}
