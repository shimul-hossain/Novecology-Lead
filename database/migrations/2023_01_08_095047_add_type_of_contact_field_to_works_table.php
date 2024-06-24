<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeOfContactFieldToWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('Type_de_contrat')->nullable();
            $table->string('MaPrimeRenov')->nullable();
            $table->string('Action_Logement')->nullable();
            $table->string('CEE')->nullable(); 
            $table->string('Reste_à_charge')->nullable();
            $table->string('Subvention_MaPrimeRénov_déduit_du_devis')->nullable();
            $table->string('Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov')->nullable();
            $table->string('Montant_Crédit')->nullable();
            $table->string('Report_du_crédit')->nullable();
            $table->string('Nombre_de_jours_report')->nullable();
            $table->string('Mode_de_paiement')->nullable();
            $table->string('Nombre_de_mensualités')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('Type_de_contrat');
            $table->dropColumn('MaPrimeRenov');
            $table->dropColumn('Action_Logement');
            $table->dropColumn('CEE');
            $table->dropColumn('Reste_à_charge');
            $table->dropColumn('Subvention_MaPrimeRénov_déduit_du_devis');
            $table->dropColumn('Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov');
            $table->dropColumn('Montant_Crédit');
            $table->dropColumn('Report_du_crédit');
            $table->dropColumn('Nombre_de_jours_report');
            $table->dropColumn('Mode_de_paiement');
            $table->dropColumn('Nombre_de_mensualités');
        });
    }
}
