<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningGoalsHasAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_goals_has_achievements', function (Blueprint $table) {
            $table->integer("learning_goals_idlearning_goals");
            $table->integer('learning_goals_user_user_id');
            $table->integer('achievements_achievements_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_goals_has_achievements');
    }
}
