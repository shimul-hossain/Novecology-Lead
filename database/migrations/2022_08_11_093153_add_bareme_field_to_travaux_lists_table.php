<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaremeFieldToTravauxListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travaux_lists', function (Blueprint $table) {
            $table->integer('bareme_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travaux_lists', function (Blueprint $table) {
            $table->dropColumn('bareme_id');
        });
    }
}
