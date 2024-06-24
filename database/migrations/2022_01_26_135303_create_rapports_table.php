<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->string('status_previsite')->nullable();
            $table->string('customer_status_previsite')->nullable();
            $table->string('dead_reason')->nullable();
            $table->string('valid_project')->nullable();
            $table->string('devis_signe')->nullable();
            $table->string('predicted_report')->nullable();
            $table->string('additional_work2')->nullable();
            $table->string('circuit2_devis')->nullable();
            $table->string('circuit2_amount')->nullable();
            $table->string('circuit1_devis')->nullable();
            $table->string('circuit1_amount')->nullable();
            $table->string('conduit_double')->nullable();
            $table->string('conduit_double_amount')->nullable();
            $table->string('conduit')->nullable();
            $table->string('conduit_amount')->nullable();
            $table->string('water_inlet')->nullable();
            $table->string('water_inlet_amount')->nullable();
            $table->string('electricity')->nullable();
            $table->string('electricity_amount')->nullable();
            $table->text('comment')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('rapports');
    }
}
