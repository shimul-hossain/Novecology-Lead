<?php

namespace Database\Seeders;

use App\Models\CRM\ProjectDefaultHeaderFilter;
use Illuminate\Database\Seeder;

class ProjectDefaultHeaderFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [1,10,11,12,13,14,15];
        for($i= 0;$i < count($array); $i++){
            ProjectDefaultHeaderFilter::create([
                'header_id' => $array[$i],
            ]);
        }
    }
}
