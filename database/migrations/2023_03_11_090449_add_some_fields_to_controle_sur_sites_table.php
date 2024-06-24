<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToControleSurSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_sur_sites', function (Blueprint $table) {
            $table->integer('Société_MES')->nullable();
            $table->timestamp('Date_MES')->nullable();
            $table->integer('deal')->nullable();
            $table->text('Rapport_MES_dans_Dropbox')->nullable();
            $table->text('Réception_du_bordereau_de_passage')->nullable();
            $table->longText('custom_field_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('controle_sur_sites', function (Blueprint $table) {
            $table->dropColumn('Société_MES');
            $table->dropColumn('Date_MES');
            $table->dropColumn('deal');
            $table->dropColumn('Rapport_MES_dans_Dropbox');
            $table->dropColumn('Réception_du_bordereau_de_passage');
            $table->dropColumn('custom_field_data');
        });
    }
}
