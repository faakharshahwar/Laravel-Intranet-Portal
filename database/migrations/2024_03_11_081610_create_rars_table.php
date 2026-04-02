<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rars', function (Blueprint $table) {
            $table->id();
            $table->string('rar_id')->nullable();
            $table->string('site');
            $table->string('date_identified');
            $table->string('department');
            $table->string('risk_type');
            $table->string('risk_title');
            $table->longText('risk_description');
            $table->string('risk_source');
            $table->string('risk_category');
            $table->string('risk_probability')->nullable();
            $table->string('risk_impact')->nullable();
            $table->string('management_system')->nullable();
            $table->longText('mitigation')->nullable();
            $table->string('risk_priority')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('next_risk_review_date')->nullable();
            $table->string('effectiveness_evaluated')->nullable();
            $table->string('action_taken_effective')->nullable();
            $table->string('what_action_was_taken')->nullable();
            $table->string('action_taken_by')->nullable();
            $table->string('cpar_num')->nullable();
            $table->string('status')->nullable();
            $table->longText('comments')->nullable();
            $table->string('closed_date')->nullable();
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
        Schema::dropIfExists('rars');
    }
}
