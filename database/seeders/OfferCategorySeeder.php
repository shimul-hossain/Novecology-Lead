<?php

namespace Database\Seeders;

use App\Models\BackOffice\OfferCategory;
use Illuminate\Database\Seeder;

class OfferCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ["1" => 'Changer mon chauffage', "2" => 'Isoler ma maison', "3" => 'Passer au solaire', "4" => 'Rénovation Globale'];
        OfferCategory::truncate();
        foreach($items as $key => $item){
            OfferCategory::create([
                'title' => $item,
                'logo' => "service-icon-$key.svg",
            ]);
        }
    }
}
