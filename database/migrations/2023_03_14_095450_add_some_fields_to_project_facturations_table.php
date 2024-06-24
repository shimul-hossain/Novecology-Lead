<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToProjectFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_facturations', function (Blueprint $table) {
            $table->text('Paiement_inférieur_au_montant_prévu')->nullable();
            $table->text('Paiement_inférieur_payé')->nullable();
            $table->text('Mandataire')->nullable();
            $table->text('Entreprise_de_travaux')->nullable();
            $table->text('Date_facturation_MaPrimeRénov')->nullable();
            $table->text('Avance_délégataire_MaPrimeRénov')->nullable();
            $table->text('Avance_délégataire_MaPrimeRénov_Mandataire')->nullable();
            $table->text('Montant_avance')->nullable();
            $table->text('Lot_APF')->nullable();
            $table->text('Numéro_de_bordereau_APF')->nullable();
            $table->text('Date_APF')->nullable();
            $table->text('Date_paiement_MaPrimeRénov')->nullable();
            $table->text('Référence_bancaire')->nullable();
            $table->text('Lettre_de_versement')->nullable();
            $table->text('La_lettre_de_versement')->nullable(); 
            $table->text('Banque')->nullable(); 
            $table->text('N_Dossier_organisme')->nullable(); 
            $table->text('Date_envoi_contrat')->nullable(); 
            $table->text('Numero_suivi_envoi_contrat')->nullable(); 
            $table->text('Date_demande_de_financement')->nullable(); 
            $table->text('Paye_le')->nullable(); 
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
            $table->dropColumn('Paiement_inférieur_au_montant_prévu');
            $table->dropColumn('Paiement_inférieur_payé');
            $table->dropColumn('Mandataire');
            $table->dropColumn('Entreprise_de_travaux');
            $table->dropColumn('Date_facturation_MaPrimeRénov');
            $table->dropColumn('Avance_délégataire_MaPrimeRénov');
            $table->dropColumn('Avance_délégataire_MaPrimeRénov_Mandataire');
            $table->dropColumn('Montant_avance');
            $table->dropColumn('Lot_APF');
            $table->dropColumn('Numéro_de_bordereau_APF');
            $table->dropColumn('Date_APF');
            $table->dropColumn('Date_paiement_MaPrimeRénov');
            $table->dropColumn('Référence_bancaire');
            $table->dropColumn('Lettre_de_versement');
            $table->dropColumn('La_lettre_de_versement'); 
            $table->dropColumn('Banque'); 
            $table->dropColumn('N_Dossier_organisme'); 
            $table->dropColumn('Date_envoi_contrat'); 
            $table->dropColumn('Numero_suivi_envoi_contrat'); 
            $table->dropColumn('Date_demande_de_financement'); 
            $table->dropColumn('Paye_le'); 
        });
    }
}
