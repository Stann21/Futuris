<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_goals', function (Blueprint $table) {
            $table->bigIncrements('template_id');
            $table->integer('template_category')->nullable();
            $table->string('template_name');
            $table->string('template_icon');
            $table->string('template_role');
            $table->string('template_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_goals');
    }
}
