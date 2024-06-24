<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('tracker_name')->nullable();
            $table->string('tracker_platform')->nullable();
            $table->string('tracker_email')->nullable();
            $table->string('tracker_phone')->nullable();
            $table->integer('lead_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('project_id')->nullable();
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
        Schema::dropIfExists('lead_trackers');
    }
}
