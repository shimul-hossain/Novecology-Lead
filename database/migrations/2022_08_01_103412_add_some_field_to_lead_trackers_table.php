<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToLeadTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_trackers', function (Blueprint $table) {
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
            $table->dropColumn('supplier');
            $table->dropColumn('campaign_type');
            $table->dropColumn('campaign');
            $table->dropColumn('request_date');
            $table->dropColumn('award_date');
            $table->dropColumn('first_last_name');
            $table->dropColumn('p_code');
            $table->dropColumn('telephone');
            $table->dropColumn('h_mode');
            $table->dropColumn('owner');
            $table->dropColumn('over_then_15');
            $table->dropColumn('email_address');
        });
    }
}
