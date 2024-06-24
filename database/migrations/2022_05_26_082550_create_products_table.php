<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_type')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('marque_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('standard')->nullable();
            $table->longText('designation')->nullable();
            $table->longText('sizing_note')->nullable();
            $table->string('acermi_reference')->nullable();
            $table->string('acermi_date')->nullable();
            $table->string('acermi_file')->nullable();
            $table->string('certita_reference')->nullable();
            $table->string('certita_date')->nullable();
            $table->string('certita_file')->nullable();
            $table->string('notice_reference')->nullable();
            $table->string('notice_date')->nullable();
            $table->string('notice_file')->nullable();
            $table->string('data_file')->nullable();
            $table->string('ce_marking')->default('off');
            $table->string('activate')->default('off');
            $table->text('baremes')->nullable();
            $table->string('installation_mode')->nullable();
            $table->string('covering_capacity')->nullable();
            $table->string('thikness')->nullable();
            $table->string('thermal_res')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
