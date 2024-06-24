<?php

namespace Database\Seeders;

use App\Models\CRM\Campagnetype;
use Illuminate\Database\Seeder;

class CampaignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campagnetype::create([
            'name' => 'SMS'
        ]);
        Campagnetype::create([
            'name' => 'Facebook-Ads'
        ]);
        Campagnetype::create([
            'name' => 'Google-Ads'
        ]);
        Campagnetype::create([
            'name' => 'Emailing'
        ]);
        Campagnetype::create([
            'name' => 'Parrainage'
        ]);
        Campagnetype::create([
            'name' => 'Autre'
        ]);
    }
}
