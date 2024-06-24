<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevisSignLeFieldToProjectInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->timestamp('Devis_signé_le')->nullable();
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
            $table->dropColumn('Devis_signé_le');
        });
    }
}
