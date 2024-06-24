<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToInterventionModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention_modules', function (Blueprint $table) {
            $table->text('status_planning_installation')->after('team_leader_installation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intervention_modules', function (Blueprint $table) {
            $table->dropColumn('status_planning_installation');
        });
    }
}
