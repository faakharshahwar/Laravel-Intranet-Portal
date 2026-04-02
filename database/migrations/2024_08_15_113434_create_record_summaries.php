<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordSummaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('record_title');
            $table->string('doc_id');
            $table->string('site');
            $table->string('location');
            $table->string('type');
            $table->string('file_manual_title');
            $table->string('maintained_by');
            $table->string('minimum_retention');
            $table->string('record_status');
            $table->longText('comments');
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
        Schema::dropIfExists('record_summaries');
    }
}
