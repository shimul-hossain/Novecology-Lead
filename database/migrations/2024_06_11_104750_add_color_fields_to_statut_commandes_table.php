<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorFieldsToStatutCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statut_commandes', function (Blueprint $table) {
            $table->string('background_color')->nullable()->default('#26C6DA');
            $table->string('text_color')->nullable()->default('#ffffff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statut_commandes', function (Blueprint $table) {
            $table->dropColumn('background_color');
            $table->dropColumn('text_color');
        });
    }
}
