<?php

namespace Database\Seeders;

use App\Models\CRM\LeadHeader;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadHeader::truncate();
        LeadHeader::create([
            'header'    => 'id',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Fournisseur_de_lead',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Type_de_campagne',
        ]); 
        LeadHeader::create([
            'header'    => '__tracking__Nom_campagne',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Date_demande_lead',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Date_attribution_télécommercial',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Type_de_travaux_souhaité',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Nom_Prénom',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Code_postal',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Email',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__téléphone',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Département',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Mode_de_chauffage',
        ]); 
        LeadHeader::create([
            'header'    => '__tracking__Propriétaire',
        ]);
        LeadHeader::create([
            'header'    => '__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans',
        ]);
        LeadHeader::create([
            'header'    => 'Titre',
        ]);
        LeadHeader::create([
            'header'    => 'Nom',
        ]);
        LeadHeader::create([
            'header'    => 'Prenom',
        ]);
        LeadHeader::create([
            'header'    => 'Adresse',
        ]);
        LeadHeader::create([
            'header'    => 'Complément_adresse',
        ]);
        LeadHeader::create([
            'header'    => 'Code_Postal',
        ]);
        LeadHeader::create([
            'header'    => 'Ville',
        ]);
        LeadHeader::create([
            'header'    => 'Département',
        ]);
        LeadHeader::create([
            'header'    => 'Email',
        ]); 
        LeadHeader::create([
            'header'    => 'phone',
        ]);
        LeadHeader::create([
            'header'    => 'fixed_number',
        ]);
        LeadHeader::create([
            'header'    => 'Observations',
        ]); 
        LeadHeader::create([
            'header'    => 'Type_occupation',
        ]);
        LeadHeader::create([
            'header'    => 'Parcelle_cadastrale',
        ]);
        LeadHeader::create([
            'header'    => 'Revenue_Fiscale_de_Référence',
        ]);
        LeadHeader::create([
            'header'    => 'Nombre_de_foyer',
        ]);
        LeadHeader::create([
            'header'    => 'Nombre_de_personnes',
        ]);
        LeadHeader::create([
            'header'    => 'Age_du_bâtiment',
        ]);
        LeadHeader::create([
            'header'    => 'Zone',
        ]);
        LeadHeader::create([
            'header'    => 'precariousness',
        ]);
        LeadHeader::create([
            'header'    => 'Mode_de_chauffage',
        ]); 
        LeadHeader::create([
            'header'    => 'Date_construction_maison',
        ]);
        LeadHeader::create([
            'header'    => 'Surface_habitable',
        ]);
        LeadHeader::create([
            'header'    => 'Surface_à_chauffer',
        ]);
        LeadHeader::create([
            'header'    => 'Consommation_chauffage_annuel',
        ]);
        LeadHeader::create([
            'header'    => 'Consommation_Chauffage_Annuel_2',
        ]);
        LeadHeader::create([
            'header'    => 'Depuis_quand_occupez_vous_le_logement',
        ]);
        LeadHeader::create([
            'header'    => 'Type_du_courant_du_logement',
        ]);
        LeadHeader::create([
            'header'    => 'auxiliary_heating_status',
        ]);
        LeadHeader::create([
            'header'    => 'auxiliary_heating',
        ]); 
        LeadHeader::create([
            'header'    => 'second_heating_generator_status',
        ]);
        LeadHeader::create([
            'header'    => 'second_heating_generator',
        ]); 
        LeadHeader::create([
            'header'    => 'Quels_sont_les_différents_émetteurs_de_chaleur_du_logement',
        ]); 
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Aluminium',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Fonte',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Acier',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Autre',
        ]);
        LeadHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs',
        ]); 
        LeadHeader::create([
            'header'    => 'Production_dapostropheeau_chaude_sanitaire',
        ]);
        LeadHeader::create([
            'header'    => 'Instantanné',
        ]);
        LeadHeader::create([
            'header'    => 'Accumulation',
        ]);
        LeadHeader::create([
            'header'    => 'Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude',
        ]);
        LeadHeader::create([
            'header'    => 'Précisez_le_volume_du_ballon_dapostropheeau_chaude',
        ]);
        LeadHeader::create([
            'header'    => 'Information_logement_observations',
        ]);
        LeadHeader::create([
            'header'    => 'Situation_familiale',
        ]); 
        LeadHeader::create([
            'header'    => 'Y_a_t_il_des_enfants_dans_le_foyer_fiscale',
        ]);
        LeadHeader::create([
            'header'    => 'Personne_1',
        ]);
        LeadHeader::create([
            'header'    => 'Quel_est_le_contrat_de_travail_de_Personne_1',
        ]); 
        LeadHeader::create([
            'header'    => 'Revenue_Personne_1',
        ]);
        LeadHeader::create([
            'header'    => 'Existehyphenthyphenil_un_conjoint',
        ]);
        LeadHeader::create([
            'header'    => 'Personne_2',
        ]);
        LeadHeader::create([
            'header'    => 'Quel_est_le_contrat_de_travail_de_Personne_2',
        ]); 
        LeadHeader::create([
            'header'    => 'Revenue_Personne_2',
        ]);
        LeadHeader::create([
            'header'    => 'Crédit_du_foyer_mensuel',
        ]);
        LeadHeader::create([
            'header'    => 'Commentaires_revenue_et_crédit_du_foyer',
        ]);
        LeadHeader::create([
            'header'    => '__projet__Adresse_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => '__projet__Code_postale_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => '__projet__Ville_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => '__projet__Département_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => 'Type_de_contrat',
        ]);
        LeadHeader::create([
            'header'    => 'MaPrimeRenov',
        ]);
        LeadHeader::create([
            'header'    => 'Subvention_MaPrimeRénov_déduit_du_devis',
        ]);
        LeadHeader::create([
            'header'    => 'Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov',
        ]);
        LeadHeader::create([
            'header'    => 'Action_Logement',
        ]);
        LeadHeader::create([
            'header'    => 'CEE',
        ]);
        LeadHeader::create([
            'header'    => 'Credit',
        ]);
        LeadHeader::create([
            'header'    => 'Montant_Crédit',
        ]);
        LeadHeader::create([
            'header'    => 'Report_du_crédit',
        ]);
        LeadHeader::create([
            'header'    => 'Nombre_de_jours_report',
        ]);
        LeadHeader::create([
            'header'    => 'Reste_à_charge',
        ]);
        LeadHeader::create([
            'header'    => 'Reste_à_charge_Montant',
        ]);
        LeadHeader::create([
            'header'    => 'Mode_de_paiement',
        ]);
        LeadHeader::create([
            'header'    => 'Nombre_de_mensualités',
        ]);
        LeadHeader::create([
            'header'    => 'advance_visit',
        ]);
        LeadHeader::create([
            'header'    => 'Projet_observations',
        ]);
        LeadHeader::create([
            'header'    => 'Régie',
        ]);
        LeadHeader::create([
            'header'    => 'Ville_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => 'Département_des_travaux',
        ]);
        LeadHeader::create([
            'header'    => 'TAG',
        ]);
        LeadHeader::create([
            'header'    => 'Travaux_formulaire',
        ]);
        // LeadHeader::create([
        //     'header'    => 'Statut_Projet',
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=> 'ID', 'fr' =>'ID'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=> 'tracker name', 'fr' =>'nom du traqueur'],
        // ]); 
        // LeadHeader::create([
        //     'header'    => ['en' => 'tracker platform', 'fr' => 'plateforme de suivi'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en' => 'tracker email', 'fr' =>'e-mail de suivi'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en' =>'tracker phone', 'fr' => 'téléphone traqueur'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'project name', 'fr'=>'project name'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'first name', 'fr' => 'prénom'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'last name' , 'fr' => 'nom de famille'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'phone', 'fr'=> 'téléphone'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'email', 'fr'=> 'e-mail'],
        // ]); 
        // LeadHeader::create([
        //     'header'    => ['en'=>'department', 'fr'=> 'département'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'precariousness', 'fr'=> 'précarité'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'zone', 'fr'=> 'zone'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'postal code', 'fr'=> 'code postal'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'city', 'fr'=> 'ville'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'address', 'fr'=> 'adresse'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'nature occupation', 'fr'=> 'métier de la nature'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'heating type', 'fr'=> 'type de chauffage'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'electricity connection', 'fr'=> 'branchement électrique'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'living space', 'fr'=> 'espace vital'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'cadstrable plot', 'fr'=> 'parcelle cadastrable'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'floor area', 'fr'=> 'surface de plancher'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'house type', 'fr'=> 'type de maison'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'with basement', 'fr'=> 'avec sous-sol'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'owner', 'fr'=> 'propriétaire'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'house over 15 years', 'fr'=> 'maison de plus de 15 ans'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'date', 'fr'=> 'date'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'duplicate analysis', 'fr'=> 'analyse des doublons'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'management', 'fr'=> 'la gestion'],
        // ]);
        // LeadHeader::create([
        //     'header'    => ['en'=>'transfer office 17', 'fr'=> 'bureau de transfert 17'],
        // ]);  
    }
}
