<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewExtraFieldToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Faisabilité_du_projet')->nullable();
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
            $table->dropColumn('Faisabilité_du_projet');
        });
    }
}
