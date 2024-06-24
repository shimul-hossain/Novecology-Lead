<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('subtitle');
            $table->longText('short_details');
            $table->enum('category', ['Particular','Professional'])->default('Particular');
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
        Schema::dropIfExists('our_solutions');
    }
}
