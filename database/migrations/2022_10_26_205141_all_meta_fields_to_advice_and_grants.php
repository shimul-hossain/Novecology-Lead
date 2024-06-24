<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllMetaFieldsToAdviceAndGrants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advice_and_grants', function (Blueprint $table) {
            $table->longText('meta_author')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('og_type')->nullable();
            $table->longText('og_url')->nullable();
            $table->longText('og_title')->nullable();
            $table->longText('og_description')->nullable();
            $table->longText('og_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advice_and_grants', function (Blueprint $table) {
            $table->dropColumn('meta_author');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_keyword');
            $table->dropColumn('meta_description');
            $table->dropColumn('og_type');
            $table->dropColumn('og_url');
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_image');
        });
    }
}
