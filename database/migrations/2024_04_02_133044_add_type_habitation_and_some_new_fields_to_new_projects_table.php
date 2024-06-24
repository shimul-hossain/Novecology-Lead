<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeHabitationAndSomeNewFieldsToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Type_habitation')->nullable();
            $table->text('Type_de_logement')->nullable();
            $table->text('Type_de_chauffage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->dropColumn('Type_habitation');
            $table->dropColumn('Type_de_logement');
            $table->dropColumn('Type_de_chauffage');
        });
    }
}
