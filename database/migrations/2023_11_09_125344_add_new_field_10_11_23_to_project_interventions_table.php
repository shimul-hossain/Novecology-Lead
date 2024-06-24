<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewField101123ToProjectInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->string('Validation_referent_technique')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_interventions', function (Blueprint $table) {
            $table->dropColumn('Validation_referent_technique');
        });
    }
}
