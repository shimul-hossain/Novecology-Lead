<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewField15042024ToClientTravauxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_travaux_tags', function (Blueprint $table) {
            $table->string('Nombre_de_pièces_dans_le_logement')->nullable();
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
            $table->dropColumn('Nombre_de_pièces_dans_le_logement');
        });
    }
}
