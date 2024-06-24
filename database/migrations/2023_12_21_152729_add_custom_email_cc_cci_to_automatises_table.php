<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomEmailCcCciToAutomatisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automatises', function (Blueprint $table) {
            $table->string('custom_email_cc')->nullable();
            $table->string('custom_email_cci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('automatises', function (Blueprint $table) {
            $table->dropColumn('custom_email_cc');
            $table->dropColumn('custom_email_cci');
        });
    }
}
