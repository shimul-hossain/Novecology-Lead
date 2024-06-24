<?php

namespace Database\Seeders;

use App\Models\CRM\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::create([
            "name"=>"H1"
        ]);
        
        Zone::create([
            "name"=>"H2"
        ]);

        Zone::create([
            "name"=>"H3"
        ]);
    }
}
