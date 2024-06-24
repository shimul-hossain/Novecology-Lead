<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturations', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('customer_payment')->nullable(); 
            $table->text('status_invoice_customer_payment')->nullable();
            $table->text('invoice_customer_amount')->nullable();
            $table->text('invoice_customer_forme')->nullable();
            $table->text('invoice_customer_mode')->nullable();
            $table->text('invoice_customer_nubmer_of_month')->nullable(); 
            $table->text('invoice_customer_date1')->nullable();
            $table->text('invoice_customer_amount21')->nullable();
            $table->text('invoice_customer_status1')->nullable();
            $table->text('invoice_customer_mode21')->nullable(); 
            $table->text('invoice_customer_date2')->nullable();
            $table->text('invoice_customer_amount22')->nullable();
            $table->text('invoice_customer_status2')->nullable();
            $table->text('invoice_customer_mode22')->nullable(); 
            $table->text('invoice_customer_date3')->nullable();
            $table->text('invoice_customer_amount23')->nullable();
            $table->text('invoice_customer_status3')->nullable();
            $table->text('invoice_customer_mode23')->nullable(); 
            $table->text('invoice_customer_date4')->nullable();
            $table->text('invoice_customer_amount24')->nullable();
            $table->text('invoice_customer_status4')->nullable();
            $table->text('invoice_customer_mode24')->nullable(); 
            $table->text('invoice_customer_date5')->nullable();
            $table->text('invoice_customer_amount25')->nullable();
            $table->text('invoice_customer_status5')->nullable();
            $table->text('invoice_customer_mode25')->nullable(); 
            $table->text('invoice_customer_date6')->nullable();
            $table->text('invoice_customer_amount26')->nullable();
            $table->text('invoice_customer_status6')->nullable();
            $table->text('invoice_customer_mode26')->nullable(); 
            $table->text('invoice_customer_date7')->nullable();
            $table->text('invoice_customer_amount27')->nullable();
            $table->text('invoice_customer_status7')->nullable();
            $table->text('invoice_customer_mode27')->nullable(); 
            $table->text('invoice_customer_date8')->nullable();
            $table->text('invoice_customer_amount28')->nullable();
            $table->text('invoice_customer_status8')->nullable();
            $table->text('invoice_customer_mode28')->nullable(); 
            $table->text('invoice_customer_date9')->nullable();
            $table->text('invoice_customer_amount29')->nullable();
            $table->text('invoice_customer_status9')->nullable();
            $table->text('invoice_customer_mode29')->nullable(); 
            $table->text('invoice_customer_date10')->nullable();
            $table->text('invoice_customer_amount210')->nullable();
            $table->text('invoice_customer_status10')->nullable();
            $table->text('invoice_customer_mode210')->nullable(); 
            $table->text('invoice_customer_date11')->nullable();
            $table->text('invoice_customer_amount211')->nullable();
            $table->text('invoice_customer_status11')->nullable();
            $table->text('invoice_customer_mode211')->nullable(); 
            $table->text('invoice_customer_date12')->nullable();
            $table->text('invoice_customer_amount212')->nullable();
            $table->text('invoice_customer_status12')->nullable();
            $table->text('invoice_customer_mode212')->nullable(); 
            $table->text('regulation_cee')->nullable(); 
            $table->text('invoice_status_cee')->nullable();
            $table->text('delegataire')->nullable();
            $table->text('cumac')->nullable();
            $table->text('amount_cee_bonus')->nullable();
            $table->text('amount_cee_noveco')->nullable();
            $table->text('business_support_amount')->nullable();
            $table->text('regulation_lot')->nullable();
            $table->text('date_depot_polluter')->nullable();
            $table->text('invoice_number_noveco')->nullable();
            $table->text('regulation_maprimerenonv')->nullable(); 
            $table->text('invoice_status_mpr')->nullable();
            $table->text('invoice_amount_mpr')->nullable();
            $table->text('manager')->nullable();
            $table->text('construction_company')->nullable();
            $table->text('invoice_date_deposit_mpr')->nullable();
            $table->text('invoice_number')->nullable();
            $table->text('regulation_action_logement')->nullable(); 
            $table->text('regulation_banque')->nullable(); 
            $table->text('invoice_status_banque')->nullable();
            $table->text('section_banque')->nullable();
            $table->text('agency_file')->nullable();
            $table->text('invoice_banque_amount')->nullable();
            $table->text('date_contract_sent')->nullable();
            $table->text('tracking_number')->nullable();
            $table->text('date_of_application')->nullable();
            $table->text('pay_the')->nullable();
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
        Schema::dropIfExists('facturations');
    }
}
