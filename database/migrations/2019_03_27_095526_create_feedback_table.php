<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->bigIncrements('feedback_id');
            $table->string('feedback_client', '45');
            $table->string('feedback_mentor', '45');
            $table->string('feedback_description', '999');
            $table->integer('feedback_role');
            $table->integer('feedback_onid');
            //Change the following: Browserweergavetransformaties: Date Format & Browserweergavetransformatieopties: 0,'%d-%m-%Y','local'
            $table->date('feedback_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
