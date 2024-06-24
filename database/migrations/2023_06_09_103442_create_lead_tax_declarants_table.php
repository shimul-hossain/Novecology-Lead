<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadTaxDeclarantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_tax_declarants', function (Blueprint $table) {
            $table->id();
            $table->integer('tax_id');
            $table->text('Nom_et_prénom_déclarant')->nullable();
            $table->timestamp('Date_de_naissance_déclarant')->nullable();
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
        Schema::dropIfExists('lead_tax_declarants');
    }
}
