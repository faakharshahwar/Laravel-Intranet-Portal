<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecos', function (Blueprint $table) {
            $table->id();
            $table->string('eco_id')->nullable();
            $table->string('site')->nullable();
            $table->string('originator')->nullable();
            $table->string('date_originated')->nullable();
            $table->string('attachment_1')->nullable();
            $table->string('attachment_2')->nullable();
            $table->string('attachment_3')->nullable();
            $table->string('attachment_4')->nullable();
            $table->string('attachment_5')->nullable();
            $table->string('details_for_request')->nullable();
            $table->string('message_to_initiator')->nullable();
            $table->string('importance')->nullable();
            $table->string('eco_part_type')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->string('date_reviewed')->nullable();
            $table->string('submitted_by')->nullable();
            $table->boolean('approval_status')->nullable();
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
        Schema::dropIfExists('ecos');
    }
}
