<?php

namespace Database\Seeders;

use App\Models\CRM\DefaultHeaderFilter;
use Illuminate\Database\Seeder;

class DefaultHeaderFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultHeaderFilter::create([
            'header_id' => 1
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 17
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 19
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 21
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 22
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 23
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 24
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 25
        ]);
        DefaultHeaderFilter::create([
            'header_id' => 34
        ]);
    }
}
