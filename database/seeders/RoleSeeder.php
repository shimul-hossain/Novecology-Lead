<?php

namespace Database\Seeders;

use App\Models\CRM\Role;
use App\Models\RoleCategory;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolecat1 = RoleCategory::create([
            'name' => 'EQUIPE TECHNIQUE',
            'slug' => 'technical_team',
        ]);

        $rolecat2 = RoleCategory::create([
            'name' => 'EQUIPE COMMERCIAL',
            'slug' => 'sales_team',
        ]);

        $rolecat3 = RoleCategory::create([
            'name' => 'EQUIPE ADMINISTRATIF',
            'slug' => 'administrative_team',
        ]);

        $rolecat4 = RoleCategory::create([
            'name' => 'EQUIPE DIRECTION',
            'slug' => 'management_team',
        ]);

        Role::create([
            'name' => ['en'=> "Chef d’Equipe", 'fr' =>"Chef d’Equipe"],
            'value' => 'team_leader',
            'category_id' => $rolecat1->id,
        ]);
        Role::create([
            'name' => ['en'=> "Installateur Technique", 'fr' =>"Installateur Technique"],
            'value' => 'installer',
            'category_id' => $rolecat1->id,
        ]);
        Role::create([
            'name' => ['en'=> "Technicien SAV", 'fr' =>"Technicien SAV"],
            'value' => 'technician_sav',
            'category_id' => $rolecat1->id,
        ]);
        Role::create([
            'name' => ['en'=> "Prévisiteur Technico-Commercial", 'fr' =>"Prévisiteur Technico-Commercial"],
            'value' => 'technical_sales',
            'category_id' => $rolecat1->id,
        ]);
        Role::create([
            'name' => ['en'=> "Contre prévisiteur", 'fr' =>"Contre prévisiteur"],
            'value' => 'predictive_counter',
            'category_id' => $rolecat1->id,
        ]);
        Role::create([
            'name' => ['en'=> "Auditeur énergétique", 'fr' =>"Auditeur énergétique"],
            'value' => 'energy_auditor',
            'category_id' => $rolecat1->id,
        ]);

        Role::create([
            'name' => ['en'=> "Responsable Commercial", 'fr' =>"Responsable Commercial"],
            'value' => 'sales_manager',
            'category_id' => $rolecat2->id,
        ]);
        Role::create([
            'name' => ['en'=> "TELECOMMERCIAL", 'fr' =>"TELECOMMERCIAL"],
            'value' => 'telecommercial',
            'category_id' => $rolecat2->id,
        ]);
        Role::create([
            'name' => ['en'=> "Chargé d’étude", 'fr' =>"Chargé d’étude"],
            'value' => 'study_manager',
            'category_id' => $rolecat2->id,
        ]);
        
        Role::create([
            'name' => ['en'=> "Manager", 'fr' =>"Manager"],
            'value' => 'manager',
            'category_id' => $rolecat3->id,
        ]);
        Role::create([
            'name' => ['en'=> "ADV", 'fr' =>"ADV"],
            'value' => 'adv',
            'category_id' => $rolecat3->id,
        ]);
        Role::create([
            'name' => ['en'=> "Assistant ADV", 'fr' =>"Assistant ADV"],
            'value' => 'assistant_adv',
            'category_id' => $rolecat3->id,
        ]);

        
        Role::create([
            'name' => ['en'=> 'Super Admin', 'fr' =>'Super Admin'],
            'value' => 's_admin',
            'category_id' => $rolecat4->id,
        ]);
        Role::create([
            'name' => ['en'=> 'MANAGER DIRECTION', 'fr' =>'MANAGER DIRECTION'],
            'value' => 'manager_direction',
            'category_id' => $rolecat4->id,
        ]); 
    }
}
