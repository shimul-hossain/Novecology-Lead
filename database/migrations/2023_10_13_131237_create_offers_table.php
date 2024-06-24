<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('icon')->nullable();
            $table->text('feature_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('home_page_button_text')->nullable(); 
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('banner_button_text')->nullable();
            $table->string('banner_button_link')->nullable();
            $table->string('first_block_status')->nullable();
            $table->string('first_block_title')->nullable();
            $table->string('first_block_image')->nullable();
            $table->longText('first_block_desciption')->nullable();
            $table->string('first_block_button_text')->nullable();
            $table->string('first_block_button_link')->nullable();  
            $table->string('second_block_status')->nullable();
            $table->string('second_block_title')->nullable();
            $table->string('second_block_image')->nullable();
            $table->longText('second_block_desciption')->nullable();
            $table->string('second_block_button_text')->nullable();
            $table->string('second_block_button_link')->nullable();            
            $table->string('third_block_status')->nullable();            
            $table->string('third_block_title')->nullable();    
            $table->string('fourth_block_status')->nullable();
            $table->string('fourth_block_title')->nullable();
            $table->string('fourth_block_image')->nullable();
            $table->longText('fourth_block_desciption')->nullable();
            $table->string('fourth_block_button_text')->nullable();
            $table->string('fourth_block_button_link')->nullable();
            $table->string('fifth_block_status')->nullable();            
            $table->string('fifth_block_title')->nullable();            
            $table->longText('fifth_block_description')->nullable();  
            $table->string('sixth_block_status')->nullable();            
            $table->string('sixth_block_title')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
