<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileImageToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('image')->after('email')->nullable();
            $table->string('department')->after('image')->nullable();
            $table->string('precariousness')->after('department')->nullable();
            $table->string('zone')->after('precariousness')->nullable();
            $table->string('comment')->after('status')->nullable();
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
            $table->dropColumn('image');
            $table->dropColumn('department');
            $table->dropColumn('precariousness');
            $table->dropColumn('zone');
        });
    }
}
