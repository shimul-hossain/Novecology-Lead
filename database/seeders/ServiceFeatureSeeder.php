<?php

namespace Database\Seeders;

use App\Models\BackOffice\ServiceFeature;
use Illuminate\Database\Seeder;

class ServiceFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['icon' => '<i class="fa-solid fa-angle-up"></i>', 'description' => "8 ans d'expertise et d'expérience au service des particuliers"],
            ['icon' => '<i class="fa-solid fa-map-location-dot"></i>', 'description' => "Notre entreprise RGE intervient dans toute la France"],
            ['icon' => '<i class="fa-solid fa-clock-rotate-left"></i>', 'description' => "Une présence sur toute la France au travers de nos sites logistiques pour assurer une relation de proximité"],
            ['icon' => '<i class="fa-solid fa-thumbs-up"></i>', 'description' => "91% de nos clients nous parviennent sur recommandation"],
        ];
        ServiceFeature::truncate();
        foreach ($items as $item){
            ServiceFeature::create([
                'icon_link' => $item['icon'],
                'description' => $item['description'],
            ]);
        }
    }
}
