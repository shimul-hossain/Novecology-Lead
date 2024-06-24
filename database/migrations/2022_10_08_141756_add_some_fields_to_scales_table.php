<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scales', function (Blueprint $table) {
            $table->string('kwh_cumac')->nullable(); 
            $table->string('prime_coup')->nullable(); 
            $table->string('travaux')->nullable(); 
            $table->string('tag')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scales', function (Blueprint $table) {
            $table->dropColumn('kwh_cumac');
            $table->dropColumn('prime_coup');
            $table->dropColumn('travaux');
            $table->dropColumn('tag');
        });
    }
}
