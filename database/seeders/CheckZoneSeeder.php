<?php

namespace Database\Seeders;

use App\Models\CRM\CheckZone;
use Illuminate\Database\Seeder;

class CheckZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckZone::create([
            "postal_code" => 75
        ]);
        
        CheckZone::create([
            "postal_code" => 77
        ]);

        CheckZone::create([
            "postal_code" => 78
        ]);

        CheckZone::create([
            "postal_code" => 91
        ]);

        CheckZone::create([
            "postal_code" => 92
        ]);

        CheckZone::create([
            "postal_code" => 93
        ]);

        CheckZone::create([
            "postal_code" => 94
        ]);

        CheckZone::create([
            "postal_code" => 95
        ]);
    }
}
