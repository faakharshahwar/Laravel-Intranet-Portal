<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edrs', function (Blueprint $table) {
            $table->id();
            $table->string('edr_id');
            $table->dateTime('date_and_time_drill');
            $table->string('site');
            $table->string('type_of_emergency_simulated');
            $table->string('person_conducting_the_drill');
            $table->string('notification_used');
            $table->string('staff_on_duty');
            $table->string('attachment_staff_participating')->nullable();
            $table->string('number_evacuated');
            $table->string('weather_conditions');
            $table->string('time_required');
            $table->string('problems_encountered');
            $table->string('cpars')->nullable();
            $table->string('comments')->nullable();
            $table->string('photo_1_description')->nullable();
            $table->string('photo_1')->nullable();
            $table->string('photo_2_description')->nullable();
            $table->string('photo_2')->nullable();
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
        Schema::dropIfExists('edrs');
    }
}
