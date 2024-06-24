<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationGroupItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestation_group_items', function (Blueprint $table) {
            $table->id();
            $table->integer('prestation_group_id')->nullable();
            $table->integer('prestation_id')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('tax')->nullable();
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
        Schema::dropIfExists('prestation_group_items');
    }
}
