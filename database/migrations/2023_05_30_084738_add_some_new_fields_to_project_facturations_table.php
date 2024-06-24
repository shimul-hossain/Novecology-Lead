<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewFieldsToProjectFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_facturations', function (Blueprint $table) {
            $table->text('N_Dossier_Action_Logement')->nullable();
            $table->text('AMO')->nullable();
            $table->text('Date_facturation_Action_Logement')->nullable();
            $table->text('Date_paiement_Action_Logement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_facturations', function (Blueprint $table) {
            $table->dropColumn('N_Dossier_Action_Logement');
            $table->dropColumn('AMO');
            $table->dropColumn('Date_facturation_Action_Logement');
            $table->dropColumn('Date_paiement_Action_Logement');
        });
    }
}
