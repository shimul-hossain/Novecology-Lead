<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('input_type');
            $table->string('name');
            $table->string('required')->default('yes');
            $table->longText('options')->nullable();
            $table->integer('order')->nullable();
            $table->string('collapse_name')->nullable();
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
        Schema::dropIfExists('client_custom_fields');
    }
}
