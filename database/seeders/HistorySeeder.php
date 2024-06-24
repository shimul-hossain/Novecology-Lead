<?php

namespace Database\Seeders;

use App\Models\BackOffice\History;
use App\Models\BackOffice\HistoryThirdBlockInfo;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        History::truncate();
        HistoryThirdBlockInfo::truncate();
        History::create([
            'first_block_title' => 'Notre histoire',
            'first_block_description' => "Depuis 2009, NOVECOLOGY s'engage Depuis 2009, dans la lutte contre le changement climatique,
            Novecology apporte son expertise aux particuliers désireux d'optimiser au mieux leur consommation d'énergie en leur proposant des solutions sur mesure.
            Nous sommes composé de spécialistes à votre service pour vous conseiller et vous accompagner dans chacune des étapes liées à la réhabilitation et à l'amélioration de votre habitat.
            Notre objectif est de devenir, pour votre confort, l'acteur incontournable de la rénovation énergétique !",
            'first_block_image' => 'history-image-1.jpg',
            'second_block_title' => 'Vos besoins, notre mission',
            'second_block_description' => 'Novecology a pour mission de promouvoir les économies d’énergie auprès des foyers les plus modestes par ses différentes actions d’information, d’incitation et de mise en oeuvre.
            Grâce aux dispositifs des Certificats d’Economie d‘Energie (CEE), nous sommes en mesure de financer à 100% de nombreuses opérations en matière d’économie d’énergie chez les ménages exposés à la précarité énergétique.
            Ces différents programmes de travaux accompagnent les foyers les plus modestes dans le but d’améliorer la performance énergétique de leur logement. Ces économies d’énergie se transformeront directement en pouvoir d’achat.',
            'second_block_image' => 'history-image-2.jpg',
            'third_block_title' => 'NOUS INTERVENONS PARTOUT EN FRANCE',
            'third_block_description' => 'Grâce à nos 10 entrepôts et nos installateurs agréés RGE répartis sur l’ensemble du territoire national, nous intervenons rapidement et réalisons des installations répondants aux critères de qualité du label RGE.',
            'third_block_image' => 'bear-map-image.png',
        ]);

        $items = [
            [
                'icon' => '<i class="fa-solid fa-user-group"></i>',
                'description' => 'Un accompagnement client à toutes les étapes de votre projet',
            ],
            [
                'icon' => '<i class="fa-solid fa-shapes"></i>',
                'description' => 'Des équipements répondant aux standards CEE',
            ],
            [
                'icon' => '<i class="fa-solid fa-user-tie"></i>',
                'description' => 'Des experts disponibles pour répondre à toutes vos questions',
            ],
            [
                'icon' => '<i class="fa-solid fa-warehouse"></i>',
                'description' => '10 entrepôts dans toute la France',
            ],
            [
                'icon' => '<i class="fa-solid fa-award"></i>',
                'description' => 'Des installateurs agréés RGE prêt de chez vous',
            ],
            [
                'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>',
                'description' => 'Des installations conformes aux exigences de qualité du label RGE',
            ],
        ];

        foreach ($items as $item){
            HistoryThirdBlockInfo::create([
                'icon' => $item['icon'],
                'description' => $item['description'],
            ]);
        }
    }
}
