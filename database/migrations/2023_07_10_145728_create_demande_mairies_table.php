<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeMairiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_mairies', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('Mairie')->nullable();
            $table->text('Statut_demande')->nullable();
            $table->text('Date_de_réception_de_l_accord_de_mairie')->nullable();
            $table->text('Date_de_dépôt')->nullable();
            $table->text('Demande_de_travaux')->nullable();
            $table->text('Réception_du_récépissé_de_dépôt')->nullable();
            $table->text('Date_de_réception_de_récépissé_de_mairie')->nullable();
            $table->text('Observations')->nullable();
            $table->longText('custom_field_data')->nullable();
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
        Schema::dropIfExists('demande_mairies');
    }
}
