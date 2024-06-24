<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddANewField25102023ToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Le_logement_possède_un_réseau_hydraulique')->nullable();
            $table->text('auxiliary_heating__Insert_à_bois_Nombre')->nullable();
            $table->text('auxiliary_heating__Poêle_à_bois_Nombre')->nullable();
            $table->text('auxiliary_heating__Poêle_à_gaz_Nombre')->nullable();
            $table->text('auxiliary_heating__Convecteur_électrique_Nombre')->nullable();
            $table->text('auxiliary_heating__Sèche_serviette_Nombre')->nullable();
            $table->text('auxiliary_heating__Panneau_rayonnant_Nombre')->nullable();
            $table->text('auxiliary_heating__Radiateur_bain_dhuile_Nombre')->nullable();
            $table->text('auxiliary_heating__Radiateur_soufflan_électrique_Nombre')->nullable();
            $table->text('auxiliary_heating__Autre_Nombre')->nullable();
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
            $table->dropColumn('Le_logement_possède_un_réseau_hydraulique');
            $table->dropColumn('auxiliary_heating__Insert_à_bois_Nombre');
            $table->dropColumn('auxiliary_heating__Poêle_à_bois_Nombre');
            $table->dropColumn('auxiliary_heating__Poêle_à_gaz_Nombre');
            $table->dropColumn('auxiliary_heating__Convecteur_électrique_Nombre');
            $table->dropColumn('auxiliary_heating__Sèche_serviette_Nombre');
            $table->dropColumn('auxiliary_heating__Panneau_rayonnant_Nombre');
            $table->dropColumn('auxiliary_heating__Radiateur_bain_dhuile_Nombre');
            $table->dropColumn('auxiliary_heating__Radiateur_soufflan_électrique_Nombre');
            $table->dropColumn('auxiliary_heating__Autre_Nombre');
        });
    }
}
