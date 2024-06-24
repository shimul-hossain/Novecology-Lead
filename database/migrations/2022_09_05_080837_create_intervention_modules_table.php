<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_modules', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();
            $table->text('intervention_type')->nullable();
            $table->text('study_date')->nullable();
            $table->text('hour')->nullable();
            $table->text('status_planning_study')->nullable();
            $table->text('technician_study')->nullable();
            $table->text('technique_referee')->nullable();
            $table->text('status_feasibility_study')->nullable();
            $table->text('contract_status')->nullable();
            $table->text('travaux_list')->nullable();
            $table->text('dead_reason')->nullable();
            $table->text('reflection_reason')->nullable();
            $table->text('date_de_previsite')->nullable();
            $table->text('status_planning_previsite')->nullable();
            $table->text('technician_previsite')->nullable();
            $table->text('status_previsite')->nullable();
            $table->text('status_feasibility_previsite')->nullable();
            $table->text('counter_visit_technique_date')->nullable(); 
            $table->text('status_planning_counter_visit')->nullable();
            $table->text('technician_counter_visit')->nullable();
            $table->text('status_counter_visit')->nullable();
            $table->text('status_feasibility_counter_visit')->nullable();
            $table->text('installation_date')->nullable();
            $table->text('technician_installation')->nullable();
            $table->text('team_leader_installation')->nullable();
            $table->text('travaux_release_installation')->nullable();
            $table->text('reception_photo')->nullable();
            $table->text('reception_file')->nullable();
            $table->text('sav_date')->nullable();
            $table->text('stutus_planning_sav')->nullable();
            $table->text('technician_sav')->nullable();
            $table->text('status_resolution_sav')->nullable();
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
        Schema::dropIfExists('intervention_modules');
    }
}
