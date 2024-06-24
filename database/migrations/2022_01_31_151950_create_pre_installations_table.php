<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_installations', function (Blueprint $table) {
            $table->id();
            $table->date('quality_control_date')->nullable();
            $table->string('operator')->nullable();
            $table->string('client_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->date('sales_meeting_date')->nullable();
            $table->string('project')->nullable();
            $table->string('commercial')->nullable();
            $table->longText('introduction_operator')->nullable();
            $table->longText('project_details')->nullable();
            $table->string('meeting_experience')->nullable();
            $table->string('evaluation_rating')->nullable();
            $table->string('remind_me')->nullable();
            $table->string('occupants_number')->nullable();
            $table->string('home_built_time')->nullable();
            $table->string('surface')->nullable();
            $table->string('heating_type')->nullable();
            $table->string('heated_levels')->nullable();
            $table->string('transmitters_type')->nullable();
            $table->string('other_transmitters_type')->nullable();
            $table->string('hot_water_production')->nullable();
            $table->string('other_hot_water_production')->nullable();
            $table->string('have_insulation')->nullable();
            $table->string('have_insulation_wall')->nullable();
            $table->string('have_insulation_basement')->nullable();
            $table->string('boiler_model')->nullable();
            $table->string('esc_model')->nullable();
            $table->string('bio_services')->nullable();
            $table->string('question_material')->nullable();
            $table->string('professional_situation')->nullable();
            $table->string('other_professional_situation')->nullable();
            $table->string('family_situation')->nullable();
            $table->string('have_children')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('current_credits')->nullable();
            $table->string('credit_1')->nullable();
            $table->string('credit_2')->nullable();
            $table->string('credit_3')->nullable();
            $table->string('credit_4')->nullable();
            $table->string('bank_status')->nullable();
            $table->string('have_bdc_copy')->nullable();
            $table->string('approved_funding')->nullable();
            $table->string('monthly_payments')->nullable();
            $table->string('financing_partner')->nullable();
            $table->string('eec_amount')->nullable();
            $table->string('renov_amount')->nullable();
            $table->string('renov_paid')->nullable();
            $table->string('deferral_system')->nullable();
            $table->string('know_more')->nullable();
            $table->longText('motivational_note')->nullable();
            $table->longText('general_comments')->nullable();
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
        Schema::dropIfExists('pre_installations');
    }
}
