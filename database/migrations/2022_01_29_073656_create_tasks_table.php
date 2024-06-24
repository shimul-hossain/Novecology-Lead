<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->dateTime('due_date');
            $table->string('priority');
            $table->string('tags')->nullable();
            $table->longText('description'); 
            $table->integer('is_completed')->default(0);
            $table->integer('is_important')->default(0);
            $table->integer('is_pending')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->string('status')->nullable(); 
            $table->integer('client_id')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
