<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('nature_occupation')->nullable();
            $table->string('heating_type')->nullable();
            $table->string('housing_type')->nullable();
            $table->string('living_space')->nullable();
            $table->string('cadstrable_plot')->nullable();
            $table->string('floor_area')->nullable();
            $table->string('house_type')->nullable();
            $table->string('with_basement')->nullable();
            $table->integer('company_id');
            $table->string('company_name')->nullable();
            $table->string('status')->default('in-progress');
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
        Schema::dropIfExists('leads');
    }
}
