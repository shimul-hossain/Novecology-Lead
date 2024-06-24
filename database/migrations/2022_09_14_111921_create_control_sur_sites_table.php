<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlSurSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_sur_sites', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();
            $table->text('type')->nullable();
            $table->text('controle_office')->nullable();
            $table->text('control_date')->nullable();
            $table->text('inspection_status')->nullable();
            $table->text('controlled_workd')->nullable();
            $table->text('compliance')->nullable();
            $table->text('m2_controlled')->nullable();
            $table->text('m2_achieved')->nullable();
            $table->text('difference_m2')->nullable();
            $table->text('company_commissioned')->nullable();
            $table->text('date_of_commissioning')->nullable();
            $table->text('technician')->nullable();
            $table->text('commissioning_status')->nullable(); 
            $table->text('audit_report')->nullable();
            $table->text('compliance_resolved')->nullable();
            $table->text('compliance_resolved_reason')->nullable();
            $table->text('compliance_sattled')->nullable();
            $table->text('compliance_sattled_reason')->nullable();
            $table->text('audit_facture')->nullable();
            $table->text('invoice_number')->nullable();
            $table->text('status_facture')->nullable();
            $table->text('mes_price')->nullable();
            $table->text('deal')->nullable();
            $table->text('observation_company')->nullable();
            $table->text('controle_office_csp')->nullable();
            $table->text('control_date_csp')->nullable();
            $table->text('csp_status')->nullable(); 
            $table->text('transit_slip')->nullable();
            $table->text('observation_control')->nullable();
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
        Schema::dropIfExists('control_sur_sites');
    }
}
