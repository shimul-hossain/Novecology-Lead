<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->date('account_created_on')->nullable();
            $table->integer('account_created_by')->nullable();
            $table->date('account_email_created_on')->nullable();
            $table->integer('account_email_created_by')->nullable(); 
            $table->string('thunderbir_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('account_created_on');
            $table->dropColumn('account_created_by');
            $table->dropColumn('account_email_created_on');
            $table->dropColumn('account_email_created_by');
            $table->dropColumn('thunderbir_status');
        });
    }
}
