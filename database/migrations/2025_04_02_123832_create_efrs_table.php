<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEfrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efrs', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('type');
            $table->string('interested_party');
            $table->string('ip_location')->nullable();
            $table->string('ip_contact')->nullable();
            $table->string('ip_contact_telephone')->nullable();
            $table->string('feedback');
            $table->string('originator');
            $table->string('date_originated');
            $table->string('action_taken')->nullable();
            $table->string('completed_by')->nullable();
            $table->longText('feedback_to_ip')->nullable();
            $table->string('feedback_to_ip_by')->nullable();
            $table->string('date_of_feedback')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('closure_date')->nullable();
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
        Schema::dropIfExists('efrs');
    }
}
