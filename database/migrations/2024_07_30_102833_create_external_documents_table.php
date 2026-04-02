<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_documents', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('doc_id');
            $table->string('document_type');
            $table->string('organization');
            $table->string('title');
            $table->string('effective_date');
            $table->string('verification_date');
            $table->longText('verification_method');
            $table->string('verified_by');
            $table->string('next_verification_due_date');
            $table->longText('primary_location_held');
            $table->string('attachment')->nullable();;
            $table->string('web_linked_file')->nullable();;
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
        Schema::dropIfExists('external_documents');
    }
}
