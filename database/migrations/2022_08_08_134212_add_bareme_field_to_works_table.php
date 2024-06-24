<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaremeFieldToWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->text('bareme')->nullable();
            $table->text('tag')->nullable();
            $table->string('subvention')->nullable();
            $table->text('subvention_item')->nullable();
            $table->string('subvention_amount')->nullable();
            $table->string('credit')->nullable();
            $table->text('credit_item')->nullable();
            $table->string('credit_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('bareme');
            $table->dropColumn('tag');
            $table->dropColumn('subvention');
            $table->dropColumn('subvention_item');
            $table->dropColumn('subvention_amount');
            $table->dropColumn('credit');
            $table->dropColumn('credit_item');
            $table->dropColumn('credit_amount');
        });
    }
}
