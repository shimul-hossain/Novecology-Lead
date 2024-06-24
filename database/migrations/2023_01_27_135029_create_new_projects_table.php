<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable(); 
            $table->integer('lead_id')->nullable(); 
            $table->integer('client_id')->nullable(); 
            $table->integer('lead_telecommercial')->nullable(); 
               
            $table->integer('project_label')->nullable();
            $table->integer('project_sub_status')->nullable();
            $table->integer('project_telecommercial')->nullable();
            $table->integer('project_gestionnaire')->nullable();
            $table->integer('user_id')->nullable(); 
            $table->integer('deleted_status')->default(0);
             
            $table->text('project_ko_reason')->nullable();
            $table->text('__tracking__Fournisseur_de_lead')->nullable();
            $table->text('__tracking__Type_de_campagne')->nullable();
            $table->text('__tracking__Type_de_campagne__a__')->nullable();
            $table->text('__tracking__Nom_campagne')->nullable(); 
            $table->date('__tracking__Date_demande_lead')->nullable();
            $table->text('__tracking__Date_attribution_télécommercial')->nullable();
            $table->text('__tracking__Type_de_travaux_souhaité')->nullable();
            $table->text('__tracking__Nom_Prénom')->nullable();
            $table->text('__tracking__Code_postal')->nullable();
            $table->text('__tracking__Email')->nullable();
            $table->text('__tracking__téléphone')->nullable();
            $table->text('__tracking__Département')->nullable();
            $table->text('__tracking__Mode_de_chauffage')->nullable();
            $table->text('__tracking__Mode_de_chauffage__a__')->nullable();
            $table->text('__tracking__Propriétaire')->nullable();
            $table->text('__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans')->nullable();

            $table->text('Titre')->nullable();
            $table->text('Prenom')->nullable();
            $table->text('Nom')->nullable();
            $table->text('Adresse')->nullable();
            $table->text('Complément_adresse')->nullable();
            $table->text('Code_Postal')->nullable();
            $table->text('Ville')->nullable();
            $table->text('Département')->nullable();
            $table->text('Email')->nullable(); 
            $table->text('same_as_work_address')->nullable(); 
            $table->text('Adresse_Travaux')->nullable(); 
            $table->text('Complément_adresse_Travaux')->nullable(); 
            $table->text('Code_postal_Travaux')->nullable(); 
            $table->text('Ville_Travaux')->nullable(); 
            $table->text('Departement_Travaux')->nullable(); 
            $table->text('phone')->nullable(); 
            $table->text('fixed_number')->nullable(); 
            $table->text('Observations')->nullable(); 
            $table->text('precariousness')->nullable(); 

            $table->text('Type_occupation')->nullable();
            $table->text('Parcelle_cadastrale')->nullable();
            $table->text('Revenue_Fiscale_de_Référence')->nullable();
            $table->text('Nombre_de_foyer')->nullable();
            $table->text('Nombre_de_personnes')->nullable();
            $table->text('Age_du_bâtiment')->nullable();
            $table->text('Zone')->nullable();
            $table->text('Éligibilité_MaPrimeRenov')->nullable();

            $table->text('Mode_de_chauffage')->nullable();
            $table->text('Mode_de_chauffage__a__')->nullable();
            $table->text('Date_construction_maison')->nullable();
            $table->text('Surface_habitable')->nullable();
            $table->text('Surface_à_chauffer')->nullable();
            $table->text('Consommation_chauffage_annuel')->nullable();
            $table->text('Consommation_Chauffage_Annuel_2')->nullable();
            $table->text('Depuis_quand_occupez_vous_le_logement')->nullable();
            $table->text('Type_du_courant_du_logement')->nullable();
            $table->text('auxiliary_heating_status')->nullable();
            $table->text('auxiliary_heating')->nullable();
            $table->text('auxiliary_heating__a__')->nullable();
            $table->text('second_heating_generator_status')->nullable();
            $table->text('second_heating_generator')->nullable();
            $table->text('second_heating_generator__a__')->nullable();
            $table->text('Quels_sont_les_différents_émetteurs_de_chaleur_du_logement')->nullable();
            $table->text('Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Aluminium')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Fonte')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Acier')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Autre')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs')->nullable();
            $table->text('Préciser_le_type_de_radiateurs_Autre___a__')->nullable();
            $table->text('Production_dapostropheeau_chaude_sanitaire')->nullable();
            $table->text('Instantanné')->nullable();
            $table->text('Accumulation')->nullable();
            $table->text('Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude')->nullable();
            $table->text('Précisez_le_volume_du_ballon_dapostropheeau_chaude')->nullable();
            $table->text('Information_logement_observations')->nullable();

            $table->text('Situation_familiale')->nullable();
            $table->text('Situation_familiale___a__')->nullable();
            $table->text('Y_a_t_il_des_enfants_dans_le_foyer_fiscale')->nullable();
            $table->text('Personne_1')->nullable();
            $table->text('Quel_est_le_contrat_de_travail_de_Personne_1')->nullable();
            $table->text('Quel_est_le_contrat_de_travail_de_Personne_1__a__')->nullable();
            $table->text('Revenue_Personne_1')->nullable();
            $table->text('Existehyphenthyphenil_un_conjoint')->nullable();
            $table->text('Personne_2')->nullable();
            $table->text('Quel_est_le_contrat_de_travail_de_Personne_2')->nullable();
            $table->text('Quel_est_le_contrat_de_travail_de_Personne_2__a__')->nullable();
            $table->text('Revenue_Personne_2')->nullable();
            $table->text('Crédit_du_foyer_mensuel')->nullable();
            $table->text('Commentaires_revenue_et_crédit_du_foyer')->nullable();

            $table->text('__projet__Adresse_des_travaux')->nullable();
            $table->text('__projet__Code_postale_des_travaux')->nullable();
            $table->text('__projet__Ville_des_travaux')->nullable();
            $table->text('__projet__Département_des_travaux')->nullable();
            $table->text('Type_de_contrat')->nullable();
            $table->text('MaPrimeRenov')->nullable();
            $table->text('Subvention_MaPrimeRénov_déduit_du_devis')->nullable();
            $table->text('Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov')->nullable();
            $table->text('Action_Logement')->nullable();
            $table->text('CEE')->nullable();
            $table->text('Credit')->nullable();
            $table->text('Montant_Crédit')->nullable();
            $table->text('Report_du_crédit')->nullable();
            $table->text('Nombre_de_jours_report')->nullable();
            $table->text('Reste_à_charge')->nullable();
            $table->text('Reste_à_charge_Montant')->nullable();
            $table->text('Mode_de_paiement')->nullable();
            $table->text('Nombre_de_mensualités')->nullable();
            $table->text('Projet_observations')->nullable();

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
        Schema::dropIfExists('new_projects');
    }
}
