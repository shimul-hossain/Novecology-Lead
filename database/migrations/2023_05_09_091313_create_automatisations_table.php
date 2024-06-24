<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomatisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automatisations', function (Blueprint $table) {
            $table->id();
            $table->string('nom_campagne');
            $table->string('type_de_campagne');
            $table->string('recurrence');
            $table->timestamp('date_de_debut')->nullable();
            $table->string('horaire_de_debut')->nullable();
            $table->timestamp('date_de_fin')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('automatisations');
    }
}
