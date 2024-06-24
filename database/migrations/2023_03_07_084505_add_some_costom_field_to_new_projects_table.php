<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeCostomFieldToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->longText('lead_tracking_custom_field_data')->nullable();
            $table->longText('personal_info_custom_field_data')->nullable();
            $table->longText('eligibility_custom_field_data')->nullable();
            $table->longText('information_logement_custom_field_data')->nullable();
            $table->longText('situation_foyer_custom_field_data')->nullable();
            $table->longText('project_custom_field_data')->nullable();
            $table->longText('controle_des_custom_field_data')->nullable();
            $table->longText('campte_custom_field_data')->nullable();
            $table->longText('myprimempr_custom_field_data')->nullable();
            $table->longText('subvention_custom_field_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->dropColumn('lead_tracking_custom_field_data');
            $table->dropColumn('personal_info_custom_field_data');
            $table->dropColumn('eligibility_custom_field_data');
            $table->dropColumn('information_logement_custom_field_data');
            $table->dropColumn('situation_foyer_custom_field_data');
            $table->dropColumn('project_custom_field_data');
            $table->dropColumn('controle_des_custom_field_data');
            $table->dropColumn('campte_custom_field_data');
            $table->dropColumn('myprimempr_custom_field_data');
            $table->dropColumn('subvention_custom_field_data');
        });
    }
}
