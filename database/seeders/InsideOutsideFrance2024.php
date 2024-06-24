<?php

namespace Database\Seeders;

use App\Models\CRM\InsideFrance2024;
use App\Models\CRM\OutsideFrance2024;
use Illuminate\Database\Seeder;

class InsideOutsideFrance2024 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsideFrance2024::truncate();
        OutsideFrance2024::truncate();
        $inside_france = [
            [
                'person' => '1', 
                'grand_precaire' => '23541', 
                'precaire' => '28657', 
                'intermediaire' => '40018', 
                'classique' => '40018', 
            ],
            [
                'person' => '2', 
                'grand_precaire' => '34551', 
                'precaire' => '42058', 
                'intermediaire' => '58827', 
                'classique' => '58827', 
            ],
            [
                'person' => '3', 
                'grand_precaire' => '41493', 
                'precaire' => '50513', 
                'intermediaire' => '70382', 
                'classique' => '70382', 
            ],
            [
                'person' => '4', 
                'grand_precaire' => '48447', 
                'precaire' => '58981', 
                'intermediaire' => '82839', 
                'classique' => '82839', 
            ],
            [
                'person' => '5', 
                'grand_precaire' => '55427', 
                'precaire' => '67473', 
                'intermediaire' => '94844', 
                'classique' => '94844', 
            ],
            [
                'person' => 'extra', 
                'grand_precaire' => '6970', 
                'precaire' => '8486', 
                'intermediaire' => '12006', 
                'classique' => '12006', 
            ],
        ];
        $outside_france = [
            [
                'person' => '1', 
                'grand_precaire' => '17009', 
                'precaire' => '21805', 
                'intermediaire' => '30549', 
                'classique' => '30549', 
            ],
            [
                'person' => '2', 
                'grand_precaire' => '24875', 
                'precaire' => '31889', 
                'intermediaire' => '44907', 
                'classique' => '44907', 
            ],
            [
                'person' => '3', 
                'grand_precaire' => '29917', 
                'precaire' => '38349', 
                'intermediaire' => '54071', 
                'classique' => '54071', 
            ],
            [
                'person' => '4', 
                'grand_precaire' => '34948', 
                'precaire' => '44802', 
                'intermediaire' => '63235', 
                'classique' => '63235', 
            ],
            [
                'person' => '5', 
                'grand_precaire' => '40002', 
                'precaire' => '51281', 
                'intermediaire' => '72400', 
                'classique' => '72400', 
            ],
            [
                'person' => 'extra', 
                'grand_precaire' => '5045', 
                'precaire' => '6462', 
                'intermediaire' => '9165', 
                'classique' => '9165', 
            ],
        ];

        foreach($inside_france as $inside){
            InsideFrance2024::create([
                'person' => $inside['person'],
                'grand_precaire' => $inside['grand_precaire'],
                'precaire' => $inside['precaire'],
                'intermediaire' => $inside['intermediaire'],
                'classique' => $inside['classique'],
            ]);
        }
        foreach($outside_france as $inside){
            OutsideFrance2024::create([
                'person' => $inside['person'],
                'grand_precaire' => $inside['grand_precaire'],
                'precaire' => $inside['precaire'],
                'intermediaire' => $inside['intermediaire'],
                'classique' => $inside['classique'],
            ]);
        }
    }
}
