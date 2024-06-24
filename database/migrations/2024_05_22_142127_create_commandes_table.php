<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('statut_id');
            $table->timestamp('date');
            $table->longText('reference_commande')->nullable();
            $table->integer('fournisseur_id');
            $table->string('bon_de_livraison')->nullable();
            $table->integer('type_de_livraison_id');
            $table->integer('enlevement_par_id');
            $table->integer('recu_par_id');
            $table->longText('observation')->nullable();
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
        Schema::dropIfExists('commandes');
    }
}
