<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToSecondProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('second_projects', function (Blueprint $table) {
            $table->string('annual_heating')->nullable();
            $table->string('annual_heating2')->nullable();
            $table->string('with_basement')->nullable();
            $table->string('supplementary')->nullable();
            $table->string('heating_generator')->nullable();
            $table->string('ovservations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('second_projects', function (Blueprint $table) {
            $table->dropColumn('annual_heating');
            $table->dropColumn('annual_heating2');
            $table->dropColumn('with_basement');
            $table->dropColumn('supplementary');
            $table->dropColumn('heating_generator');
            $table->dropColumn('ovservations');
        });
    }
}
