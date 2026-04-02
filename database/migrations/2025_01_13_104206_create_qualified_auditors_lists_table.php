<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualifiedAuditorsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualified_auditors_lists', function (Blueprint $table) {
            $table->id();
            $table->string('auditor_name');
            $table->string('site');
            $table->string('auditor_status');
            $table->string('qualification_basis_1');
            $table->string('qualification_basis_2');
            $table->string('qualification_basis_3');
            $table->longText('comments')->nullable();
            $table->string('file_attachment_1')->nullable();
            $table->string('file_attachment_2')->nullable();
            $table->string('web_link_1')->nullable();
            $table->string('web_link_2')->nullable();
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
        Schema::dropIfExists('qualified_auditors_lists');
    }
}
