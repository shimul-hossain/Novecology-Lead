<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChilrenStatusToSecondClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('second_clients', function (Blueprint $table) {
             $table->string('children__status')->default('no');
            $table->string('Type_du_courant_du_logement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('second_clients', function (Blueprint $table) {
            $table->dropColumn('children__status');
            $table->dropColumn('Type_du_courant_du_logement');
        });
    }
}
