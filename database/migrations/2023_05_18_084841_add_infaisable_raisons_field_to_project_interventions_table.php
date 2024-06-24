<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfaisableRaisonsFieldToProjectInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->text('infaisable_raisons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->dropColumn('infaisable_raisons');
        });
    }
}
