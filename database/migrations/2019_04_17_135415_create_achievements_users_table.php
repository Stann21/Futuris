<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('achievement_title', '45');
            $table->string('achievement_description', '999');
            $table->string('achievement_img', '45');
            $table->integer('achievement_client');
            $table->string('achievement_subject', '45');
            $table->integer('achievement_subjectid');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements_users');
    }
}
