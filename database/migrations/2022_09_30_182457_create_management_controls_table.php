<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_controls', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('material_invoice')->nullable();
            $table->text('material_invoice_status')->nullable();
            $table->text('material_invoice_supplier')->nullable();
            $table->text('equipment_list')->nullable();
            $table->text('material_invoice_number')->nullable();
            $table->text('material_invoice_date')->nullable();
            $table->text('material_invoice_paid_date')->nullable();
            $table->text('material_invoice_amount_ht')->nullable();
            $table->text('material_invoice_amount_ttc')->nullable();
            $table->text('material_invoice_amount_tva')->nullable();
            $table->text('material_invoice_observation')->nullable();
            $table->text('installer_invoice')->nullable();
            $table->text('installer_invoice_status')->nullable();
            $table->text('installer_invoice_installer')->nullable();
            $table->text('installer_invoice_number')->nullable();
            $table->text('installer_invoice_paid_date')->nullable();
            $table->text('installer_invoice_observation')->nullable();
            $table->text('installer_invoice_amount_ht')->nullable();
            $table->text('installer_invoice_amount_ttc')->nullable();
            $table->text('installer_invoice_amount_tva')->nullable();
            $table->text('commercial_invoice')->nullable();
            $table->text('commercial_invoice_status')->nullable();
            $table->text('commercial_invoice_commercial')->nullable();
            $table->text('commercial_invoice_number')->nullable();
            $table->text('commercial_invoice_paid_date')->nullable();
            $table->text('commercial_invoice_amount_ht')->nullable();
            $table->text('commercial_invoice_comment')->nullable();
            $table->text('provider_invoice')->nullable();
            $table->text('provider_invoice_status')->nullable();
            $table->text('provider_invoice_preview')->nullable();
            $table->text('provider_invoice_number')->nullable();
            $table->text('provider_invoice_paid_date')->nullable();
            $table->text('provider_invoice_amount_ht')->nullable();
            $table->text('provider_invoice_comment')->nullable();
            $table->text('other_invoice_1')->nullable();
            $table->text('other_invoice_1_designation')->nullable();
            $table->text('other_invoice_1_other_status')->nullable();
            $table->text('other_invoice_1_number')->nullable();
            $table->text('other_invoice_1_paid_date')->nullable();
            $table->text('other_invoice_1_amount_ht')->nullable();
            $table->text('other_invoice_1_comment')->nullable();
            $table->text('other_invoice_2')->nullable();
            $table->text('other_invoice_2_designation')->nullable();
            $table->text('other_invoice_2_other_status')->nullable();
            $table->text('other_invoice_2_number')->nullable();
            $table->text('other_invoice_2_paid_date')->nullable();
            $table->text('other_invoice_2_amount_ht')->nullable();
            $table->text('other_invoice_2_comment')->nullable();
            $table->text('other_invoice_3')->nullable();
            $table->text('other_invoice_3_designation')->nullable();
            $table->text('other_invoice_3_other_status')->nullable();
            $table->text('other_invoice_3_number')->nullable();
            $table->text('other_invoice_3_paid_date')->nullable();
            $table->text('other_invoice_3_amount_ht')->nullable();
            $table->text('other_invoice_3_comment')->nullable();
            $table->longText('data')->nullable();
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
        Schema::dropIfExists('management_controls');
    }
}
