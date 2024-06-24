<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutomatisationRecurrenceFieldsToLeadClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_client_projects', function (Blueprint $table) {
            $table->integer('etiquette_automatise_recurrence_status')->nullable()->default(0);
            $table->integer('etiquette_automatise_id')->nullable()->default(0); 
            $table->integer('etiquette_fin')->nullable()->default(0);
            $table->timestamp('etiquette_automatise_recurrence_start')->nullable();
            $table->integer('statut_automatise_recurrence_status')->nullable()->default(0);
            $table->integer('statut_automatise_id')->nullable()->default(0); 
            $table->integer('statut_fin')->nullable()->default(0);
            $table->timestamp('statut_automatise_recurrence_start')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_client_projects', function (Blueprint $table) {
            $table->dropColumn('etiquette_automatise_recurrence_status');
            $table->dropColumn('etiquette_automatise_id'); 
            $table->dropColumn('etiquette_fin');
            $table->dropColumn('etiquette_automatise_recurrence_start');
            $table->dropColumn('statut_automatise_recurrence_status');
            $table->dropColumn('statut_automatise_id'); 
            $table->dropColumn('statut_fin');
            $table->dropColumn('statut_automatise_recurrence_start');
        });
    }
}
