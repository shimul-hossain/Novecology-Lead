<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('image')->after('email')->nullable();
            $table->string('department')->after('image')->nullable();
            $table->string('precariousness')->after('department')->nullable();
            $table->string('address')->after('precariousness')->nullable();
            $table->string('nature_occupation')->after('address')->nullable();
            $table->string('housing_type')->after('nature_occupation')->nullable();
            $table->string('living_space')->after('housing_type')->nullable();
            $table->string('cadstrable_plot')->after('living_space')->nullable();
            $table->string('floor_area')->after('cadstrable_plot')->nullable();
            $table->string('with_basement')->after('floor_area')->nullable();
            $table->string('company_name')->after('with_basement')->nullable();
            $table->string('owner')->after('company_name')->nullable();
            $table->string('house_over_15_years')->after('owner')->nullable();
            $table->string('date')->after('house_over_15_years')->nullable();
            $table->string('duplicate_analysis')->after('date')->nullable();
            $table->string('management')->after('duplicate_analysis')->nullable();
            $table->string('transfer_office_17')->after('management')->nullable();
            $table->integer('user_id')->after('transfer_office_17')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) { 
            $table->dropColumn('image');
            $table->dropColumn('department');
            $table->dropColumn('precariousness');
            $table->dropColumn('address');
            $table->dropColumn('nature_occupation');
            $table->dropColumn('housing_type');
            $table->dropColumn('living_space');
            $table->dropColumn('cadstrable_plot');
            $table->dropColumn('floor_area');
            $table->dropColumn('with_basement');
            $table->dropColumn('company_name');
            $table->dropColumn('owner');
            $table->dropColumn('house_over_15_years');
            $table->dropColumn('date');
            $table->dropColumn('duplicate_analysis');
            $table->dropColumn('management');
            $table->dropColumn('transfer_office_17');
            $table->dropColumn('user_id');
        });
    }
}
