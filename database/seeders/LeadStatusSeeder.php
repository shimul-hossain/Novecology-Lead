<?php

namespace Database\Seeders;

use App\Models\CRM\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
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
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
        LeadStatus::create([
            'status' => 'Nouveau',
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
        LeadStatus::create([
            'status' => 'En cours',
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
        LeadStatus::create([
            'status' => 'NRP',
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
        LeadStatus::create([
            'status' => 'Mort',
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
        LeadStatus::create([
            'status' => 'Converti',
            'status_color' => '#ffffff',
            'background_color' => '#000000'
        ]);
    }
}
