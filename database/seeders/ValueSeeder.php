<?php

namespace Database\Seeders;

use App\Models\BackOffice\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Value::truncate();
        Value::create([
            'first_block_title' => 'Nos valeurs',
            'first_block_description' => 'L’excellence technique, l’intégrité et la satisfaction client sont au cœur de nos valeurs. Un expert de confiance à vos côtés pour vous accompagner tout au long de votre projet et répondre à toutes vos questions.',
            'first_block_image' => 'valeurs-image-1.jpg',
            'second_block_title' => 'Le conseil : Notre priorité',
            'second_block_short_description' => 'Réussir ses travaux, c’est avant tout une histoire de confiance et d’accompagnement !',
            'second_block_long_description' => 'Écoute des besoins, conseils techniques, réalisation de travaux, expertise administrative et mobilisation des financements : NOVECOLOGY déploie un accompagnement global pour vous proposer des solutions les mieux adaptées à votre logement.',
            'second_block_image' => 'valeurs-image-2.jpg',
            'third_block_title' => 'Le juste prix : Notre atout',
            'third_block_short_description' => 'Votre logement mérite des travaux de qualité pour un budget raisonnable !',
            'third_block_long_description' => 'Le coût de rénovation d’une maison est extrêmement variable : cela dépend entre autres de l’état du logement et de l’ampleur du chantier. NOVECOLOGY s’engage donc à la livraison d’un chantier réalisé avec méthode et minutie, sans surprise, correspondant au cahier des charges et au meilleur prix.',
            'third_block_image' => 'valeurs-image-3.jpg',
            'fourth_block_title' => 'Les travaux : Notre savoir-faire',
            'fourth_block_description' => "NOVECOLOGY s'engage sur la qualité et le professionnalisme de ses prestations, la bonne conduite des travaux, ainsi que sur le respect des délais. Le plus grand soin est apporté à la sûreté et la propreté du chantier.",
            'fourth_block_image' => 'valeurs-image-4.jpg',
            'fifth_block_title' => 'La satisfaction : Notre objectif',
            'fifth_block_short_description' => 'Nous faisons de la satisfaction de nos clients notre priorité !',
            'fifth_block_long_description' => 'La culture du service et du client est dans l’ADN de NOVECOLOGY depuis la création de l’entreprise. Une relation humaine et de proximité nous distingue et fidélise nos clients. La satisfaction des personnes que nous accompagnons est et restera au coeur de nos ',
            'fifth_block_image' => 'valeurs-image-5.jpg',
        ]);
    }
}
