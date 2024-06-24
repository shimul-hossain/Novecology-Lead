<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewFieldsToAutomatisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automatises', function (Blueprint $table) {
            $table->string('recurrence')->nullable();
            $table->integer('frequence')->nullable();
            $table->integer('fin')->nullable();
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
            $table->dropColumn('recurrence');
            $table->dropColumn('frequence');
            $table->dropColumn('fin');
        });
    }
}
