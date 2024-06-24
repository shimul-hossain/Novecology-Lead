<?php

namespace Database\Seeders;

use App\Models\CRM\OutsideFrance;
use Illuminate\Database\Seeder;

class OutsideFranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OutsideFrance::create([
            'person' => "1",
            'grand_precaire' => 16229,
            'precaire' => 20805,
            'intermediaire' => 29148,
            'classique' => 29148
        ]);

        OutsideFrance::create([
            'person' => "2",
            'grand_precaire' => 23734,
            'precaire' => 30427,
            'intermediaire' => 42848,
            'classique' => 42848
        ]);
        
        OutsideFrance::create([
            'person' => "3",
            'grand_precaire' => 28545,
            'precaire' => 36591,
            'intermediaire' => 51592,
            'classique' => 51592
        ]);
        
        OutsideFrance::create([
            'person' => "4",
            'grand_precaire' => 33346,
            'precaire' => 42748,
            'intermediaire' => 60336,
            'classique' => 60336
        ]);
        
        OutsideFrance::create([
            'person' => "5",
            'grand_precaire' => 38168,
            'precaire' => 48930,
            'intermediaire' => 69081,
            'classique' => 69081
        ]);
        
        OutsideFrance::create([
            'person' => "extra",
            'grand_precaire' => 4813,
            'precaire' => 6165,
            'intermediaire' => 8744,
            'classique' => 8744
        ]);
    }
}
