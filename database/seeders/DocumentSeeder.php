<?php

namespace Database\Seeders;

use App\Models\CRM\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documents = [
            [ 'id' => 1,  'name' => 'ACCORD DE CONSENTEMENT MPR x AXDIS',                                                   'view' => 'pdf-01', 'type' => 0],
            [ 'id' => 2,  'name' => 'ACCORD DE CONSENTEMENT MPR x NOV',                                                     'view' => 'pdf-02', 'type' => 0],
            // [ 'id' => 4,  'name' => '(ADM) DPI',                                                                            'view' => 'pdf-04', 'type' => 0],
            [ 'id' => 5,  'name' => '(ADM) NOTE DE DIMENSIONNEMENT',                                                        'view' => 'pdf-05', 'type' => 0],
            // [ 'id' => 6,  'name' => '(ADM) PAPILLON FISCALE',                                                               'view' => 'pdf-06', 'type' => 0],
            [ 'id' => 7,  'name' => 'ATTESTATION CHAUFFAGE',                                                                'view' => 'pdf-07', 'type' => 0],
            [ 'id' => 8,  'name' => 'ATTESTATION CHAUFFAGE V2',                                                             'view' => 'pdf-08', 'type' => 0],
            [ 'id' => 9,  'name' => 'ATTESTATION DECHARGE HSP',                                                             'view' => 'pdf-09', 'type' => 0],
            [ 'id' => 10, 'name' => 'ATTESTATION DEMENAGEMENT',                                                             'view' => 'pdf-10', 'type' => 0],
            [ 'id' => 11, 'name' => 'ATTESTATION DOMICILE',                                                                 'view' => 'pdf-11', 'type' => 0],
            [ 'id' => 12, 'name' => 'ATTESTATION FICHE D_INFORMATION PRÉCONTRACTUELLE',                                     'view' => 'pdf-12', 'type' => 0],
            [ 'id' => 13, 'name' => 'ATTESTATION FICHE DE DEMANDE D_EXÉCUTION AVANT LA FIN DU DÉLAI DE RÉTRACTION',         'view' => 'pdf-13', 'type' => 0],
            [ 'id' => 14, 'name' => 'ATTESTATION FICHE INFORMATION MPR',                                                    'view' => 'pdf-14', 'type' => 0],
            [ 'id' => 15, 'name' => 'ATTESTATION LOGEMENT',                                                                 'view' => 'pdf-15', 'type' => 0],
            [ 'id' => 16, 'name' => 'ATTESTATION MISE EN SERVICE',                                                          'view' => 'pdf-16', 'type' => 0],
            [ 'id' => 17, 'name' => 'ATTESTATION NON DESINSTALLATION CUVE',                                                 'view' => 'pdf-17', 'type' => 0],
            [ 'id' => 18, 'name' => 'ATTESTATION RAC',                                                                      'view' => 'pdf-18', 'type' => 0],
            [ 'id' => 19, 'name' => 'ATTESTATION SAV',                                                                      'view' => 'pdf-19', 'type' => 0],
            [ 'id' => 20, 'name' => 'ATTESTATION SIMPLIFIEE TVA',                                                           'view' => 'pdf-20', 'type' => 0],
            [ 'id' => 21, 'name' => 'ATTESTATION SUR LHONNEUR LOGEMENT + 15 ANS',                                           'view' => 'pdf-21', 'type' => 0],
            [ 'id' => 22, 'name' => 'ATTESTATION VENTILATION CLIENT',                                                       'view' => 'pdf-22', 'type' => 0],
            [ 'id' => 26, 'name' => 'CADRE DE CONTRIBUTION',                                                                'view' => 'pdf-26', 'type' => 0],
            [ 'id' => 27, 'name' => 'CERTIFICAT RGE QUALIPAC',                                                              'view' => 'pdf-27', 'type' => 0],
            [ 'id' => 28, 'name' => 'CERTIFICAT RGE QUALIBOIS',                                                             'view' => 'pdf-28', 'type' => 0],
            [ 'id' => 29, 'name' => 'CERTIFICAT RGE QUALISOL',                                                              'view' => 'pdf-29', 'type' => 0],
            [ 'id' => 30, 'name' => 'COURRIER FIN INSTALLATION VERTIGO',                                                    'view' => 'pdf-30', 'type' => 0],
            [ 'id' => 31, 'name' => 'COURRIER FIN D_INSTALLATION AXDIS',                                                    'view' => 'pdf-31', 'type' => 0],
            [ 'id' => 32, 'name' => 'CQ CAG',                                                                               'view' => 'pdf-32', 'type' => 0],
            [ 'id' => 33, 'name' => 'CQ PAC',                                                                               'view' => 'pdf-33', 'type' => 0],
            [ 'id' => 34, 'name' => 'CQ ISOLATION',                                                                         'view' => 'pdf-34', 'type' => 0],
            [ 'id' => 35, 'name' => 'CQ SSC',                                                                               'view' => 'pdf-35', 'type' => 0],
            [ 'id' => 36, 'name' => 'CQ POELE',                                                                             'view' => 'pdf-36', 'type' => 0],
            [ 'id' => 37, 'name' => 'DECHARGE DE MAINTENANCE',                                                              'view' => 'pdf-37', 'type' => 0],
            [ 'id' => 41, 'name' => 'MANDAT REPRESENTATION NOVECOLOGY',                                                     'view' => 'pdf-41', 'type' => 0],
            [ 'id' => 44, 'name' => 'ATTESTATION PROPRIETAIRE BAILLEUR',                                                    'view' => 'pdf-44', 'type' => 0],
            [ 'id' => 45, 'name' => 'ATTESTATION DE CONSENTEMENT',                                                          'view' => 'pdf-45', 'type' => 0],
            [ 'id' => 47, 'name' => 'ATTESTATION INDIVISION MPR',                                                           'view' => 'pdf-47', 'type' => 0],
            [ 'id' => 48, 'name' => 'PAGE DE GARDE DEVIS',                                                                  'view' => 'pdf-48', 'type' => 0],
            [ 'id' => 49, 'name' => 'PAGE DE GARDE DOSSIER MPR',                                                            'view' => 'pdf-49', 'type' => 0],
            [ 'id' => 50, 'name' => 'PAGE DE GARDE DOSSIER ACTION LOGEMENT',                                                'view' => 'pdf-50', 'type' => 0],
            [ 'id' => 51, 'name' => 'PAGE DE GARDE DOSSIER FINANCEMENT',                                                    'view' => 'pdf-51', 'type' => 0],
            [ 'id' => 52, 'name' => 'PV FIN DE CHANTIER NOVECOLOGY',                                                        'view' => 'pdf-52', 'type' => 0],
            [ 'id' => 53, 'name' => 'PV DE FIN DE CHANTIER VERTIGO',                                                        'view' => 'pdf-53', 'type' => 0]
        ];
        Document::truncate();
        foreach($documents as $document){
            Document::create([
                'id'        => $document['id'],
                'name'      => $document['name'],
                'view_name' => $document['view'],
                'type'      => $document['type'],
            ]);
        }
        //
    }
}
