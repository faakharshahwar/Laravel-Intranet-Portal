<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('status')->nullable();
            $table->string('person_to_notify')->nullable();
            $table->string('site')->nullable();
            $table->string('current_job_title')->nullable();
            $table->string('department')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('home_airport')->nullable();
            $table->string('nationality')->nullable();
            $table->string('residency')->nullable();
            $table->string('work_permits')->nullable();
            $table->string('current_visas')->nullable();
            $table->string('valid_us_visa')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_issuing_country')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->string('twic_card')->nullable();
            $table->string('safety_training_list')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('restricted_countries')->nullable();
            $table->string('results_area_1')->nullable();
            $table->string('results_area_2')->nullable();
            $table->string('results_area_3')->nullable();
            $table->string('results_area_4')->nullable();
            $table->string('results_area_5')->nullable();
            $table->string('results_area_6')->nullable();
            $table->string('results_area_7')->nullable();
            $table->string('results_area_8')->nullable();
            $table->string('results_area_9')->nullable();
            $table->string('results_area_10')->nullable();
            $table->string('results_area_11')->nullable();
            $table->string('results_area_12')->nullable();
            $table->integer('dev_user');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
