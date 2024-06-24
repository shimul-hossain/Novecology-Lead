<?php

namespace Database\Seeders;

use App\Models\CRM\StockCommandeHeader;
use Illuminate\Database\Seeder;

class StockCommandeHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header_arr = ['Numéro_commande', 'Fournisseur', 'STATUT', 'Bon_de_Commande', 'Bon_de_Livraison', 'Détail'];
        StockCommandeHeader::truncate();
        foreach ($header_arr as $header){
            StockCommandeHeader::create([
                'header' => $header
            ]);
        }
    }
}
