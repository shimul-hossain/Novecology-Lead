<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRapplerHistoryFieldToLeadClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_client_projects', function (Blueprint $table) {
            $table->integer('callback_history_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_client_projects', function (Blueprint $table) {
            $table->dropColumn('callback_history_type');
        });
    }
}
