<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnotherFieldsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('occupation_type')->after('address')->nullable();
            $table->string('fiscal_amount')->after('occupation_type')->nullable();
            $table->string('foyer')->after('fiscal_amount')->nullable();
            $table->string('family_person')->after('foyer')->nullable();
            $table->enum('data_status',['yes','no'])->after('status_color')->default('no');
            $table->string('date_fo_construction')->after('family_person')->nullable();
            $table->string('auxiliary_heating')->after('date_fo_construction')->nullable();
            $table->string('second_heating_type')->after('auxiliary_heating')->nullable();
            $table->string('other_second_heating_type')->after('second_heating_type')->nullable();
            $table->string('transmitter_type')->after('other_second_heating_type')->nullable();
            $table->string('number_of_radiator')->after('transmitter_type')->nullable();
            $table->string('radiator_type')->after('number_of_radiator')->nullable();
            $table->string('other_radiator_type')->after('radiator_type')->nullable();
            $table->string('hot_water_production')->after('other_radiator_type')->nullable();
            $table->string('hot_water_feature')->after('hot_water_production')->nullable();
            $table->string('volume')->after('hot_water_feature')->nullable();
            $table->string('annual_heating')->after('volume')->nullable();
            $table->string('adult_occupants')->after('annual_heating')->nullable();
            $table->string('child_occupants')->after('adult_occupants')->nullable();
            $table->string('family_situation')->after('child_occupants')->nullable();
            $table->string('dependent_children')->after('family_situation')->nullable();
            $table->string('mr_activity')->after('dependent_children')->nullable();
            $table->string('mr_revenue')->after('mr_activity')->nullable();
            $table->string('mrs_activity')->after('mr_revenue')->nullable();
            $table->string('mrs_revenue')->after('mrs_activity')->nullable();
            $table->string('monthly_credit')->after('mrs_revenue')->nullable();
            $table->string('revenue_credit')->after('monthly_credit')->nullable();
            $table->string('address_lat')->after('present_address')->nullable();
            $table->string('address_lng')->after('address_lat')->nullable();
        
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('occupation_type');
            $table->dropColumn('fiscal_amount');
            $table->dropColumn('foyer');
            $table->dropColumn('family_person');
            $table->dropColumn('data_status');
            $table->dropColumn('date_fo_construction');
            $table->dropColumn('auxiliary_heating');
            $table->dropColumn('second_heating_type');
            $table->dropColumn('other_second_heating_type');
            $table->dropColumn('transmitter_type');
            $table->dropColumn('number_of_radiator');
            $table->dropColumn('radiator_type');
            $table->dropColumn('other_radiator_type');
            $table->dropColumn('hot_water_production');
            $table->dropColumn('hot_water_feature');
            $table->dropColumn('volume'); 
            $table->dropColumn('annual_heating'); 
            $table->dropColumn('adult_occupants'); 
            $table->dropColumn('child_occupants'); 
            $table->dropColumn('family_situation'); 
            $table->dropColumn('dependent_children'); 
            $table->dropColumn('mr_activity'); 
            $table->dropColumn('mr_revenue'); 
            $table->dropColumn('mrs_activity'); 
            $table->dropColumn('mrs_revenue'); 
            $table->dropColumn('monthly_credit'); 
            $table->dropColumn('revenue_credit'); 
            $table->dropColumn('address_lat'); 
            $table->dropColumn('address_lng'); 
        });
    }
}
