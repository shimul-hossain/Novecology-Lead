<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Compte_email')->nullable();
            $table->text('Compte_Mots_de_passe')->nullable();
            $table->text('Compte_crée_le')->nullable();
            $table->text('Compte_crée_par')->nullable();
            $table->text('Compte_MaPrimeRenov_email')->nullable();
            $table->text('Compte_MaPrimeRenov_Mots_de_passe')->nullable();
            $table->text('Compte_MaPrimeRenov_Compte_crée_le')->nullable();
            $table->text('Compte_MaPrimeRenov_Compte_crée_par')->nullable();
            $table->text('Compte_inscrit_sur_Thunderbird')->nullable();
            $table->text('Compte_Observations')->nullable();
            $table->text('Date_de_dépôt_MyMPR')->nullable(); 
            $table->text('N_Dossier_MPR_hyphen_MyMPR')->nullable(); 
            $table->text('Montant_subvention_prévisionnel_hyphen_MyMPR')->nullable(); 
            $table->text('Travaux_deposés_hyphen_MyMPR')->nullable(); 
            $table->text('Statut_1_hyphen_MyMPR')->nullable(); 
            $table->text('Statut_2_hyphen_MyMPR')->nullable(); 
            $table->text('Adresse_hyphen_MyMPR')->nullable(); 
            $table->text('mpr_updated_at')->nullable(); 
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
            $table->dropColumn('Compte_email');
            $table->dropColumn('Compte_Mots_de_passe');
            $table->dropColumn('Compte_crée_le');
            $table->dropColumn('Compte_crée_par');
            $table->dropColumn('Compte_MaPrimeRenov_email');
            $table->dropColumn('Compte_MaPrimeRenov_Mots_de_passe');
            $table->dropColumn('Compte_MaPrimeRenov_Compte_crée_le');
            $table->dropColumn('Compte_MaPrimeRenov_Compte_crée_par');
            $table->dropColumn('Compte_inscrit_sur_Thunderbird');
            $table->dropColumn('Compte_Observations');
            $table->dropColumn('Date_de_dépôt_MyMPR');
            $table->dropColumn('N_Dossier_MPR_hyphen_MyMPR');
            $table->dropColumn('Montant_subvention_prévisionnel_hyphen_MyMPR');
            $table->dropColumn('Travaux_deposés_hyphen_MyMPR');
            $table->dropColumn('Statut_1_hyphen_MyMPR');
            $table->dropColumn('Statut_2_hyphen_MyMPR');
            $table->dropColumn('Adresse_hyphen_MyMPR');
            $table->dropColumn('mpr_updated_at');
        });
    }
}
