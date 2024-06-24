<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('category_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->timestamp('date');
            $table->string('time')->nullable();
            $table->longText('description')->nullable();
            $table->text('guest')->nullable();
            $table->text('location')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('new_events');
    }
}
