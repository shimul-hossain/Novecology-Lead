<?php

namespace Database\Seeders;

use App\Models\CRM\InsideFrance;
use Illuminate\Database\Seeder;

class InsideFranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsideFrance::create([
            'person' => "1",
            'grand_precaire' => 22461,
            'precaire' => 27343,
            'intermediaire' => 38184,
            'classique' => 38184
        ]);

        InsideFrance::create([
            'person' => "2",
            'grand_precaire' => 32967,
            'precaire' => 40130,
            'intermediaire' => 56130,
            'classique' => 56130
        ]);

        InsideFrance::create([
            'person' => "3",
            'grand_precaire' => 39591,
            'precaire' => 48197,
            'intermediaire' => 67585,
            'classique' => 67585
        ]);

        InsideFrance::create([
            'person' => "4",
            'grand_precaire' => 46226,
            'precaire' => 56277,
            'intermediaire' => 79041,
            'classique' => 79041
        ]);

        InsideFrance::create([
            'person' => "5",
            'grand_precaire' => 52886,
            'precaire' => 64380,
            'intermediaire' => 90496,
            'classique' => 90496
        ]);

        InsideFrance::create([
            'person' => "extra",
            'grand_precaire' => 6650,
            'precaire' => 8097,
            'intermediaire' => 11455,
            'classique' => 11455
        ]);

    }
}
