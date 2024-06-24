<?php

namespace Database\Seeders;

use App\Models\CRM\DocumentControl;
use Illuminate\Database\Seeder;

class DocumentControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentControl::create([
            'name' => 'PV de fin de travaux'
        ]);
        DocumentControl::create([
            'name' => "Carte d'identité"
        ]);
        DocumentControl::create([
            'name' => "Photos"
        ]);
        DocumentControl::create([
            'name' => "Notification d'accord MPR"
        ]);
        DocumentControl::create([
            'name' => "Mandat"
        ]);
        DocumentControl::create([
            'name' => "Livret de famille"
        ]);
        DocumentControl::create([
            'name' => "Taxe foncière"
        ]);
        DocumentControl::create([
            'name' => "Acte notarié"
        ]);
        DocumentControl::create([
            'name' => "Justificatif de domicile de moins de 3"
        ]);
        DocumentControl::create([
            'name' => "Dernier avis d'imposition"
        ]);
        DocumentControl::create([
            'name' => "Chèque paiement"
        ]);
        DocumentControl::create([
            'name' => "Audit"
        ]);
        DocumentControl::create([
            'name' => "Attestation sur l'honneur MPR (+ 15 ans)"
        ]);
        DocumentControl::create([
            'name' => "Attestation propriétaire bailleur MPR"
        ]); 
        
    }
}
