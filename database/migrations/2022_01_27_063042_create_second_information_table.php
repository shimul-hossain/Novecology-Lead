<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_information', function (Blueprint $table) {
            $table->id();
            $table->date('deposit_date')->nullable();
            $table->string('Logement_file')->nullable();
            $table->string('estimated_amount')->nullable();
            $table->text('deposited_work')->nullable();
            $table->string('logement_status')->nullable();
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
        Schema::dropIfExists('second_information');
    }
}
