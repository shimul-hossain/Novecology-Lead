<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddANewFieldToNonConfirmReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('non_confirm_reasons', function (Blueprint $table) {
            $table->longText('Description_action_corrective')->nullable();
            $table->text('Date')->nullable();
            $table->text('Statut_mise_en_conformité')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('non_confirm_reasons', function (Blueprint $table) {
            $table->dropColumn('Description_action_corrective');
            $table->dropColumn('Date');
            $table->dropColumn('Statut_mise_en_conformité');
        });
    }
}
