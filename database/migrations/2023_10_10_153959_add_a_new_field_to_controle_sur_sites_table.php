<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddANewFieldToControleSurSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_sur_sites', function (Blueprint $table) {
            $table->text('Étape_du_contrôle')->nullable();
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
            $table->dropColumn('Étape_du_contrôle');
        });
    }
}
