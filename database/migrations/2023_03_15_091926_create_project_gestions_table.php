<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectGestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_gestions', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('type');
            $table->text('Statut_facture')->nullable();
            $table->text('Payé_le')->nullable();
            $table->integer('Fournisseur_matériel')->nullable();
            $table->text('Numéro_de_facture')->nullable();
            $table->text('Date_de_facture')->nullable();
            $table->text('Montant_HT')->nullable();
            $table->text('Montant_TTC')->nullable();
            $table->integer('Installateur_technique')->nullable();
            $table->text('Société')->nullable();
            $table->integer('Chargé_dapostropheétude')->nullable();
            $table->integer('Prévisiteur_TechnicohyphenCommercial')->nullable();
            $table->text('Désignation')->nullable();
            $table->longText('Observations')->nullable();
            $table->longText('custom_field_data')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('project_gestions');
    }
}
