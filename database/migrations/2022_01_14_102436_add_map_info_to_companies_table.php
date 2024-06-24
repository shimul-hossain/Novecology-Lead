<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapInfoToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->string('setAddressLatValue')->after('company_address')->nullable();
            $table->string('setAddressLngValue')->after('setAddressLatValue')->nullable();
            $table->string('setAddressName')->after('setAddressLngValue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('setAddressLatValue');
            $table->dropColumn('setAddressLngValue');
            $table->dropColumn('setAddressName');
        });
    }
}
