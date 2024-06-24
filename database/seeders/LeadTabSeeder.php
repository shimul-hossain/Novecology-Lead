<?php

namespace Database\Seeders;

use App\Models\CRM\LeadStatus;
use Illuminate\Database\Seeder;

class LeadTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadStatus::create([
            'status' => 'Non attribué',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);

        LeadStatus::create([
            'status' => 'Nouveau',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);

        LeadStatus::create([
            'status' => 'En cours',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);

        LeadStatus::create([
            'status' => 'NRP',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);

        LeadStatus::create([
            'status' => 'Mort',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);

        LeadStatus::create([
            'status' => 'CONVERTI',
            'status_color' => '#fff',
            'background_color' => '#000',
        ]);
    }
}
