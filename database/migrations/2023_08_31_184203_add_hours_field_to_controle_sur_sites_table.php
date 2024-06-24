<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoursFieldToControleSurSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_sur_sites', function (Blueprint $table) {
            $table->string('horaire_intervention')->nullable();
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
            $table->dropColumn('horaire_intervention');
        });
    }
}
