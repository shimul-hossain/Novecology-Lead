<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackerDetailsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            
            $table->enum('convert_status',['yes', 'no'])->after('status')->default('no');
            $table->string('owner')->after('convert_status')->nullable();
            $table->string('house_over_15_years')->after('owner')->nullable();
            $table->dateTime('date')->after('house_over_15_years')->nullable();
            $table->string('duplicate_analysis')->after('date')->nullable();
            $table->string('management')->after('duplicate_analysis')->nullable();
            $table->string('transfer_office_17')->after('management')->nullable();
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

            $table->dropColumn('convert_status');
            $table->dropColumn('owner');
            $table->dropColumn('house_over_15_years');
            $table->dropColumn('date');
            $table->dropColumn('duplicate_analysis');
            $table->dropColumn('management');
            $table->dropColumn('transfer_office_17');
        });
    }
}
