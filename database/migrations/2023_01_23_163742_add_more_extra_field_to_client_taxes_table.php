<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreExtraFieldToClientTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_taxes', function (Blueprint $table) {
            $table->string('house_owner_status')->nullable();
            $table->string('property_tax_status')->nullable();
            $table->string('MaPrimeRénov_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_taxes', function (Blueprint $table) {
            $table->dropColumn('house_owner_status');
            $table->dropColumn('property_tax_status');
            $table->dropColumn('MaPrimeRénov_status');
        });
    }
}
