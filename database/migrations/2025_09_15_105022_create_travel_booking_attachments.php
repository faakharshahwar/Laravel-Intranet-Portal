<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelBookingAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_booking_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_booking_id');
            $table->foreign('travel_booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');
            $table->string('attachment_type');
            $table->string('attachment_1')->nullable();
            $table->string('attachment_2')->nullable();
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
        Schema::dropIfExists('travel_booking_attachments');
    }
}
