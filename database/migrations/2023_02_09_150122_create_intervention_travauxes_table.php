<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionTravauxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_travauxes', function (Blueprint $table) {
            $table->id();
            $table->integer('intervention_id')->nullable();
            $table->integer('travaux_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->text('Montant_TTC')->nullable();
            $table->text('Réception_photos_Installation')->nullable();
            $table->text('Réception_photos_Installation_Par')->nullable();
            $table->text('Réception_photos_Installation_Le')->nullable();
            $table->text('Contrôle_conformité_photos')->nullable();
            $table->text('Contrôle_conformité_photos_Par')->nullable();
            $table->text('Contrôle_conformité_photos_Le')->nullable();
            $table->text('Photo_sauvegardé_Dropbox')->nullable();
            $table->text('Photo_sauvegardé_Dropbox_Par')->nullable();
            $table->text('Photo_sauvegardé_Dropbox_Le')->nullable();
            $table->text('Reception_dossier_installation')->nullable();
            $table->text('Reception_dossier_installation_Par')->nullable();
            $table->text('Reception_dossier_installation_Le')->nullable();
            $table->text('Paiement_d_un_reste_à_charge')->nullable();
            $table->text('Montant')->nullable();
            $table->text('Moyens_de_paiement')->nullable();
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
        Schema::dropIfExists('intervention_travauxes');
    }
}
