<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToSecondLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('second_leads', function (Blueprint $table) {
            $table->string('autre_field__transmitter_type')->nullable();
            $table->string('radiatuers_Aluminium')->nullable();
            $table->string('radiatuers_Aluminium_Nombre')->nullable();
            $table->string('radiatuers_Fonte')->nullable();
            $table->string('radiatuers_Fonte_Nombre')->nullable();
            $table->string('radiatuers_Acier')->nullable();
            $table->string('radiatuers_Acier_Nombre')->nullable();
            $table->string('radiatuers_Autre')->nullable();
            $table->string('radiatuers_Autre_Nombre')->nullable();
            $table->string('autre_field__radiatuers')->nullable();
            $table->string('le_logement')->nullable();
            $table->string('autre_field__family_situation')->nullable();
            $table->string('personne_1')->nullable();
            $table->string('autre_field__personne_1')->nullable();
            $table->string('personne_1_partner')->nullable();
            $table->string('personne_2')->nullable();
            $table->string('autre_field__personne_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('second_leads', function (Blueprint $table) {
            $table->dropColumn('autre_field__transmitter_type');
            $table->dropColumn('radiatuers_Aluminium');
            $table->dropColumn('radiatuers_Aluminium_Nombre');
            $table->dropColumn('radiatuers_Fonte');
            $table->dropColumn('radiatuers_Fonte_Nombre');
            $table->dropColumn('radiatuers_Acier');
            $table->dropColumn('radiatuers_Acier_Nombre');
            $table->dropColumn('radiatuers_Autre');
            $table->dropColumn('radiatuers_Autre_Nombre');
            $table->dropColumn('autre_field__radiatuers');
            $table->dropColumn('le_logement');
            $table->dropColumn('autre_field__family_situation');
            $table->dropColumn('personne_1');
            $table->dropColumn('autre_field__personne_1');
            $table->dropColumn('personne_1_partner');
            $table->dropColumn('personne_2');
            $table->dropColumn('autre_field__personne_2');
        });
    }
}
