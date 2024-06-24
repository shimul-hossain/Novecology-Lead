<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_change_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('feature_id');
            $table->integer('from_id')->nullable();
            $table->integer('to_id')->nullable();
            $table->integer('statut_id')->nullable();
            $table->integer('regie_id')->nullable();
            $table->integer('telecommercial_id')->nullable();
            $table->string('status_type');
            $table->string('type'); 
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
        Schema::dropIfExists('status_change_logs');
    }
}
