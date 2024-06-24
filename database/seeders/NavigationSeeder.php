<?php

namespace Database\Seeders;

use App\Models\CRM\Navigation;
use Illuminate\Database\Seeder;


class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Navigation::create([
            'name'      => ['en'=> 'Website Backend', 'fr' =>'Backend du site Web'],
            'route'     => 'superadmin.dashboard', 
            'index'     => 0,
        ]); 
        Navigation::create([
            'name'      => ['en'=> 'Home', 'fr' =>'Accueil'],
            'route'     => 'super_admin.landing',
            'yield'     => 'homeIndex',
            'index'     => 1,
        ]); 
        Navigation::create([
            'name'      => ['en'=> 'Leads', 'fr' =>'Prospects'],
            'route'     => 'leads.all',
            'yield'     => 'leadIndex',
            'index'     => 2,
        ]);  
        Navigation::create([
            'name'      => ['en'=> 'My clients', 'fr' =>'Mes Clients'],
            'route'     => 'clients.index',
            'yield'     => 'clientIndex',
            'index'     => 3,
        ]);
        Navigation::create([
            'name'      => ['en'=> 'Project', 'fr' =>'Chantier'],
            'route'     => 'project.index',
            'yield'     => 'projectIndex',
            'index'     => 4,
        ]);
        Navigation::create([
            'name'      => ['en'=> 'Role', 'fr' =>'Rôle'],
            'route'     => 'role.index',
            'yield'     => 'roleIndex',
            'index'     => 7,
        ]);  
        Navigation::create([
            'name'      => ['en'=> 'Ticketing', 'fr' =>'Billetterie'],
            'route'     => 'ticketing.index',
            'yield'     => 'ticketing',
            'index'     => 14,
        ]);  
        Navigation::create([
            'name'      => ['en'=> 'Planning', 'fr' =>'Planning'],
            'route'     => 'planning.index',
            'yield'     => 'planningIndex',
            'index'     => 9,
        ]);  
        Navigation::create([
            'name'      => ['en'=> 'Map', 'fr' =>'Carte'],
            'route'     => 'map.index',
            'yield'     => 'mapIndex',
            'index'     => 10,
        ]);  
        Navigation::create([
            'name'      => ['en'=> 'Chat', 'fr' =>'Chat'],
            'route'     => 'chat.index',
            'yield'     => 'chatIndex',
            'index'     => 11,
        ]);  

        // Navigation::create([
        //     'name'      => ['en'=> 'To Do', 'fr' =>'À faire'],
        //     'route'     => 'todo.index',
        //     'yield'     => 'todoIndex',
        //     'index'     => 8,
        // ]);  



        Navigation::create([
            'name'      => ['en'=> 'Ringover', 'fr' =>'Ringover'],
            'route'     => 'ringover.index',
            'yield'     => 'ringover',
            'index'     => 12,
        ]);  

        // Navigation::create([
        //     'name'      => ['en'=> 'SAV', 'fr' =>'SAV'],
        //     'route'     => 'sav.index',
        //     'yield'     => 'sav',
        //     'index'     => 13,
        // ]);  



        
    }
}
