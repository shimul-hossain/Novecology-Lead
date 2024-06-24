<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketings', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('ticket_type')->nullable();
            $table->integer('problem_id')->nullable();
            $table->string('deadline')->nullable();
            $table->longText('details')->nullable();
            $table->integer('open_by')->nullable();
            $table->timestamp('close_at')->nullable();
            $table->integer('close_by')->nullable();
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
        Schema::dropIfExists('ticketings');
    }
}
