<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldManualImportToNewProject2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_project2s', function (Blueprint $table) {
            $table->integer('manual_import')->nullable()->default(0);
            $table->string('montant_cee')->nullable();
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
            $table->dropColumn('manual_import');
            $table->dropColumn('montant_cee');
        });
    }
}
