<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNewFieldPrecariousnessYearToNewClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->string('precariousness_year')->nullable()->default('2024');
        });
        DB::table('new_clients')->update(['precariousness_year' => '2023']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->dropColumn('precariousness_year');
        });
    }
}
