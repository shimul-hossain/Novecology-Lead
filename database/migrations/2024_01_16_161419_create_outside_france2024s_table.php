<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsideFrance2024sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outside_france2024s', function (Blueprint $table) {
            $table->id();
            $table->string('person');
            $table->integer('grand_precaire');
            $table->integer('precaire');
            $table->integer('intermediaire');
            $table->integer('classique');
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
        Schema::dropIfExists('outside_france2024s');
    }
}
