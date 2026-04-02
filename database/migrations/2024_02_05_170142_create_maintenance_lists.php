<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_lists', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_id');
            $table->string('site');
            $table->string('serial_num');
            $table->longText('equipment_description');
            $table->string('manufacturer');
            $table->string('model');
            $table->string('location');
            $table->string('frequency');
            $table->string('last_maintenance_performed');
            $table->string('next_maintenance_performed');
            $table->string('maintenance_by');
            $table->longText('comments')->nullable();
            $table->string('equipment_status');
            $table->string('action_required');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('maintenance_lists');
    }
}
