<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyAidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy_aids', function (Blueprint $table) {
            $table->id();
            $table->string('prime_cee')->nullable();
            $table->string('prime_montant')->nullable();
            $table->string('prime_devis_condition')->nullable();
            $table->string('prime_devis_deduct')->nullable();
            $table->string('prime_facture_condition')->nullable();
            $table->string('prime_facture_deduct')->nullable();
            $table->string('maprime')->nullable();
            $table->string('maprime_montant')->nullable();
            $table->string('maprime_devis_condition')->nullable();
            $table->string('maprime_devis_deduct')->nullable();
            $table->string('maprime_facture_condition')->nullable();
            $table->string('maprime_facture_deduct')->nullable();
            $table->string('maprime_output_bonus')->nullable();
            $table->string('maprime_bbc_bonus')->nullable();
            $table->string('maprime_removal_oil_tank')->nullable();
            $table->string('action_logement')->nullable();
            $table->string('logement_montant')->nullable();
            $table->string('logement_devis_condition')->nullable();
            $table->string('logement_devis_deduct')->nullable();
            $table->string('logement_facture_condition')->nullable();
            $table->string('logement_facture_deduct')->nullable();
            $table->string('charge')->nullable();
            $table->string('charge_montant')->nullable();
            $table->string('charge_devis_condition')->nullable();
            $table->string('charge_devis_deduct')->nullable();
            $table->string('charge_facture_condition')->nullable();
            $table->string('charge_facture_deduct')->nullable();
            $table->string('commercial_discount')->nullable();
            $table->string('grant_amount')->nullable();
            $table->string('total_ht')->nullable();
            $table->string('total_prime_cee')->nullable();
            $table->string('total_tva')->nullable();
            $table->string('total_maprime')->nullable();
            $table->string('total_ttc')->nullable();
            $table->string('pay_remainder')->nullable();
            $table->integer('project_id')->nullable();
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
        Schema::dropIfExists('energy_aids');
    }
}
