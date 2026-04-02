<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcrs', function (Blueprint $table) {
            $table->id();
            $table->string('doc_id')->nullable();
            $table->string('title')->nullable();
            $table->string('rev')->nullable();
            $table->string('dcr_num')->nullable()->unique();
            $table->string('source_document')->nullable();
            $table->string('new_source_document')->nullable();
            $table->string('document_for_approval')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('approver_1')->nullable();
            $table->string('approver_2')->nullable();
            $table->string('approved_by_1')->nullable();
            $table->string('approved_by_2')->nullable();
            $table->string('document_approved')->nullable();
            $table->longText('approval_review_comments')->nullable();
            $table->longText('date_approved')->nullable();
            $table->longText('training_assessed')->nullable();
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
        Schema::dropIfExists('dcrs');
    }
}
