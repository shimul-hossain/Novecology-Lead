<?php

namespace Database\Seeders;

use App\Models\CRM\ClientHeader;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ClientHeader::truncate();
        ClientHeader::create([
            'header'    => 'id',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Fournisseur_de_lead',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Type_de_campagne',
        ]); 
        ClientHeader::create([
            'header'    => '__tracking__Nom_campagne',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Date_demande_lead',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Date_attribution_télécommercial',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Type_de_travaux_souhaité',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Nom_Prénom',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Code_postal',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Email',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__téléphone',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Département',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Mode_de_chauffage',
        ]); 
        ClientHeader::create([
            'header'    => '__tracking__Propriétaire',
        ]);
        ClientHeader::create([
            'header'    => '__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans',
        ]);
        ClientHeader::create([
            'header'    => 'Titre',
        ]);
        ClientHeader::create([
            'header'    => 'Nom',
        ]);
        ClientHeader::create([
            'header'    => 'Prenom',
        ]);
        ClientHeader::create([
            'header'    => 'Adresse',
        ]);
        ClientHeader::create([
            'header'    => 'Complément_adresse',
        ]);
        ClientHeader::create([
            'header'    => 'Code_Postal',
        ]);
        ClientHeader::create([
            'header'    => 'Ville',
        ]);
        ClientHeader::create([
            'header'    => 'Département',
        ]);
        ClientHeader::create([
            'header'    => 'Email',
        ]); 
        ClientHeader::create([
            'header'    => 'phone',
        ]);
        ClientHeader::create([
            'header'    => 'fixed_number',
        ]);
        ClientHeader::create([
            'header'    => 'Observations',
        ]); 
        ClientHeader::create([
            'header'    => 'Type_occupation',
        ]);
        ClientHeader::create([
            'header'    => 'Parcelle_cadastrale',
        ]);
        ClientHeader::create([
            'header'    => 'Revenue_Fiscale_de_Référence',
        ]);
        ClientHeader::create([
            'header'    => 'Nombre_de_foyer',
        ]);
        ClientHeader::create([
            'header'    => 'Nombre_de_personnes',
        ]);
        ClientHeader::create([
            'header'    => 'Age_du_bâtiment',
        ]);
        ClientHeader::create([
            'header'    => 'Zone',
        ]);
        ClientHeader::create([
            'header'    => 'precariousness',
        ]);
        ClientHeader::create([
            'header'    => 'Mode_de_chauffage',
        ]); 
        ClientHeader::create([
            'header'    => 'Date_construction_maison',
        ]);
        ClientHeader::create([
            'header'    => 'Surface_habitable',
        ]);
        ClientHeader::create([
            'header'    => 'Surface_à_chauffer',
        ]);
        ClientHeader::create([
            'header'    => 'Consommation_chauffage_annuel',
        ]);
        ClientHeader::create([
            'header'    => 'Consommation_Chauffage_Annuel_2',
        ]);
        ClientHeader::create([
            'header'    => 'Depuis_quand_occupez_vous_le_logement',
        ]);
        ClientHeader::create([
            'header'    => 'Type_du_courant_du_logement',
        ]);
        ClientHeader::create([
            'header'    => 'auxiliary_heating_status',
        ]);
        ClientHeader::create([
            'header'    => 'auxiliary_heating',
        ]); 
        ClientHeader::create([
            'header'    => 'second_heating_generator_status',
        ]);
        ClientHeader::create([
            'header'    => 'second_heating_generator',
        ]); 
        ClientHeader::create([
            'header'    => 'Quels_sont_les_différents_émetteurs_de_chaleur_du_logement',
        ]); 
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Aluminium',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Fonte',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Acier',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Autre',
        ]);
        ClientHeader::create([
            'header'    => 'Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs',
        ]); 
        ClientHeader::create([
            'header'    => 'Production_dapostropheeau_chaude_sanitaire',
        ]);
        ClientHeader::create([
            'header'    => 'Instantanné',
        ]);
        ClientHeader::create([
            'header'    => 'Accumulation',
        ]);
        ClientHeader::create([
            'header'    => 'Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude',
        ]);
        ClientHeader::create([
            'header'    => 'Précisez_le_volume_du_ballon_dapostropheeau_chaude',
        ]);
        ClientHeader::create([
            'header'    => 'Information_logement_observations',
        ]);
        ClientHeader::create([
            'header'    => 'Situation_familiale',
        ]); 
        ClientHeader::create([
            'header'    => 'Y_a_t_il_des_enfants_dans_le_foyer_fiscale',
        ]);
        ClientHeader::create([
            'header'    => 'Personne_1',
        ]);
        ClientHeader::create([
            'header'    => 'Quel_est_le_contrat_de_travail_de_Personne_1',
        ]); 
        ClientHeader::create([
            'header'    => 'Revenue_Personne_1',
        ]);
        ClientHeader::create([
            'header'    => 'Existehyphenthyphenil_un_conjoint',
        ]);
        ClientHeader::create([
            'header'    => 'Personne_2',
        ]);
        ClientHeader::create([
            'header'    => 'Quel_est_le_contrat_de_travail_de_Personne_2',
        ]); 
        ClientHeader::create([
            'header'    => 'Revenue_Personne_2',
        ]);
        ClientHeader::create([
            'header'    => 'Crédit_du_foyer_mensuel',
        ]);
        ClientHeader::create([
            'header'    => 'Commentaires_revenue_et_crédit_du_foyer',
        ]); 
        ClientHeader::create([
            'header'    => 'Autre_intervenant',
        ]); 
        ClientHeader::create([
            'header'    => 'Prospect_telecommercial',
        ]); 
        ClientHeader::create([
            'header'    => 'Travaux_formulaire',
        ]); 

    }
}
