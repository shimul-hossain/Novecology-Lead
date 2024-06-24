<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('pays')->nullable();
            $table->string('image')->nullable();
            $table->string('department')->nullable();
            $table->string('precariousness')->nullable();
            $table->string('zone')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('present_address')->nullable();
            $table->string('address_lat')->nullable();
            $table->string('address_lng')->nullable();
            $table->string('nature_occupation')->nullable();
            $table->string('occupation_type')->nullable();
            $table->string('fiscal_amount')->nullable();
            $table->string('foyer')->nullable();
            $table->string('family_person')->nullable();
            $table->string('date_fo_construction')->nullable();
            $table->string('auxiliary_heating')->nullable();
            $table->string('heating_type')->nullable();
            $table->string('second_heating_type')->nullable();
            $table->string('other_second_heating_type')->nullable();
            $table->string('transmitter_type')->nullable();
            $table->string('number_of_radiator')->nullable();
            $table->string('radiator_type')->nullable();
            $table->string('other_radiator_type')->nullable();
            $table->string('hot_water_production')->nullable();
            $table->string('hot_water_feature')->nullable();
            $table->string('volume')->nullable();
            $table->string('annual_heating')->nullable();
            $table->string('adult_occupants')->nullable();
            $table->string('child_occupants')->nullable();
            $table->string('family_situation')->nullable(); 
            $table->string('mr_activity')->nullable();
            $table->string('mr_revenue')->nullable();
            $table->string('mrs_activity')->nullable();
            $table->string('mrs_revenue')->nullable();
            $table->string('monthly_credit')->nullable();
            $table->string('revenue_credit')->nullable(); 
            $table->string('living_space')->nullable();
            $table->string('cadstrable_plot')->nullable();
            $table->string('house_over_15_years')->nullable();
            $table->text('comment')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('lead_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('projects');
    }
}
