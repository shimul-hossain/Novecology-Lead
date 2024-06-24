<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('information', function (Blueprint $table) {
            $table->string('subvention_deposit_date')->after('deposited_work')->nullable();
            $table->string('subvention_mpr_file')->after('subvention_deposit_date')->nullable();
            $table->string('subvention_estimated_amount')->after('subvention_mpr_file')->nullable();
            $table->string('subvention_deposited_work')->after('subvention_estimated_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn('subvention_deposit_date');
            $table->dropColumn('subvention_mpr_file');
            $table->dropColumn('subvention_estimated_amount');
            $table->dropColumn('subvention_deposited_work');
        });
    }
}
