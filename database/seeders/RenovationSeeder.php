<?php

namespace Database\Seeders;

use App\Models\BackOffice\Renovation;
use Illuminate\Database\Seeder;

class RenovationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'title' => 'Étude énergétique',
                'description' => 'Réalisez une étude complète de votre habitat avec un de nos experts énergétiques puis recevez instantanément votre étude et le devis détaillé de votre projet aides déduites.',
                'image' => 'service-image-1.jpg',
            ],
            [
                'title' => 'Visite technique',
                'description' => 'Un de nos auditeurs énergétiques se déplace à votre domicile afin de confirmer la faisabilité technique de votre projet de rénovation énergétique.',
                'image' => 'service-image-2.jpg',
            ],
            [
                'title' => 'Démarches administratives',
                'description' => 'Un chargé de projet dédié réalise pour vous toutes les démarches nécessaires à l’obtention de vos aides ainsi que les formalités administratives pour vos travaux.',
                'image' => 'service-image-3.jpg',
            ],
            [
                'title' => 'Installation',
                'description' => 'Un de nos professionnels certifiés RGE se déplace chez vous pour réaliser vos travaux de rénovation énergétique. Vos travaux sont couverts par notre garantie décennale.',
                'image' => 'service-image-4.jpg',
            ],
            [
                'title' => 'Suivi client',
                'description' => 'Bénéficiez d’un service client à votre écoute pour toutes vos questions durant toute la durée de vie de votre installation.',
                'image' => 'service-image-5.jpg',
            ],
        ];
        Renovation::truncate();
        foreach ($items as $item){
            Renovation::create([
                'title' => $item['title'],
                'description' => $item['description'],
                'image' => $item['image'],
            ]);
        }
    }
}
