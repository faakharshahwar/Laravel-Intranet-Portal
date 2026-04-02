<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcosItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecos_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eco_id');
            $table->foreign('eco_id')->references('id')->on('ecos')->onDelete('cascade');
            $table->string('current_part_number');
            $table->string('drawing')->nullable();
            $table->string('revision')->nullable();
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
        Schema::dropIfExists('ecos_items');
    }
}
