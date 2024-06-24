<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorFieldsToLeadSubStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_sub_statuses', function (Blueprint $table) {
            $table->string('background_color')->default('#8e27b3');
            $table->string('text_color')->default('#ffffff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_sub_statuses', function (Blueprint $table) {
            $table->dropColumn('background_color');
            $table->dropColumn('text_color');
        });
    }
}
