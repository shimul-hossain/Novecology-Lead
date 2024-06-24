<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('project_id');
            $table->integer('quantity')->nullable();
            $table->string('mouvement');
            $table->timestamp('date');
            $table->integer('mouvement_id');
            $table->integer('entrepot_id');
            $table->integer('user_id');
            $table->text('plaque_immatriculation')->nullable();
            $table->integer('personnel_autorise_id');
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('mouvements');
    }
}
