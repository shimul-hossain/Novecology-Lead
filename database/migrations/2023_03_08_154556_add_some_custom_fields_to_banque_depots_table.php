<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeCustomFieldsToBanqueDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banque_depots', function (Blueprint $table) {
            $table->longText('custom_field_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banque_depots', function (Blueprint $table) {
            $table->dropColumn('custom_field_data');
        });
    }
}
