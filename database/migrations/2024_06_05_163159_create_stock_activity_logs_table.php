<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->text('key')->nullable();
            $table->text('value')->nullable();
            $table->integer('feature_id');
            $table->integer('user_id');
            $table->string('type')->default('update')->nullable();
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
        Schema::dropIfExists('stock_activity_logs');
    }
}
