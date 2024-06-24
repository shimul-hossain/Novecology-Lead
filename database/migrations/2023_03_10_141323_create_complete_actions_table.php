<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompleteActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('controle_sur_site_id')->nullable();
            $table->longText('Description_action_corrective')->nullable();
            $table->text('Date')->nullable();
            $table->text('Statut_mise_en_conformité')->nullable();
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
        Schema::dropIfExists('complete_actions');
    }
}
