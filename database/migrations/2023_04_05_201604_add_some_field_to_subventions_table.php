<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToSubventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subventions', function (Blueprint $table) {
            $table->text('file_name')->nullable();
            $table->text('Statut_subvention_yes_file_name')->nullable();
            $table->text('Statut_subvention_no_file_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subventions', function (Blueprint $table) {
            $table->dropColumn('file_name');
            $table->dropColumn('Statut_subvention_yes_file_name');
            $table->dropColumn('Statut_subvention_no_file_name');
        });
    }
}
