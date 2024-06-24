<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis_sidebars', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('deal')->nullable();
            $table->string('commercial_terrain')->nullable();
            $table->string('appointment_date')->nullable();
            $table->string('visited_date')->nullable();
            $table->string('teleoperator')->nullable();
            $table->string('commercial')->nullable();
            $table->string('previsitor')->nullable();
            $table->string('date_previsite')->nullable();
            $table->string('planned')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('source')->nullable();
            $table->string('campaign')->nullable();
            $table->string('file_number')->nullable();
            $table->string('external_file')->nullable();
            $table->string('officer')->nullable();
            $table->string('comment')->nullable();
            $table->string('quote_number')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('signed_date')->nullable();
            $table->string('facture_date')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('amending_invoice')->nullable();
            $table->string('edition_date')->nullable();
            $table->string('storage')->nullable();
            $table->string('receipt_date')->nullable();
            $table->string('receipt_date_agreement')->nullable();
            $table->string('amo')->nullable();
            $table->string('administrative_mandate')->nullable();
            $table->string('financial_mandate')->nullable();
            $table->string('agent')->nullable();
            $table->string('mrp_file_name')->nullable();
            $table->string('mrp_id')->nullable();
            $table->string('mrp_password')->nullable();
            $table->string('mrp_status')->nullable();
            $table->string('sub_status')->nullable();
            $table->string('submission_date')->nullable();
            $table->string('mail_answer')->nullable();
            $table->string('file_granted')->nullable();
            $table->string('balance_date')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('facture_invoice')->nullable();
            $table->string('settlement_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('volume')->nullable();
            $table->string('cost')->nullable();
            $table->string('volumecollection_point')->nullable();
            $table->integer('project_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devis_sidebars');
    }
}
