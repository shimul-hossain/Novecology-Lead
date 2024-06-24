<?php

namespace Database\Seeders;

use App\Models\BackOffice\SupportBlockInfo;
use Illuminate\Database\Seeder;

class SupportInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportBlockInfo::truncate();
        SupportBlockInfo::create([
            'title' => "Un accompagnement dédié, pour des travaux en toute sérénité",
            'subtitle' => "Nos conseillers spécialisés guident votre projet de A à Z.",
            'image' => "support-image.jpg",
        ]);
    }
}
