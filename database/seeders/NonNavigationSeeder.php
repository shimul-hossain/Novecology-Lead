<?php

namespace Database\Seeders;

use App\Models\CRM\NonNavigation;
use Illuminate\Database\Seeder;

class NonNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NonNavigation::create([

            'name'      => ['en'=> 'Create New User', 'fr' =>'Créer un nouvel utilisateur'],
            'route'     => 'user.register.index', 
        ]);
        NonNavigation::create([

            'name'      => ['en'=> 'Start a new business', 'fr' =>'Créer une nouvelle entreprise'],
            'route'     => 'company.add', 
        ]);
    }
}
