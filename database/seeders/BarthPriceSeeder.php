<?php

namespace Database\Seeders;

use App\Models\CRM\BarthPrice;
use Illuminate\Database\Seeder;

class BarthPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     ['name' => 'PAC AIR EAU LG', 'slug' => 'PAC_AIR_EAU_LG', 'type' => 'single', 'price' => 7000],
        //     ['name' => 'CHAUDIÈRE À GRANULÉS - 22kW', 'slug' => 'CHAUDIÈRE_À_GRANULÉS_-_22kW', 'type' => 'single', 'price' => 9000],
        //     ['name' => 'Ballon Thermodynamique', 'slug' => 'Ballon_Thermodynamique', 'type' => 'single', 'price' => 1650], 
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 2 SPLITS', 'slug' => '2', 'type' => 'multiple', 'price' => 3370],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 3 SPLITS', 'slug' => '3', 'type' => 'multiple', 'price' => 4580],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 4 SPLITS', 'slug' => '4', 'type' => 'multiple', 'price' => 6040],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 5 SPLITS', 'slug' => '5', 'type' => 'multiple', 'price' => 7425],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 6 SPLITS', 'slug' => '6', 'type' => 'multiple', 'price' => 9160],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 7 SPLITS', 'slug' => '7', 'type' => 'multiple', 'price' => 10615],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 8 SPLITS', 'slug' => '8', 'type' => 'multiple', 'price' => 12080],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 9 SPLITS', 'slug' => '9', 'type' => 'multiple', 'price' => 13285],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 10 SPLITS', 'slug' => '10', 'type' => 'multiple', 'price' => 14490],
        //     ['name' => 'PAC AIR AIR DAIKIN FOURNITURE 11 SPLITS', 'slug' => '11', 'type' => 'multiple', 'price' => 16405],
        //     ['name' => 'POELE A GRANULES 8kW', 'slug' => 'POELE_A_GRANULES_8kW', 'type' => 'single', 'price' => 1890],
        //     ['name' => 'ITE', 'slug' => 'ITE', 'type' => 'single', 'price' => 100],
        //     ['name' => '101 : Comble Deroule ou Soufflage', 'slug' => '101_Comble_Deroule_ou_Soufflage', 'type' => 'single', 'price' => 14],
        //     ['name' => '101 : Rampant Tetris', 'slug' => '101_Rampant_Tetris', 'type' => 'single', 'price' => 18],
        //     ['name' => '101 : Deroule + Placo', 'slug' => '101_Deroule_Placo', 'type' => 'single', 'price' => 40],
        //     ['name' => "102 : Murs par l'intérieur", 'slug' => '102_Murs_par_intérieur', 'type' => 'single', 'price' => 70],
        //     ['name' => '103 : Polystyrene', 'slug' => '103_Polystyrene', 'type' => 'single', 'price' => 19],
        //     ['name' => '103 : Tetris', 'slug' => '103_Tetris', 'type' => 'single', 'price' => 21],
        //     ['name' => 'Valeur GIGA', 'slug' => 'Valeur_GIGA', 'type' => 'single', 'price' => 0.0065],
        //     ['name' => 'ACQUISITION', 'slug' => 'ACQUISITION', 'type' => 'single', 'price' => 8500],
        // ];
        $data = [ 
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 2 SPLITS', 'slug' => 'AIRWELL-2', 'type' => 'multiple', 'price' => 3370],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 3 SPLITS', 'slug' => 'AIRWELL-3', 'type' => 'multiple', 'price' => 4580],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 4 SPLITS', 'slug' => 'AIRWELL-4', 'type' => 'multiple', 'price' => 6040],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 5 SPLITS', 'slug' => 'AIRWELL-5', 'type' => 'multiple', 'price' => 7425],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 6 SPLITS', 'slug' => 'AIRWELL-6', 'type' => 'multiple', 'price' => 9160],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 7 SPLITS', 'slug' => 'AIRWELL-7', 'type' => 'multiple', 'price' => 10615],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 8 SPLITS', 'slug' => 'AIRWELL-8', 'type' => 'multiple', 'price' => 12080],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 9 SPLITS', 'slug' => 'AIRWELL-9', 'type' => 'multiple', 'price' => 13285],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 10 SPLITS', 'slug' => 'AIRWELL-10', 'type' => 'multiple', 'price' => 14490],
            ['name' => 'PAC AIR AIR AIRWELL FOURNITURE 11 SPLITS', 'slug' => 'AIRWELL-11', 'type' => 'multiple', 'price' => 16405], 
        ];

        foreach($data as $item){
            BarthPrice::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'type' => $item['type'],
            ]);
        }
    }
}
