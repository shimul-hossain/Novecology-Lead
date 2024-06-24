<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_installations', function (Blueprint $table) {
            $table->id();
            $table->date('installation_date')->nullable();
            $table->string('schedule')->nullable();
            $table->string('status')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('intervention_installations');
    }
}
