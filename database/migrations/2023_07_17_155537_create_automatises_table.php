<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomatisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automatises', function (Blueprint $table) {
            $table->id();
            $table->string('automatisation_for')->nullable();
            $table->string('type_de_campagne')->nullable();
            $table->string('sending_type')->nullable();
            $table->string('status')->nullable();
            $table->string('select_to')->nullable();
            $table->string('email_template')->nullable();
            $table->string('sms_template')->nullable();
            $table->string('active')->default('yes');
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
        Schema::dropIfExists('automatises');
    }
}
