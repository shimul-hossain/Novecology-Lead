<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileNameFieldToProjectFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_facturations', function (Blueprint $table) {
            $table->text('La_lettre_de_versement_file_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_facturations', function (Blueprint $table) {
            $table->dropColumn('La_lettre_de_versement_file_name');
        });
    }
}
