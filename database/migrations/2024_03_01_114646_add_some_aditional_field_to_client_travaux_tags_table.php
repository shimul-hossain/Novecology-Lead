<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeAditionalFieldToClientTravauxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_travaux_tags', function (Blueprint $table) {
            $table->string('shab')->nullable();
            $table->string('Type_de_radiateur')->nullable();
            $table->string('Nombre_de_radiateurs_électrique')->nullable();
            $table->string('Nombre_de_radiateurs_combustible')->nullable();
            $table->string('Thermostat_supplémentaire')->nullable();
            $table->string('Nombre_thermostat_supplémentaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_travaux_tags', function (Blueprint $table) {
            $table->dropColumn('shab');
            $table->dropColumn('Type_de_radiateur');
            $table->dropColumn('Nombre_de_radiateurs_électrique');
            $table->dropColumn('Nombre_de_radiateurs_combustible');
            $table->dropColumn('Thermostat_supplémentaire');
            $table->dropColumn('Nombre_thermostat_supplémentaire');
        });
    }
}
