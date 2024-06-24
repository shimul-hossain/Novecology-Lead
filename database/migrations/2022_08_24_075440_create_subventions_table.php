<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subventions', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('numero_de_dossier')->nullable();
            $table->string('date_de_depot')->nullable();
            $table->string('gestionnaire_depot')->nullable();
            $table->string('mondat_depot')->nullable();
            $table->string('mandataire')->nullable();
            $table->string('numero_de_devis')->nullable();
            $table->string('subvention_provisional')->nullable();
            $table->string('travaux_deposer')->nullable();
            $table->string('subvention_status')->nullable();
            $table->string('date_mise')->nullable();
            $table->string('subvention_accorde')->nullable();
            $table->string('subvention_accorde_le')->nullable();
            $table->string('notification_doctroi')->nullable();
            $table->string('montant_subvention_accorde')->nullable();
            $table->string('subvention_rejetee')->nullable();
            $table->string('subvention_rejetee_le')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('subventions');
    }
}
