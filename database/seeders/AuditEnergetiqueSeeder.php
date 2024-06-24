<?php

namespace Database\Seeders;

use App\Models\BackOffice\AuditEnergetique;
use App\Models\BackOffice\AuditEnergetiqueThirdBlockInfo;
use Illuminate\Database\Seeder;

class AuditEnergetiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuditEnergetique::truncate();
        AuditEnergetiqueThirdBlockInfo::truncate();

        AuditEnergetique::create([
            'banner_title' => 'Réalisez un audit énergétique',
            'banner_subtitle' => 'pour une rénovation énergétique optimale',
            'banner_description' => 'Anticipez votre rénovation énergétique et réaliser des économies importantes sur votre facture d’énergie.',
            'banner_button_text' => 'DEMANDEZ VOTRE ÉTUDE',
            'banner_image' => 'audit-energetique.webp',
            'title' => 'Audit énergétique',
            'description' => "Mode de chauffage préféré des Français, la Isolation Thermique par l'Extérieur (ITE)  est une solution de chauffage écologique et économique. Basée sur l’utilisation d’une énergie renouvelable, la pompe à chaleur Air/Eau récupère les calories naturellement présentes dans l’air extérieur pour les restituer sous forme de chaleur au circuit de chauffage central.",
            'first_block_title' => 'En quoi la pompe à chaleur Air/Eau est-elle économique ?',
            'first_block_image' => 'services-details-section-1.webp',
            'first_block_desciption' => 'En fonctionnant avec l’air, la pompe à chaleur Air/Eau est un système de chauffage écologique et bien sûr économique. L’air étant une source inépuisable et gratuite, vous réduisez considérablement votre facture énergétique. Avec la pompe à chaleur Air/Eau, vous produisez davantage que vous ne consommez d’énergie. Par exemple, pour 1kWh d’électricité consommée, la PAC Air/Eau restitue 3 à 4 kWh de chaleur. Vous pouvez ainsi diviser par 3 à 4 le montant de votre facture.En plus de chauffer votre maison, la PAC Air/Eau produit de l’eau chaude sanitaire. En la couplant à un ballon ou à un chauffe-eau thermodynamique, vous économisez également sur vos frais d’eau chaude. Afin d’obtenir de réelles économies, il est important de bien dimensionner la PAC air/eau. En effet, un surdimensionnement entraine une surconsommation de l’équipement et une durée de vie plus courte. Pour maximiser les économies, il est conseillé de renforcer l’isolation de votre logement afin d’éviter les déperditions énergétiques et par conséquent réduire vos besoins en chauffage',
            'first_block_button_text' => 'Estimez le montant de vos aides',
            'second_block_title' => 'Pompe à chaleur Air/Eau : quel est son principe ?',
            'second_block_image' => 'services-details-section-2.webp',
            'second_block_desciption' => 'Comme la Pac Air/Air, la PAC Air/Eau repose sur le système aérothermique c’est-à-dire qu’elle puise les calories contenues dans l’air extérieur pour les restituer sous forme de chaleur. Dans le cas de la PAC Air/Eau, c’est l’eau alimentant le chauffage qui est utilisée pour augmenter la température du logement. La pompe à chaleur Air/Eau se compose d’une unité extérieure, qui puise les calories de l’air, et d’une unité intérieure qui redistribue l’énergie dans le circuit de chauffage. Le fluide frigorigène, contenu dans la PAC Air/Eau permet cette transformation. Capable de transporter la chaleur, le fluide frigorigène passe sous différentes formes (liquide et gazeux) pour émettre la chaleur au sein du logement.',
            'second_block_button_text' => 'Estimez le montant de vos aides', 
            'third_block_title' => 'Quels sont les avantagesde la PAC Air/Eau ?',
        ]);

        $items = [
            [
                'image' => 'icon-1.svg',
                'title' => 'Un confort thermique',
                'description' => 'La PAC Air/Eau maintient et garantit une température constante pendant toute la saison hivernale. Vous profitez ainsi d’une chaleur douce dans toutes les pièces de votre logement.',
            ],
            [
                'image' => 'icon-2.svg',
                'title' => 'Un système écologique',
                'description' => 'La pompe à chaleur Air/Eau se distingue des autres types de chauffage exploitant les énergies fossiles. Puisant son énergie dans l’air, elle est donc inodore lors de son fonctionnement contrairement aux chaudières au fioul ou au gaz.',
            ],
            [
                'image' => 'icon-3.svg',
                'title' => 'Une plus value immobilière',
                'description' => 'Le chauffage étant le plus gros poste de dépense énergétique dans un logement, la pompe à chaleur Air/Eau vous fait gagner en étiquette énergétique. S’équiper d’une PAC Air/Eau permet ainsi d’améliorer sa performance énergétique et de valoriser son habitat. Une habitation chauffée au fioul sera classée E, F ou G sur le DPE (Diagnostic de Performance Energétique). Équipée d’une PAC Air/Eau, celle-ci valorisera son DPE en moyenne d’une étiquette.',
            ],
            [
                'image' => 'icon-4.svg',
                'title' => 'Une installation simple et efficace',
                'description' => 'La PAC Air/Eau se compose d’une unité extérieure et d’une unité intérieure, positionnée dans une des pièces de la maison. Peu volumineuse, elle ne requiert que peu d’espace et vous permet ainsi de garder l’esthétisme de votre logement. En plus de présenter une performance de chauffe, la pompe à chaleur Air/Eau ne nécessite, à l’inverse du bois ou du fioul, pas d’espace de stockage pour le combustible. Facile d’installation et d’entretien, la PAC Air/Eau est la solution de chauffage idéale dans le cadre de travaux de rénovation énergétique.',
            ],
        ];

        foreach($items as $item){
            AuditEnergetiqueThirdBlockInfo::create([
                'image' => $item['image'],
                'title' => $item['title'],
                'description' => $item['description'],
            ]);
        }
    }
}
