<?php

namespace Database\Seeders;

use App\Models\BackOffice\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::truncate();
        GeneralSetting::create([
            'phone' => '123456789',
            'logo' => 'logo.png',
            'favicon' => 'favicon.ico',
            'dashboard_logo' => 'favicon.ico',
            'footer_description' => 'Depuis 2015, NOVECOLOGY
            participe à la lutte contre la précarité énergétique en tant que professionnel de l’isolation thermique des murs par l’extérieur et des panneaux photovoltaïques.',
        ]);
    }
}
