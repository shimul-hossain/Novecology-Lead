<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->integer('category_id');
            $table->string('all_day')->default('no');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('location');
            $table->text('description'); 
            $table->enum('status', [0,1])->default(0); 
            
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
        Schema::dropIfExists('events');
    }
}
