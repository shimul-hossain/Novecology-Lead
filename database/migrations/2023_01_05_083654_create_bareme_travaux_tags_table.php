<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaremeTravauxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bareme_travaux_tags', function (Blueprint $table) {
            $table->id();
            $table->string('bareme')->nullable();
            $table->text('bareme_description')->nullable();
            $table->text('travaux')->nullable();
            $table->string('tag')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('grand_precaire_montant_maprime_no_fioul')->nullable();
            $table->integer('grand_precaire_montant_maprime_fioul')->nullable();
            $table->integer('grand_precaire_montant_cee_no_fioul')->nullable();
            $table->integer('grand_precaire_montant_cee_fioul')->nullable();
            $table->integer('precaire_montant_maprime_no_fioul')->nullable();
            $table->integer('precaire_montant_maprime_fioul')->nullable();
            $table->integer('precaire_montant_cee_no_fioul')->nullable();
            $table->integer('precaire_montant_cee_fioul')->nullable();
            $table->integer('intermediaire_montant_maprime_no_fioul')->nullable();
            $table->integer('intermediaire_montant_maprime_fioul')->nullable();
            $table->integer('intermediaire_montant_cee_no_fioul')->nullable();
            $table->integer('intermediaire_montant_cee_fioul')->nullable();
            $table->integer('classique_montant_maprime_no_fioul')->nullable();
            $table->integer('classique_montant_maprime_fioul')->nullable();
            $table->integer('classique_montant_cee_no_fioul')->nullable();
            $table->integer('classique_montant_cee_fioul')->nullable();
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
        Schema::dropIfExists('bareme_travaux_tags');
    }
}
