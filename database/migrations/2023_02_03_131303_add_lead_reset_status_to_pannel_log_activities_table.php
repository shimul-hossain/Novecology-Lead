<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeadResetStatusToPannelLogActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pannel_log_activities', function (Blueprint $table) {
            $table->integer('lead_reset_status')->default(0);
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
            $table->dropColumn('lead_reset_status');
        });
    }
}
