<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCumacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumacs', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('mode_de_chauffage');
            $table->string('cef_intial');
            $table->string('cef_finale');
            $table->string('gain_cef');
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
        Schema::dropIfExists('cumacs');
    }
}
