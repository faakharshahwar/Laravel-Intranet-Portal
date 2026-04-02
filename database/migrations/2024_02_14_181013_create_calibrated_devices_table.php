<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibratedDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrated_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->unique();
            $table->string('site');
            $table->string('calibration_device_front_image')->nullable();
            $table->string('calibration_device_back_image')->nullable();
            $table->string('calibration_category');
            $table->string('calibration_report');
            $table->string('calibration_supplier');
            $table->string('serial_no');
            $table->string('device_description');
            $table->string('manufacturer');
            $table->string('model');
            $table->string('location');
            $table->string('calibration_type');
            $table->string('calibration_frequency');
            $table->string('accuracy_required');
            $table->string('standards_used');
            $table->string('method_of_calibration');
            $table->string('readings_nominal_values');
            $table->string('readings_actual_values_1');
            $table->string('readings_actual_values_2')->nullable();
            $table->string('readings_actual_values_3')->nullable();
            $table->string('readings_corrected_values');
            $table->string('date_last_calibrated');
            $table->string('next_calibration_due_date');
            $table->string('temperature');
            $table->string('temp_unit');
            $table->string('humidity');
            $table->string('calibrated_by');
            $table->string('approved_by');
            $table->string('device_status');
            $table->string('calibration_status');
            $table->string('tp_calibrated_results_as_found')->nullable();
            $table->string('tp_calibrated_results_as_left')->nullable();
            $table->string('attachment')->nullable();
            $table->string('ncr')->nullable();
            $table->longText('comments')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('calibrated_devices');
    }
}
