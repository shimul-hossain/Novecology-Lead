<?php

namespace Database\Seeders;

use App\Models\BackOffice\News;
use App\Models\BackOffice\NewsCategory;
use App\Models\BackOffice\NewsInfo;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsInfo::truncate();
        NewsCategory::truncate();
        News::truncate();
        NewsInfo::create([
            'home_page_title' => 'Actualité et conseils',
            'home_page_subtitle' => 'Pour tout savoir sur la rénovation énergétique découvrez nos dernières actualités',
            'main_page_title' => 'Toutes les nouveautés des aides à la rénovation',
            'main_page_subtitle' => 'Découvrez toutes les actus sur les aides à la rénovation énergétique.',
        ]);
        NewsCategory::create([
            'name' => 'ACTUALITÉS',
        ]);

        $items = [
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-1.svg',
                'thumbnail_image' => 'valeurs-image-1.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-2.svg',
                'thumbnail_image' => 'valeurs-image-2.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-3.svg',
                'thumbnail_image' => 'valeurs-image-3.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-4.svg',
                'thumbnail_image' => 'valeurs-image-4.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-1.svg',
                'thumbnail_image' => 'valeurs-image-1.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-2.svg',
                'thumbnail_image' => 'valeurs-image-2.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-3.svg',
                'thumbnail_image' => 'valeurs-image-3.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
            [
                'title' => "Comment réduire l'humidité dans une maison ?",
                'feature_image' => 'blog-image-4.svg',
                'thumbnail_image' => 'valeurs-image-4.jpg',
                'banner_image' => 'audit-energetique.webp',
                'description' => '<p><em>Une hausse du montant de la prime à l\'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l\'Energie (CRE). Cette augmentation est assortie d\'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l\'objet d\'un paiement en une seule fois. Un moyen d\'inciter les particuliers à s\'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p><h3>Hausse du montant de la prime à l\'autoconsommation : quel est le nouveau barème ?</h3><p><br></p><p>La&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">prime à l\'autoconsommation</a>&nbsp;est une aide destinée aux consommateurs particuliers et professionnels qui décident d\'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l\'Etat, cette prime permet de minimiser les frais de l\'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l\'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec&nbsp;<a href="https://novecology.fr/testing/nos-conseils/details#!" rel="noopener noreferrer" target="_blank" style="color: rgb(19, 67, 140);">l\'arrêté du 8 février 2023</a>&nbsp;Le gendarme de l\'énergie précise le montant de la prime:</p><ul><li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li><li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li></ul><h4>Prime à l\'investissement : le barème pour le T1 2023</h4><p><br></p>',
            ],
        ];

        foreach($items as $item){
            News::create([
                'category_id' => 1,
                'title' => $item['title'],
                'feature_image' => $item['feature_image'],
                'thumbnail_image' => $item['thumbnail_image'],
                'banner_image' => $item['banner_image'],
                'description' => $item['description'],
                'created_by' => 1,
            ]);
        }
    }
}
