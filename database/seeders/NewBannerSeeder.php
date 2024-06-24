<?php

namespace Database\Seeders;

use App\Models\BackOffice\NewBanner;
use Illuminate\Database\Seeder;

class NewBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ["1" => "Chaudière à granulés", "2" => "Pompes à chaleur Air/Eau", "3" => "Système Solaire Combiné", "4" => "Pompes à chaleur Air/Air", "5" => "Panneau Photovoltaïque", "6" => "Isolation thermique par l'extérieur", "7" => "Rénovation globale"];

        NewBanner::truncate();
        foreach($items as $key => $item){
            NewBanner::create([
                'title' => $item,
                'button_text' => 'En savoir plus',
                'button_link' => '#!',
                'image' => "banner-$key.jpg",
            ]);
        }
    }
}
