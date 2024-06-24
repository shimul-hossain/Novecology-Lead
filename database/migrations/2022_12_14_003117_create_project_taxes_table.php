<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('tax_number');
            $table->string('tax_reference');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_title')->nullable();
            $table->string('second_first_name')->nullable();
            $table->string('second_last_name')->nullable();
            $table->string('kids')->nullable();
            $table->string('phone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('pays')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable(); 
            $table->enum('primary',['yes', 'no'])->default('no');
            $table->string('type')->default('scraping');
            $table->string('mark_check')->default('no');
            $table->text('address2')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('project_taxes');
    }
}
