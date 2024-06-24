<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('product')->after('montant')->nullable();
            $table->string('previsite')->after('product')->nullable();
            $table->string('projet_valide')->after('previsite')->nullable();
            $table->string('devis_signe')->after('projet_valide')->nullable();
            $table->string('project_charge')->after('devis_signe')->nullable();
            $table->string('additional_work')->after('project_charge')->nullable();
            $table->string('additional_work_payable')->after('additional_work')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('previsite');
            $table->dropColumn('projet_valide');
            $table->dropColumn('devis_signe');
            $table->dropColumn('project_charge');
            $table->dropColumn('additional_work');
            $table->dropColumn('additional_work_payable'); 
        });
    }
}
