<?php

namespace Database\Seeders;

use App\Models\CRM\StatusPlanningIntervention;
use Illuminate\Database\Seeder;

class StatusPlanningInterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPlanningIntervention::create([
            'name' => 'Confirmée'
        ]);
        StatusPlanningIntervention::create([
            'name' => 'Realisée'
        ]);
        StatusPlanningIntervention::create([
            'name' => 'Reportée'
        ]);
        StatusPlanningIntervention::create([
            'name' => 'Annulé'
        ]);
    }
}
