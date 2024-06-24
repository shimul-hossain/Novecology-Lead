<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddANewFieldToProjectTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_tags', function (Blueprint $table) {
            $table->text('Nombre_de_split')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_tags', function (Blueprint $table) {
             $table->dropColumn('Nombre_de_split');
        });
    }
}
