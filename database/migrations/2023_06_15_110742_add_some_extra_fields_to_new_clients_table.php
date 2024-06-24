<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeExtraFieldsToNewClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->text('Type_de_contrat')->nullable();
            $table->text('MaPrimeRenov')->nullable();
            $table->text('Subvention_MaPrimeRénov_déduit_du_devis')->nullable();
            $table->text('Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov')->nullable();
            $table->text('Action_Logement')->nullable();
            $table->text('CEE')->nullable();
            $table->text('Credit')->nullable();
            $table->text('Montant_Crédit')->nullable();
            $table->text('Report_du_crédit')->nullable();
            $table->text('Nombre_de_jours_report')->nullable();
            $table->text('Reste_à_charge')->nullable();
            $table->text('Reste_à_charge_Montant')->nullable();
            $table->text('Mode_de_paiement')->nullable();
            $table->text('Nombre_de_mensualités')->nullable();
            $table->text('Projet_observations')->nullable();
            $table->text('Montant_estimée_de_lapostropheaide')->nullable();
            $table->text('question_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->dropColumn('Type_de_contrat');
            $table->dropColumn('MaPrimeRenov');
            $table->dropColumn('Subvention_MaPrimeRénov_déduit_du_devis');
            $table->dropColumn('Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov');
            $table->dropColumn('Action_Logement');
            $table->dropColumn('CEE');
            $table->dropColumn('Credit');
            $table->dropColumn('Montant_Crédit');
            $table->dropColumn('Report_du_crédit');
            $table->dropColumn('Nombre_de_jours_report');
            $table->dropColumn('Reste_à_charge');
            $table->dropColumn('Reste_à_charge_Montant');
            $table->dropColumn('Mode_de_paiement');
            $table->dropColumn('Nombre_de_mensualités');
            $table->dropColumn('Projet_observations'); 
            $table->dropColumn('Montant_estimée_de_lapostropheaide');
            $table->dropColumn('question_data');
        });
    }
}
