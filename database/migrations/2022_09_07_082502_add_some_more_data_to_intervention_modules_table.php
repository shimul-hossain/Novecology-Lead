<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeMoreDataToInterventionModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention_modules', function (Blueprint $table) {
            $table->after('observation', function($table){
                $table->text('status_document_study')->nullable();
                $table->text('status_document_previsite')->nullable();
                $table->text('if_complete')->nullable();
                $table->text('additional_travaux')->nullable();
                $table->text('additional_travaux_list')->nullable();
                $table->text('estimate_amount_ttc')->nullable();
                $table->text('paid_by_estimate')->nullable();
                $table->text('paid_by_customer')->nullable();
                $table->text('over_sale')->nullable();
                $table->text('amount_over_selling')->nullable();
                $table->text('installation_file')->nullable();
                $table->text('par')->nullable();
                $table->text('le')->nullable();
                $table->text('reception_photo_sav')->nullable();
                $table->text('reception_attestation_sav')->nullable();
                $table->text('status_planning_deplacement')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intervention_modules', function (Blueprint $table) {
            $table->dropColumn('status_document_study');
            $table->dropColumn('status_document_previsite');
            $table->dropColumn('if_complete');
            $table->dropColumn('additional_travaux');
            $table->dropColumn('additional_travaux_list');
            $table->dropColumn('estimate_amount_ttc');
            $table->dropColumn('paid_by_estimate');
            $table->dropColumn('paid_by_customer');
            $table->dropColumn('over_sale');
            $table->dropColumn('amount_over_selling');
            $table->dropColumn('installation_file');
            $table->dropColumn('par');
            $table->dropColumn('le');
            $table->dropColumn('reception_photo_sav');
            $table->dropColumn('reception_attestation_sav');
            $table->dropColumn('status_planning_deplacement');
        });
    }
}
