<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTagProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tag_products', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->nullable();
            $table->string('tag_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('Montant_TTC')->nullable();
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
        Schema::dropIfExists('project_tag_products');
    }
}
