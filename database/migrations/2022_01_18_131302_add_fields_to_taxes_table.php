<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->string('title')->after('tax_reference')->nullable();
            $table->string('first_name')->after('title')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('second_title')->after('last_name')->nullable();
            $table->string('second_first_name')->after('second_title')->nullable();
            $table->string('second_last_name')->after('second_first_name')->nullable();
            $table->string('kids')->after('second_last_name')->nullable();
            $table->string('phone')->after('kids')->nullable();
            $table->string('email')->after('phone')->nullable();
            $table->string('pays')->after('email')->nullable();
            $table->string('postal_code')->after('pays')->nullable();
            $table->string('city')->after('postal_code')->nullable();
            $table->string('address')->after('city')->nullable(); 
            $table->enum('primary',['yes', 'no'])->after('address')->default('no');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxes', function (Blueprint $table) {
             $table->dropColumn('title');
             $table->dropColumn('first_name');
             $table->dropColumn('last_name');
             $table->dropColumn('second_title');
             $table->dropColumn('second_first_name');
             $table->dropColumn('second_last_name');
             $table->dropColumn('kids');
             $table->dropColumn('phone');
             $table->dropColumn('email');
             $table->dropColumn('pays');
             $table->dropColumn('postal_code');
             $table->dropColumn('city');
             $table->dropColumn('address'); 
        });
    }
}
