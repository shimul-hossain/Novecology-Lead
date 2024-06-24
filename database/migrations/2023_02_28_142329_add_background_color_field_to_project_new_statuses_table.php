<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBackgroundColorFieldToProjectNewStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_new_statuses', function (Blueprint $table) {
            $table->string('status_color')->nullable();
            $table->string('background_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_new_statuses', function (Blueprint $table) {
            $table->dropColumn('status_color');
            $table->dropColumn('background_color');
        });
    }
}
