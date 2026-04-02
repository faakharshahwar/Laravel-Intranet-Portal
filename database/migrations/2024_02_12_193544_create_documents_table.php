<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('management_system');
            $table->string('location')->nullable();
            $table->string('sub_location')->nullable();
            $table->string('document_type')->nullable();
            $table->string('title');
            $table->string('doc_id')->unique();
            $table->string('revision');
            $table->string('document_attachment')->nullable();
            $table->string('document_review_date')->nullable();
            $table->string('document_next_review_date')->nullable();
            $table->string('internal_folder')->nullable();
            $table->string('external_folder')->nullable();
            $table->string('distributor_folder')->nullable();
            $table->string('website_product_documents')->nullable();
            $table->string('website_technical_documents')->nullable();
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
            $table->string('master_document_attachment')->nullable();
            $table->string('training_completion_days_allowed')->nullable();
            $table->string('learning_time')->nullable();
            $table->string('training_note_for_training_history_comments')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
