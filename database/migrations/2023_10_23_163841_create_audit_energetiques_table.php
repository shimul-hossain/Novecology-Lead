<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEnergetiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_energetiques', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title');
            $table->text('banner_subtitle');
            $table->longText('banner_description');
            $table->string('banner_button_text');
            $table->string('banner_button_link')->nullable();
            $table->string('banner_image');
            $table->string('title');
            $table->longText('description'); 
            $table->string('first_block_title')->nullable();
            $table->string('first_block_image')->nullable();
            $table->longText('first_block_desciption')->nullable();
            $table->string('first_block_button_text')->nullable();
            $table->string('first_block_button_link')->nullable();
            $table->string('second_block_title')->nullable();
            $table->string('second_block_image')->nullable();
            $table->longText('second_block_desciption')->nullable();
            $table->string('second_block_button_text')->nullable();
            $table->string('second_block_button_link')->nullable(); 
            $table->string('third_block_title')->nullable();
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
        Schema::dropIfExists('audit_energetiques');
    }
}
