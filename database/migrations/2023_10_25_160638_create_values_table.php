<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->string('first_block_title');
            $table->longText('first_block_description');
            $table->string('first_block_image');
            $table->string('second_block_title');
            $table->string('second_block_short_description');
            $table->longText('second_block_long_description');
            $table->string('second_block_image');
            $table->string('third_block_title');
            $table->string('third_block_short_description');
            $table->longText('third_block_long_description');
            $table->string('third_block_image');
            $table->string('fourth_block_title');
            $table->longText('fourth_block_description');
            $table->string('fourth_block_image');
            $table->string('fifth_block_title');
            $table->string('fifth_block_short_description');
            $table->longText('fifth_block_long_description');
            $table->string('fifth_block_image');
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
        Schema::dropIfExists('values');
    }
}
