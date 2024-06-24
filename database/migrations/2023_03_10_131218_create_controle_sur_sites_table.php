<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleSurSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_sur_sites', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('type')->nullable();
            $table->string('report')->nullable();
            $table->integer('Bureau_de_contrôle_id')->nullable();
            $table->text('Date_de_contrôle')->nullable();
            $table->integer('Travaux_contrôlés')->nullable();
            $table->text('Conformité_du_chantier')->nullable();
            $table->text('Surface_contrôlée')->nullable();
            $table->text('Ecart_surface')->nullable();
            $table->text('Ecart_de_surface')->nullable();
            $table->text('Surface_réalisé_sur_facture')->nullable();
            $table->text('Observations')->nullable();
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
        Schema::dropIfExists('controle_sur_sites');
    }
}
