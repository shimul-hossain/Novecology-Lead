<?php

namespace Database\Seeders;

use App\Models\BackOffice\RenovationBlockInfo;
use Illuminate\Database\Seeder;

class RenovationInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RenovationBlockInfo::truncate();
        RenovationBlockInfo::create([
            'title' =>  'Votre projet de rénovation énergétique clé en main',
            'subtitle' =>  'Nous vous offrons un accompagnement à chaque étape de votre projet, pour des travaux de rénovation énergétique en toute sérenité.',
        ]);
    }
}
