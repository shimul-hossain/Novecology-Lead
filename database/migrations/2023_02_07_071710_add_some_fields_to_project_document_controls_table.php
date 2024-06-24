<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToProjectDocumentControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_document_controls', function (Blueprint $table) {
            $table->timestamp('Réceptionné_le')->nullable();
            $table->integer('Réceptionné_par')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_document_controls', function (Blueprint $table) {
            $table->dropColumn('Réceptionné_le');
            $table->dropColumn('Réceptionné_par');
        });
    }
}
