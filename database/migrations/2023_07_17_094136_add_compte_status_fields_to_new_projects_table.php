<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompteStatusFieldsToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('compte_email_status')->nullable();
            $table->text('compte_email_recovery_status')->nullable();
            $table->text('compte_MaPrimeRénov_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->dropColumn('compte_email_status');
            $table->dropColumn('compte_email_recovery_status');
            $table->dropColumn('compte_MaPrimeRénov_status');
        });
    }
}
