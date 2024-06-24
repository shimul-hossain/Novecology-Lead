<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeExtraFieldToProjectInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->text('Photo_sauvegardé_Dropbox')->nullable();
            $table->text('Photo_sauvegardé_Dropbox_Par')->nullable();
            $table->text('Photo_sauvegardé_Dropbox_Le')->nullable();
            $table->text('Reception_dossier_installation')->nullable();
            $table->text('Reception_dossier_installation_Par')->nullable();
            $table->text('Reception_dossier_installation_Le')->nullable();
            $table->text('Paiement_d_un_reste_à_charge')->nullable();
            $table->text('Montant')->nullable();
            $table->text('Moyens_de_paiement')->nullable();
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
            $table->dropColumn('Photo_sauvegardé_Dropbox');
            $table->dropColumn('Photo_sauvegardé_Dropbox_Par');
            $table->dropColumn('Photo_sauvegardé_Dropbox_Le');
            $table->dropColumn('Reception_dossier_installation');
            $table->dropColumn('Reception_dossier_installation_Par');
            $table->dropColumn('Reception_dossier_installation_Le');
            $table->dropColumn('Paiement_d_un_reste_à_charge');
            $table->dropColumn('Montant');
            $table->dropColumn('Moyens_de_paiement');
        });
    }
}
