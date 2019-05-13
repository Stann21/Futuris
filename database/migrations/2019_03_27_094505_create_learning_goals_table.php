<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_goals', function (Blueprint $table) {
            $table->bigIncrements('learning_id');
            $table->string('learning_category', '45');
            $table->string('learning_name', '45');
            $table->integer('user_id');
            $table->string('learning_icon', '45');
            $table->string('learning_role', '45');
            $table->string('learning_description')->nullable();
            $table->string('learning_finished')->nullable();
            $table->integer('learning_finish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_goals');
    }
}
