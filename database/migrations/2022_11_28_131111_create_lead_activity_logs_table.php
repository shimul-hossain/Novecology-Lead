<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('tab_name')->nullable();
            $table->string('block_name')->nullable();
            $table->longText('key')->nullable();
            $table->longText('value')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('lead_id')->nullable();
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
        Schema::dropIfExists('lead_activity_logs');
    }
}
