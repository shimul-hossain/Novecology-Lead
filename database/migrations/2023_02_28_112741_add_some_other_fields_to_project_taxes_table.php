<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeOtherFieldsToProjectTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_taxes', function (Blueprint $table) {
            $table->string('Existe_déclarant')->nullable();
            $table->string('Existe_déclarant_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_taxes', function (Blueprint $table) {
            $table->dropColumn('Existe_déclarant');
            $table->dropColumn('Existe_déclarant_number');
        });
    }
}
