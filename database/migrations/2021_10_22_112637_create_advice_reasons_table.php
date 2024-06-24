<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_reasons', function (Blueprint $table) {
        
            $table->id();
            $table->unsignedBigInteger('advice_id');
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->string('image')->nullable();
            $table->foreign('advice_id')
                  ->references('id')->on('advice')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('advice_reasons');
    }
}
