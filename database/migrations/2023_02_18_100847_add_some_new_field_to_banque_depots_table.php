<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewFieldToBanqueDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banque_depots', function (Blueprint $table) {
            $table->string('Préciser_pièces_manquantes')->nullable();
            $table->string('Statut_accord_banque')->nullable();
            $table->string('Montant_crédit_accepté')->nullable();
            $table->timestamp('Date_de_notification_accord')->nullable();
            $table->string('Raison_refus_du_crédit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banque_depots', function (Blueprint $table) {
            $table->dropColumn('Préciser_pièces_manquantes');
            $table->dropColumn('Statut_accord_banque');
            $table->dropColumn('Montant_crédit_accepté');
            $table->dropColumn('Date_de_notification_accord');
            $table->dropColumn('Raison_refus_du_crédit');
        });
    }
}
