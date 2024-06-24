<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkDonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_dones', function (Blueprint $table) {
            $table->id();
            $table->string('operation')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('surface')->nullable();
            $table->string('unit_bonus')->nullable();
            $table->string('installer_rge')->nullable();
            $table->string('qualification')->nullable();
            $table->string('previsite')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('work_dones');
    }
}
