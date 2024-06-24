<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('tracker_name')->nullable();
            $table->string('tracker_platform')->nullable();
            $table->string('tracker_email')->nullable();
            $table->string('tracker_phone')->nullable();
            $table->integer('lead_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('supplier')->nullable();
            $table->string('campaign_type')->nullable();
            $table->string('campaign')->nullable();
            $table->timestamp('request_date')->nullable();
            $table->timestamp('award_date')->nullable();
            $table->string('first_last_name')->nullable();
            $table->string('p_code')->nullable();
            $table->string('telephone')->nullable();
            $table->string('h_mode')->nullable();
            $table->string('owner')->nullable();
            $table->string('over_then_15')->nullable();
            $table->string('email_address')->nullable();
            $table->string('autre_field__campaign_type')->nullable();
            $table->string('p_code_department')->nullable();
            $table->string('autre_field__h_mode')->nullable();
            $table->string('tracker_travaux')->nullable();
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
        Schema::dropIfExists('client_trackers');
    }
}
