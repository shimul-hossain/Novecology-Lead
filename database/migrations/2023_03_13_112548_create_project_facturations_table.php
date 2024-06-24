<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_facturations', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id'); 
            $table->string('type'); 
            $table->text('Statut_règlement')->nullable();
            $table->text('Facture_number')->nullable();
            $table->text('Montant')->nullable();
            $table->text('Prestations')->nullable();
            $table->text('Moyens_de_paiement')->nullable();
            $table->text('Mode')->nullable();
            $table->text('nombre_de_mensualité')->nullable();
            $table->text('Règlement_1_Date')->nullable();
            $table->text('Règlement_1_Montant')->nullable();
            $table->text('Règlement_1_Statut')->nullable();
            $table->text('Règlement_1_Mode')->nullable();
            $table->text('Règlement_2_Date')->nullable();
            $table->text('Règlement_2_Montant')->nullable();
            $table->text('Règlement_2_Statut')->nullable();
            $table->text('Règlement_2_Mode')->nullable();
            $table->text('Règlement_3_Date')->nullable();
            $table->text('Règlement_3_Montant')->nullable();
            $table->text('Règlement_3_Statut')->nullable();
            $table->text('Règlement_3_Mode')->nullable();
            $table->text('Règlement_4_Date')->nullable();
            $table->text('Règlement_4_Montant')->nullable();
            $table->text('Règlement_4_Statut')->nullable();
            $table->text('Règlement_4_Mode')->nullable();
            $table->text('Règlement_5_Date')->nullable();
            $table->text('Règlement_5_Montant')->nullable();
            $table->text('Règlement_5_Statut')->nullable();
            $table->text('Règlement_5_Mode')->nullable();
            $table->text('Règlement_6_Date')->nullable();
            $table->text('Règlement_6_Montant')->nullable();
            $table->text('Règlement_6_Statut')->nullable();
            $table->text('Règlement_6_Mode')->nullable();
            $table->text('Règlement_7_Date')->nullable();
            $table->text('Règlement_7_Montant')->nullable();
            $table->text('Règlement_7_Statut')->nullable();
            $table->text('Règlement_7_Mode')->nullable();
            $table->text('Règlement_8_Date')->nullable();
            $table->text('Règlement_8_Montant')->nullable();
            $table->text('Règlement_8_Statut')->nullable();
            $table->text('Règlement_8_Mode')->nullable();
            $table->text('Règlement_9_Date')->nullable();
            $table->text('Règlement_9_Montant')->nullable();
            $table->text('Règlement_9_Statut')->nullable();
            $table->text('Règlement_9_Mode')->nullable();
            $table->text('Règlement_10_Date')->nullable();
            $table->text('Règlement_10_Montant')->nullable();
            $table->text('Règlement_10_Statut')->nullable();
            $table->text('Règlement_10_Mode')->nullable();
            $table->text('Règlement_11_Date')->nullable();
            $table->text('Règlement_11_Montant')->nullable();
            $table->text('Règlement_11_Statut')->nullable();
            $table->text('Règlement_11_Mode')->nullable();
            $table->text('Règlement_12_Date')->nullable();
            $table->text('Règlement_12_Montant')->nullable();
            $table->text('Règlement_12_Statut')->nullable();
            $table->text('Règlement_12_Mode')->nullable();
            $table->text('Délégataire')->nullable();
            $table->text('CUMAC')->nullable();
            $table->text('Montant_prime_CEE_Bénéficiaire')->nullable();
            $table->text('Montant_prime_CEE_NOVECOLOGY')->nullable();
            $table->text('Montant_apporteur_dapostropheaffaires_NOVECOLOGY')->nullable();
            $table->text('Numero_lot')->nullable();
            $table->text('Date_dépôt_pollueur')->nullable();
            $table->text('Date_paiement_pollueur')->nullable();
            $table->text('Facture_number_NOVECOLOGY')->nullable();
            $table->longText('Observations')->nullable();
            $table->longText('custom_field_data')->nullable();
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
        Schema::dropIfExists('project_facturations');
    }
} 





