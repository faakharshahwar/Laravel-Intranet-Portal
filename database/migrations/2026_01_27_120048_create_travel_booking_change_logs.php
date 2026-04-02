<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelBookingChangeLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_booking_change_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_booking_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('status_at_time')->nullable(); // 0/1/2 or null
            $table->text('remarks')->nullable();

            // stores field changes like: {"client":{"old":"A","new":"B"}, ...}
            $table->json('changes')->nullable();

            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->foreign('travel_booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');
            // if you want FK:
            // $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_booking_change_logs');
    }
}
