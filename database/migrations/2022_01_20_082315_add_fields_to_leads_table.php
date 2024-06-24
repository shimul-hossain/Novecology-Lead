<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) { 
            $table->string('present_city')->after('city')->nullable();
            $table->string('present_zipcode')->after('present_city')->nullable();
            $table->string('present_address')->after('present_zipcode')->nullable();
            $table->string('user_status')->after('comment')->nullable();
            $table->string('status_color')->after('user_status')->nullable();
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
            $table->dropColumn('present_city');
            $table->dropColumn('present_zipcode');
            $table->dropColumn('present_address');
            $table->dropColumn('user_status');
            $table->dropColumn('status_color');
        });
    }
}
