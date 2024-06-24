<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_traits', function (Blueprint $table) {
            $table->id();
            $table->string('previsite')->nullable();
            $table->string('projet_valide')->nullable();
            $table->string('devis_signe')->nullable();
            $table->string('project_charge')->nullable();
            $table->string('additional_work')->nullable();
            $table->string('additional_work_payable')->nullable();
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
        Schema::dropIfExists('project_traits');
    }
}
