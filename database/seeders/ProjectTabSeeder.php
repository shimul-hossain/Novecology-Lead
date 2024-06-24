<?php

namespace Database\Seeders;

use App\Models\CRM\ProjectStaticTab;
use Illuminate\Database\Seeder;

class ProjectTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     
    public function run()
    {
        ProjectStaticTab::create([
            'name' => 'Lead Tracking', 
            'slug' => 'lead-tracking'
            
        ]);
        ProjectStaticTab::create([
            'name' => 'Client', 
            'slug' => 'information-personnel'
        ]);
        ProjectStaticTab::create([
            'name' => 'Information Logement', 
            'slug' => 'information-logement'
        ]);
        ProjectStaticTab::create([
            'name' => 'Section Projet', 
            'slug' => 'section-projet'
        ]);
        ProjectStaticTab::create([
            'name' => 'Intervention', 
            'slug' => 'intervention'
        ]);
        ProjectStaticTab::create([
            'name' => 'Rapports', 
            'slug' => 'rapports'
        ]);
        ProjectStaticTab::create([
            'name' => 'Section MAPRIMERENOV', 
            'slug' => 'section-MAPRIMERENOV'
        ]);
        ProjectStaticTab::create([
            'name' => 'Section Action Logement', 
            'slug' => 'section-action-logement'
        ]);
        ProjectStaticTab::create([
            'name' => 'Banque', 
            'slug' => 'banque'
        ]);
        ProjectStaticTab::create([
            'name' => 'Audit Energetique',
            'slug' => 'audit'
        ]);
        ProjectStaticTab::create([
            'name' => 'Intervention',
            'slug' => 'intervention'
        ]); 
        ProjectStaticTab::create([
            'name' => 'Comptability', 
            'slug' => 'comptability'
        ]);
        ProjectStaticTab::create([
            'name' => 'Section Installation', 
            'slug' => 'sectioninstallation'
        ]);
        ProjectStaticTab::create([
            'name' => 'Contrôle Qualité', 
            'slug' => 'section-controle-qualite'
        ]);
        ProjectStaticTab::create([
            'name' => 'Contrôle Sur Site', 
            'slug' => 'section-sur-site'
        ]);
        ProjectStaticTab::create([
            'name' => 'Facturation', 
            'slug' => 'facturation'
        ]);
        ProjectStaticTab::create([
            'name' => 'Section Documents', 
            'slug' => 'section-documents'
        ]);
        // ProjectStaticTab::create([
        //     'name' => 'SAV', 
        //     'slug' => 'SAV'
        // ]);
    }
}
