<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('example_project')->nullable();
            $table->string('question_cag')->nullable();
            $table->string('access_door')->nullable();
            $table->string('boiler_room_size')->nullable();
            $table->string('height')->nullable();
            $table->string('boiler_location')->nullable();
            $table->string('accessibility')->nullable();
            $table->string('other_question')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
