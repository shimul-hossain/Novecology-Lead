<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRappelerFieldToNewClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->timestamp('callback_time')->nullable();
            $table->integer('callback_user_id')->nullable();
            $table->text('callback_mail_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_clients', function (Blueprint $table) {
            $table->dropColumn('callback_time');
            $table->dropColumn('callback_user_id');
            $table->dropColumn('callback_mail_status');
        });
    }
}
