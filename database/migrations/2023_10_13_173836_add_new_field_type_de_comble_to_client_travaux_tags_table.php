<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldTypeDeCombleToClientTravauxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_travaux_tags', function (Blueprint $table) {
            $table->text('Type_de_comble')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_travaux_tags', function (Blueprint $table) {
            $table->dropColumn('Type_de_comble');
        });
    }
}
