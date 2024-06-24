<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_interventions', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text("type")->nullable();
            $table->timestamp("Date_intervention")->nullable();
            $table->text("Horaire_intervention")->nullable();
            $table->text("Statut_planning")->nullable();
            $table->text("Merci_de_préciser_la_raison")->nullable();
            $table->integer("Prévisiteur_TechnicohyphenCommercial")->nullable();
            $table->integer("Contre_prévisiteur")->nullable();
            $table->integer("Chargé_dapostropheétude")->nullable();
            $table->integer("Réfèrent_technique")->nullable();
            $table->integer("Installateur_technique")->nullable();
            $table->integer("Chef_d_équipe")->nullable();
            $table->integer("Technicien_SAV")->nullable();
            $table->integer("Technicien")->nullable();
            $table->text("Précisions_déplacement")->nullable();
            $table->text("Mission_accomplie")->nullable();
            $table->text("Statut_SAV")->nullable();
            $table->text("Reception_photo_SAV")->nullable();
            $table->text("Réception_attestation_SAV")->nullable();
            $table->text("Par")->nullable();
            $table->text("Le")->nullable();
            $table->text("Faisabilité_du_chantier")->nullable();
            $table->text("Liste_des_travaux_à_réaliser")->nullable();
            $table->text("Travaux_supplémentaires")->nullable();
            $table->text("Dossier_Installation")->nullable();
            $table->integer("Préparé_par")->nullable();
            $table->timestamp("Date")->nullable();
            $table->text("Statut_Installation")->nullable();
            $table->text("Statut_contrat")->nullable();
            $table->text("Montant_TTC_Devis")->nullable();
            $table->text("Montant_TTC_du_devis")->nullable();
            $table->text("Reste_à_charge_devis")->nullable();
            $table->text("Reste_à_charge_client")->nullable();
            $table->text("Survente")->nullable();
            $table->text("Montant_survente")->nullable();
            $table->text("KO_Raisons")->nullable();
            $table->text("KO_Précisions")->nullable();
            $table->text("Réflexion_Raisons")->nullable();
            $table->text("Réflexion_Précisions")->nullable();
            $table->text("Dossier_administratif_complet")->nullable();
            $table->text("Merci_de_renseigner_les_pièces_manquantes")->nullable();
            $table->text("Raisons")->nullable();
            $table->text("Observations")->nullable(); 
            $table->integer("user_id")->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_interventions');
    }
}
