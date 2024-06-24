<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanqueDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banque_depots', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();   
            $table->integer('banque_id')->nullable();   
            $table->string('banque_montant')->nullable();   
            $table->string('date_depot')->nullable();   
            $table->string('banque_numero_de_dossier')->nullable();   
            $table->string('banque_status')->nullable();   
            $table->string('manque_document')->nullable();   
            $table->string('montant_credit')->nullable();   
            $table->string('banque_notification_date')->nullable();   
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
        Schema::dropIfExists('banque_depots');
    }
}
