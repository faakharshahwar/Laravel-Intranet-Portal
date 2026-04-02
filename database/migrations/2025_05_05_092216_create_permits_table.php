<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('permit_type')->nullable();
            $table->string('permit_id')->nullable();
            $table->string('agency_type')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('attachment')->nullable();
            $table->string('copy_of_permit')->nullable();
            $table->string('monthly_requirements')->nullable();
            $table->string('quarterly_requirements')->nullable();
            $table->string('annual_requirements')->nullable();
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
        Schema::dropIfExists('permits');
    }
}
