<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaysColumnToClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('pays')->after('email')->nullable();
            $table->string('house_type')->after('postal_code')->nullable();
            $table->string('zone')->after('house_type')->nullable();
            $table->string('city')->after('zone')->nullable();
            $table->string('electricity_connection')->after('heating_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('pays');
            $table->dropColumn('house_type');
            $table->dropColumn('zone');
            $table->dropColumn('city');
            $table->dropColumn('electricity_connection');
        });
    }
}
