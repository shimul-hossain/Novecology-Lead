<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeSurventeFieldsToLeadClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_client_projects', function (Blueprint $table) {
            $table->text('Survente')->nullable();
            $table->text('Montant_survente')->nullable();
            $table->text('Observations_reste_à_charge')->nullable();
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
            $table->dropColumn('Survente');
            $table->dropColumn('Montant_survente');
            $table->dropColumn('Observations_reste_à_charge');
        });
    }
}
