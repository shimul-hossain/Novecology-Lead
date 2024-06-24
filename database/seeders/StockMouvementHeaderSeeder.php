<?php

namespace Database\Seeders;

use App\Models\CRM\StockMouvementHeader;
use Illuminate\Database\Seeder;

class StockMouvementHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header_arr = ['Produit', 'Date', 'Mouvement', 'Type_Mouvement', 'Entrepôt', 'Quantité', 'Enlèvement_Retour_par', 'Détails'];
        StockMouvementHeader::truncate();
        foreach ($header_arr as $header){
            StockMouvementHeader::create([
                'header' => $header
            ]);
        }
    }
}
