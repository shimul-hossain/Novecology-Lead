<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->string('reference_link')->default('off');
            $table->string('designation_link')->default('off');
            $table->integer('position')->nullable();
            $table->string('unit')->nullable();
            $table->string('tax')->nullable();
            $table->string('price_show')->default('off');
            $table->string('related_price')->default('off');
            $table->string('recall')->default('off');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->dropColumn('reference_link');
            $table->dropColumn('designation_link');
            $table->dropColumn('position');
            $table->dropColumn('unit');
            $table->dropColumn('tax');
            $table->dropColumn('price_show');
            $table->dropColumn('related_price');
            $table->dropColumn('recall');
        });
    }
}
