<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingFieldToClintOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clint_opinions', function (Blueprint $table) {
            $table->integer('rating')->nullable();
            $table->string('publish_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clint_opinions', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('publish_date');
        });
    }
}
