<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewField05042024ToLeadTravauxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_travaux_tags', function (Blueprint $table) {
            $table->string('Nombre_de_radiateur_total_dans_le_logement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_travaux_tags', function (Blueprint $table) {
            $table->dropColumn('Nombre_de_radiateur_total_dans_le_logement');
        });
    }
}
