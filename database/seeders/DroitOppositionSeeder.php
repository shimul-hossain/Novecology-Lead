<?php

namespace Database\Seeders;

use App\Models\BackOffice\DroitOpposition;
use Illuminate\Database\Seeder;

class DroitOppositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DroitOpposition::truncate();
        DroitOpposition::create([
            'title' => 'Droit d’opposition',
            'description' => '<p class="ql-align-justify">Vous disposez d’un droit d’opposition.</p><p class="ql-align-justify">Conformément aux dispositions de l’article 21 du Règlement Général sur la Protection des Données (RGPD), Règlement UE n°2016/679 du 27 avril 2016.</p><p class="ql-align-justify">Vous pouvez à tout moment vous opposer au traitement de vos données aux fins de prospections commerciales en nous contactant par courriel à l’adresse suivante&nbsp;:</p><p class="ql-align-justify">support@novecology.fr</p><p class="ql-align-justify">Si votre demande d’opposition ne concerne pas la prospection commerciale, NOVECOLOGY pourra justifier son refus au motif que&nbsp;:</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;il existe des motifs légitimes et impérieux à traiter les données ou que celles-ci sont nécessaires à la constatation, exercice ou défense de droits en justice&nbsp;;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vous avez consenti– vous devez alors retirer ce consentement et non vous opposer ;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;un contrat vous lie avec NOVECOLOGY ;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;une obligation légale qui nous impose de traiter vos données&nbsp;;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;le traitement est nécessaire à la sauvegarde des intérêts vitaux de la personne concernée ou d\'une autre personne physique.&nbsp;</p><p class="ql-align-justify">Conformément à L’article L.223-2 du Code de la consommation vous avez la possibilité de vous inscrire gratuitement sur une liste d’opposition au démarchage téléphonique connue sous le nom de Bloctel.</p><p class="ql-align-justify">Chaque numéro de téléphone renseigné par le consommateur est inscrit sur la liste Bloctel pour une durée de trois (3) ans.</p><p class="ql-align-justify">En application du nouvel&nbsp;<a href="https://info.haas-avocats.com/droit-digital/bloctel-les-inscriptions-desormais-renouvelable-par-tacite-reconduction?hsLang=fr" rel="noopener noreferrer" target="_blank" style="color: windowtext;">article R.223-3</a>&nbsp;du Code de la consommation applicable depuis le 1er janvier 2022, à l’issue de la durée de trois (3) ans, la réinscription du numéro sur la liste Bloctel est automatique sous réserve d’une inscription réalisée à compter du 2 avril 2019.</p><p class="ql-align-justify">Si vous êtes donc inscrits sur BLOCTEL, sachez que nos services ne pourront vous contacter téléphoniquement.</p><p><br></p>',
        ]);
    }
}
