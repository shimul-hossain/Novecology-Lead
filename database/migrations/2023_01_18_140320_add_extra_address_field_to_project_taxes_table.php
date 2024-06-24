<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraAddressFieldToProjectTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_taxes', function (Blueprint $table) {
            $table->string('same_as_work_address')->default('yes');
            $table->string('Adresse_Travaux')->nullable();
            $table->string('Complément_adresse_Travaux')->nullable();
            $table->string('Code_postal_Travaux')->nullable();
            $table->string('Ville_Travaux')->nullable();
            $table->string('Departement_Travaux')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_taxes', function (Blueprint $table) {
            $table->dropColumn('same_as_work_address');
            $table->dropColumn('Adresse_Travaux');
            $table->dropColumn('Complément_adresse_Travaux');
            $table->dropColumn('Code_postal_Travaux');
            $table->dropColumn('Ville_Travaux');
            $table->dropColumn('Departement_Travaux');
        });
    }
}
