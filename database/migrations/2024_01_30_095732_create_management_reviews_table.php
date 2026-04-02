<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('date_of_management_review');
            $table->string('site');
            $table->string('status');
            $table->string('agenda')->nullable();
            $table->string('minutes_attachment')->nullable();
            $table->string('attachment_1')->nullable();
            $table->string('attachment_2')->nullable();
            $table->string('attachment_3')->nullable();
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
        Schema::dropIfExists('management_reviews');
    }
}
