<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_details', function (Blueprint $table) {
           
            $table->id();
            $table->unsignedBigInteger('advice_id');
            $table->string('first_qsn')->nullable();
            $table->longText('first_ans')->nullable();
            $table->string('second_qsn')->nullable();
            $table->longText('second_ans')->nullable();
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
        Schema::dropIfExists('advice_details');
    }
}
