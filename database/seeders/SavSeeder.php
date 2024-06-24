<?php

namespace Database\Seeders;

use App\Models\CRM\SavHeader;
use Illuminate\Database\Seeder;

class SavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SavHeader::create([
            'header'    => ['en'=> 'ID', 'fr' =>'ID'],
        ]);
        SavHeader::create([
            'header'    => ['en'=>'Name', 'fr'=>'Nom'],
        ]); 
        SavHeader::create([
            'header'    => ['en'=>'Project name', 'fr'=>'Nom du projet'],
        ]);  
        SavHeader::create([
            'header'    => ['en'=>'Actions', 'fr'=>'Actions'],
        ]);
    }
}
