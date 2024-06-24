<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToAutomatisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automatises', function (Blueprint $table) {
            $table->string('select_to_cc')->nullable();
            $table->string('select_to_cci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('automatises', function (Blueprint $table) {
            $table->dropColumn('select_to_cc');
            $table->dropColumn('select_to_cci');
        });
    }
}
