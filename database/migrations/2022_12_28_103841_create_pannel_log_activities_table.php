<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePannelLogActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pannel_log_activities', function (Blueprint $table) {
            $table->id();
            $table->string('tab_name')->nullable();
            $table->string('block_name')->nullable();
            $table->longText('key')->nullable();
            $table->longText('value')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('feature_id')->nullable();
            $table->string('feature_type')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('pannel_log_activities');
    }
}
