<?php

namespace Database\Seeders;

use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectStatus;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectNewStatus::create([
            'status' => 'En Cours'
        ]);
        ProjectNewStatus::create([
            'status' => 'Prévisite Réalisé'
        ]);
        ProjectNewStatus::create([
            'status' => 'Déposé'
        ]);
        ProjectNewStatus::create([
            'status' => 'Financement Accepté'
        ]);
        ProjectNewStatus::create([
            'status' => 'Installé'
        ]);
        ProjectNewStatus::create([
            'status' => 'Terminé'
        ]);
        ProjectNewStatus::create([
            'status' => 'KO'
        ]);
    }
}
