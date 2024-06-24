<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjetTabNewFieldToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Statut_Projet')->nullable();
            $table->text('Bon_De_Commande')->nullable();
            $table->text('Bon_De_Commande_signé_le')->nullable();
            $table->text('Montant_TTC_du_devis')->nullable();
            $table->text('Devis_signé_le')->nullable();
            $table->text('Reste_à_charge_devis')->nullable();
            $table->text('Reste_à_charge_client')->nullable();
            $table->text('Montant_attestation_RAC')->nullable();
            $table->text('Survente')->nullable();
            $table->text('Montant_survente')->nullable();
            $table->text('Raisons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->dropColumn('Statut_Projet');
            $table->dropColumn('Bon_De_Commande');
            $table->dropColumn('Bon_De_Commande_signé_le');
            $table->dropColumn('Montant_TTC_du_devis');
            $table->dropColumn('Devis_signé_le');
            $table->dropColumn('Reste_à_charge_devis');
            $table->dropColumn('Reste_à_charge_client');
            $table->dropColumn('Montant_attestation_RAC');
            $table->dropColumn('Survente');
            $table->dropColumn('Montant_survente');
            $table->dropColumn('Raisons');
        });
    }
}
