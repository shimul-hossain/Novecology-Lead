<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeclarantInfoToLeadTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_taxes', function (Blueprint $table) {
            $table->text('Nom_et_prénom_déclarant_1')->nullable();
            $table->text('Date_de_naissance_déclarant_1')->nullable();
            $table->text('Nom_et_prénom_déclarant_2')->nullable();
            $table->text('Date_de_naissance_déclarant_2')->nullable();
            $table->text('house_owner_status_déclarant_2')->nullable();
            $table->text('property_tax_status_déclarant_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_taxes', function (Blueprint $table) {
            $table->dropColumn('Nom_et_prénom_déclarant_1');
            $table->dropColumn('Date_de_naissance_déclarant_1');
            $table->dropColumn('Nom_et_prénom_déclarant_2');
            $table->dropColumn('Date_de_naissance_déclarant_2');
            $table->dropColumn('house_owner_status_déclarant_2');
            $table->dropColumn('property_tax_status_déclarant_2');
        });
    }
}
