<?php

namespace Database\Seeders;

use App\Models\CRM\ProjectHeader;
use Illuminate\Database\Seeder;

class ProjectHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectHeader::truncate();
        
        ProjectHeader::create([
            'header'    => 'id',
        ]); 
        ProjectHeader::create([
            'header'    => '__tracking__Fournisseur_de_lead',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Type_de_campagne',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Nom_Prénom',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Code_postal',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Email',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__téléphone',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Département',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Mode_de_chauffage',
        ]); 
        ProjectHeader::create([
            'header'    => '__tracking__Propriétaire',
        ]);
       

        ProjectHeader::create([
            'header'    => 'Titre',
        ]);
        ProjectHeader::create([
            'header'    => 'Nom',
        ]);
        ProjectHeader::create([
            'header'    => 'Prenom',
        ]);
        ProjectHeader::create([
            'header'    => 'Code_Postal',
        ]);
        ProjectHeader::create([
            'header'    => 'Email',
        ]); 
        ProjectHeader::create([
            'header'    => 'phone',
        ]);
        ProjectHeader::create([
            'header'    => 'fixed_number',
        ]);

        ProjectHeader::create([
            'header'    => 'Type_occupation',
        ]);
        ProjectHeader::create([
            'header'    => 'Zone',
        ]);
        ProjectHeader::create([
            'header'    => 'precariousness',
        ]);


        ProjectHeader::create([
            'header'    => 'Mode_de_chauffage',
        ]); 
      
        ProjectHeader::create([
            'header'    => 'Surface_habitable',
        ]);
       

        ProjectHeader::create([
            'header'    => '__projet__Ville_des_travaux',
        ]);
        ProjectHeader::create([
            'header'    => '__projet__Département_des_travaux',
        ]);
        ProjectHeader::create([
            'header'    => 'TAG',
        ]);
        ProjectHeader::create([
            'header'    => 'Statut_Projet',
        ]);
         
        ProjectHeader::create([
            'header'    => 'Statut_1_hyphen_MyMPR',
        ]);
        ProjectHeader::create([
            'header'    => 'Statut_2_hyphen_MyMPR',
        ]);

        ProjectHeader::create([
            'header'    => 'Montant_Disponible',
        ]);

        ProjectHeader::create([
            'header'    => 'Statut_accord_banque',
        ]);

        ProjectHeader::create([
            'header'    => 'Statut_audit',
        ]);

        ProjectHeader::create([
            'header'    => 'Résultat_du_rapport_audit',
        ]);
        ProjectHeader::create([
            'header'    => 'Type_de_contrat',
        ]);
        ProjectHeader::create([
            'header'    => 'Régie',
        ]);
        ProjectHeader::create([
            'header'    => '__tracking__Nom_campagne',
        ]);
        ProjectHeader::create([
            'header'    => 'Travaux_formulaire',
        ]);
        
    }
}
