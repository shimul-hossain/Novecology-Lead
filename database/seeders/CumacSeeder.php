<?php

namespace Database\Seeders;

use App\Models\CRM\Cumac;
use App\Models\CRM\CumacCategory;
use Illuminate\Database\Seeder;

class CumacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CumacCategory::truncate();
        Cumac::truncate();
        $items = ['101+103+ PAC +BT / 101+PAC +BT', '102+ PAC +BT', '101 + 103 + 102 ITI (MUR GARAGE) + PAC +BT', 'TOTAL'];
        foreach ($items as $item){
            CumacCategory::create([
                'name' => $item,
            ]);
        }

        $cumac_items = [
            [
                'category_id' => '1',
                'mode_de_chauffage' => 'Bois',
                'cef_intial' => '540',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '1',
                'mode_de_chauffage' => 'Fioul',
                'cef_intial' => '520',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '1',
                'mode_de_chauffage' => 'GAZ',
                'cef_intial' => '500',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '1',
                'mode_de_chauffage' => 'GAZ A CONDENSATION',
                'cef_intial' => '460',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '1',
                'mode_de_chauffage' => 'ELECTRIQUE',
                'cef_intial' => '550',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '2',
                'mode_de_chauffage' => 'Bois',
                'cef_intial' => '790',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '2',
                'mode_de_chauffage' => 'Fioul',
                'cef_intial' => '770',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '2',
                'mode_de_chauffage' => 'GAZ',
                'cef_intial' => '700',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '2',
                'mode_de_chauffage' => 'GAZ A CONDENSATION',
                'cef_intial' => '460',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '2',
                'mode_de_chauffage' => 'ELECTRIQUE',
                'cef_intial' => '460',
                'cef_finale' => '40',
            ], 
            [
                'category_id' => '3',
                'mode_de_chauffage' => 'Bois',
                'cef_intial' => '670',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '3',
                'mode_de_chauffage' => 'Fioul',
                'cef_intial' => '650',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '3',
                'mode_de_chauffage' => 'GAZ',
                'cef_intial' => '630',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '3',
                'mode_de_chauffage' => 'GAZ A CONDENSATION/Electrique',
                'cef_intial' => '460',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '4',
                'mode_de_chauffage' => 'Bois',
                'cef_intial' => '670',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '4',
                'mode_de_chauffage' => 'Fioul',
                'cef_intial' => '650',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '4',
                'mode_de_chauffage' => 'GAZ',
                'cef_intial' => '630',
                'cef_finale' => '40',
            ],
            [
                'category_id' => '4',
                'mode_de_chauffage' => 'GAZ A CONDENSATION/Electrique',
                'cef_intial' => '460',
                'cef_finale' => '40',
            ],
        ];

        foreach ($cumac_items as $cumac){
            Cumac::create([
                'category_id' => $cumac['category_id'],
                'mode_de_chauffage' => $cumac['mode_de_chauffage'],
                'cef_intial' => $cumac['cef_intial'],
                'cef_finale' => $cumac['cef_finale'],
                'gain_cef' => $cumac['cef_intial'] - $cumac['cef_finale'],
            ]);
        }
    }
}
