<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubventionCollapseDataToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Date_de_dépôt')->nullable();
            $table->text('Number_Dossier_Action_Logement')->nullable();
            $table->text('Montant_subvention_prévisionnelle')->nullable();
            $table->text('Travaux_déposés')->nullable();
            $table->text('Statut_Action_logement')->nullable();
            $table->text('Date_mise_à_jour')->nullable();
            $table->text('Subvention_Observations')->nullable();
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
            $table->dropColumn('Date_de_dépôt');
            $table->dropColumn('Number_Dossier_Action_Logement');
            $table->dropColumn('Montant_subvention_prévisionnelle');
            $table->dropColumn('Travaux_déposés');
            $table->dropColumn('Statut_Action_logement');
            $table->dropColumn('Date_mise_à_jour');
            $table->dropColumn('Subvention_Observations');
        });
    }
}
