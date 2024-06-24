<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('first_block_title');
            $table->longText('first_block_description');
            $table->string('first_block_image');
            $table->string('second_block_title');
            $table->longText('second_block_description');
            $table->string('second_block_image');
            $table->string('third_block_title');
            $table->longText('third_block_description');
            $table->string('third_block_image');
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
        Schema::dropIfExists('histories');
    }
}
