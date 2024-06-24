<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewFieldsToPannelLogActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pannel_log_activities', function (Blueprint $table) {
            $table->string('status')->default('default');
            $table->integer('label_prev_id')->nullable();
            $table->integer('label_id')->nullable();
            $table->integer('status_prev_id')->nullable();
            $table->integer('status_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pannel_log_activities', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('label_prev_id');
            $table->dropColumn('label_id');
            $table->dropColumn('status_prev_id');
            $table->dropColumn('status_id');
        });
    }
}
