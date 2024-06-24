<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_products', function (Blueprint $table) {
            $table->id();
            $table->string('prestation_type')->nullable();
            $table->string('operation_cee')->nullable();
            $table->integer('prestation_id')->nullable();
            $table->string('linked_operation')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('order')->default(0);
            $table->string('pu_ttc')->nullable();
            $table->string('tax')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('total_ttc')->nullable();
            $table->string('view_price')->nullable();
            $table->string('status')->nullable();
            $table->integer('project_id');
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
        Schema::dropIfExists('additional_products');
    }
}
