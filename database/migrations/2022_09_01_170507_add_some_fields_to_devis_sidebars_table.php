<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToDevisSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devis_sidebars', function (Blueprint $table) {
            $table->string('civility')->nullable();
            $table->string('civility_name')->nullable();
            $table->string('civility_first_name')->nullable();
            $table->string('civility_mobile')->nullable();
            $table->string('civility_fax')->nullable();
            $table->string('civility2')->nullable();
            $table->string('civility_name2')->nullable();
            $table->string('civility_first_name2')->nullable();
            $table->string('civility_mobile2')->nullable();
            $table->string('civility_fax2')->nullable();
            $table->string('civility_address')->nullable();
            $table->string('civility_complement')->nullable();
            $table->string('civility_cp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devis_sidebars', function (Blueprint $table) {
            $table->dropColumn('civility');
            $table->dropColumn('civility_name');
            $table->dropColumn('civility_first_name');
            $table->dropColumn('civility_mobile');
            $table->dropColumn('civility_fax');
            $table->dropColumn('civility2');
            $table->dropColumn('civility_name2');
            $table->dropColumn('civility_first_name2');
            $table->dropColumn('civility_mobile2');
            $table->dropColumn('civility_fax2');
            $table->dropColumn('civility_address');
            $table->dropColumn('civility_complement');
            $table->dropColumn('civility_cp');
        });
    }
}
