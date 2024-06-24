<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeAddressFieldToWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('Adresse_des_travaux')->nullable();
            $table->string('Code_postale_des_travaux')->nullable();
            $table->string('Ville_des_travaux')->nullable();
            $table->string('Département_des_travaux')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('Adresse_des_travaux');
            $table->dropColumn('Code_postale_des_travaux');
            $table->dropColumn('Ville_des_travaux');
            $table->dropColumn('Département_des_travaux');
        });
    }
}
