<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeNewFieldsToAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->text('Audit_envoyé_le')->nullable();
            $table->text('Audit_reçu_le')->nullable();
            $table->text('Scénario_choisi')->nullable();
            $table->text('Travaux_du_scénario_choisi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit', function (Blueprint $table) {
            $table->dropColumn('Audit_envoyé_le');
            $table->dropColumn('Audit_reçu_le');
            $table->dropColumn('Scénario_choisi');
            $table->dropColumn('Travaux_du_scénario_choisi');
        });
    }
}
