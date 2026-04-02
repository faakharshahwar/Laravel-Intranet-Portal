<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMocrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mocrs', function (Blueprint $table) {
            $table->id();
            $table->string('change_requested_by');
            $table->string('date_requested');
            $table->string('mocr_id');
            $table->longText('proposed_qms_change');
            $table->longText('purpose_of_change');
            $table->longText('potential_consequence_of_change');
            $table->longText('impact_on_integrity_of_qms');
            $table->longText('availability_of_resources');
            $table->longText('allocation_or_reallocation');
            $table->longText('additional_considerations');
            $table->longText('change_authorized_by')->nullable();
            $table->longText('date_authorized')->nullable();
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
        Schema::dropIfExists('mocrs');
    }
}
