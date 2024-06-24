<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityControlQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     
    public function up()
    {
        Schema::create('quality_control_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quality_control_id');
            $table->string('type')->nullable();
            $table->string('question_title')->nullable();
            $table->string('question_name')->nullable();
            $table->string('question_type')->nullable();
            $table->string('question_required')->nullable();
            $table->string('question_options')->nullable();
            $table->string('header_title')->nullable();
            $table->string('header_color')->nullable();
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
        Schema::dropIfExists('quality_control_questions');
    }
}
