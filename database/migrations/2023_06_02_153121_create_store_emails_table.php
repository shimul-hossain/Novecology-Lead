<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_emails', function (Blueprint $table) {
            $table->id();
            $table->string('from')->nullable();
            $table->string('date')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('body')->nullable();
            $table->string('email_id')->nullable();
            $table->bigInteger('uid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_emails');
    }
}
