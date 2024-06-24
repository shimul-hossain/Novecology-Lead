<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutomatisationInfoToNewProject2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_project2s', function (Blueprint $table) {
            $table->integer('etiquette_automatise_not_change')->nullable()->default(0);
            $table->integer('etiquette_automatise_not_change_id')->nullable()->default(0);  
            $table->timestamp('etiquette_automatise_not_change_start')->nullable();
            $table->integer('statut_automatise_not_change')->nullable()->default(0);
            $table->integer('statut_automatise_not_change_id')->nullable()->default(0);  
            $table->timestamp('statut_automatise_not_change_start')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_project2s', function (Blueprint $table) {
            $table->dropColumn('etiquette_automatise_not_change');
            $table->dropColumn('etiquette_automatise_not_change_id'); 
            $table->dropColumn('etiquette_automatise_not_change_start');
            $table->dropColumn('statut_automatise_not_change');
            $table->dropColumn('statut_automatise_not_change_id'); 
            $table->dropColumn('statut_automatise_not_change_start');
        });
    }
}
