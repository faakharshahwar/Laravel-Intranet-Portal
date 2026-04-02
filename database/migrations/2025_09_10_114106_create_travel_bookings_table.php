<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_date');
            $table->string('travel_type');
            $table->longText('purpose_of_travel');
            $table->string('management_approval_status')->nullable();
            $table->string('approver_name')->nullable();
            $table->string('approved_date')->nullable();
            $table->integer('traveler');
            $table->string('destination');
            $table->string('client');
            $table->string('departure_date');
            $table->string('return_date');
            $table->string('mode_of_travel');
            $table->string('booking_reference_pnr')->nullable();
            $table->string('passenger_last_name')->nullable();
            $table->string('estimated_travel_cost')->nullable();
            $table->string('actual_travel_cost')->nullable();
            $table->string('visa_requirement')->nullable();
            $table->string('travel_insurance_provider')->nullable();
            $table->longText('safety_notes')->nullable();
            $table->string('risk_status');
            $table->longText('additional_comments')->nullable();
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
        Schema::dropIfExists('travel_bookings');
    }
}
