<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BackOffice\BandeauInformation;

class BandeauInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BandeauInformation::truncate();
        BandeauInformation::create([
            'title' => 'BANDEAU D’INFORMATION',
            'description' => '<p>not given yet</p>',
        ]);
    }
}
