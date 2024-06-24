<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToLeadTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_trackers', function (Blueprint $table) {
            $table->string('autre_field__campaign_type')->nullable();
            $table->string('p_code_department')->nullable();
            $table->string('autre_field__h_mode')->nullable();
            $table->string('tracker_travaux')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_trackers', function (Blueprint $table) {
            $table->dropColumn('autre_field__campaign_type');
            $table->dropColumn('p_code_department');
            $table->dropColumn('autre_field__h_mode');
            $table->dropColumn('tracker_travaux');
        });
    }
}
