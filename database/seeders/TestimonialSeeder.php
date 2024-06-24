<?php

namespace Database\Seeders;

use App\Models\BackOffice\Testimonial;
use App\Models\BackOffice\TestimonialInfo;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestimonialInfo::truncate();
        Testimonial::truncate();
        TestimonialInfo::create([
            'title' => 'NOVECOLOGY',
            'subtitle' => 'Le climat de confiance',
            'description' => 'La transition énergétique est le défi majeur du 21ème siècle. Les maisons énergivores représentent un véritable enjeux pour les années à venir. Le grand défi de demain sera de rénover de façon performante le parc de logements existants. Au sein de notre entreprise, nous luttons contre cette précarité énergétique car l’amélioration de notre habitat, le bien-être et le confort sont essentiels pour chacun d’entre nous. Nous intervenons sur des chantiers, en neuf ou en rénovation, quelle que soit leur envergure',
            'button_text' => 'Prendre rendez-vous',
            'right_side_image' => 'bear-image.png',
            'home_page_title' => 'NOS CLIENTS PARTAGENT LEURS EXPÉRIENCES',
            'home_page_button_text' => 'Les Témoignages',
        ]);

        $items = [
            [
                'title' => 'Title',
                'embed_id' => 'pNfgyV3jRiY',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'cm7BjtGDzWg',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'xRNTW3eem48',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'SPf5GXIott4',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'vXOqIVAd7Pw',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'KRpQ6APj4rU',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
            [
                'title' => 'Title',
                'embed_id' => 'mDvskrB-zsU',
                'description' => 'Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.',
            ],
        ];
        
        foreach($items as $item){
            Testimonial::create([
                'title' => $item['title'],
                'embed_id' => $item['embed_id'],
                'description' => $item['description'],
            ]);
        }
    }
}
