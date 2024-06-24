<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePhotoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->string('profile_photo')->after('password')->nullable();
             $table->string('telephone')->after('profile_photo')->nullable();
             $table->string('department')->after('telephone')->nullable();
             $table->string('precariousness')->after('department')->nullable();
             $table->string('zone')->after('precariousness')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
            $table->dropColumn('telephone');
            $table->dropColumn('department');
            $table->dropColumn('precariousness');
            $table->dropColumn('zone');
        });
    }
}
