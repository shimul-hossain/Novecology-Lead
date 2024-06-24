<?php

namespace Database\Seeders;

use App\Models\BackOffice\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivacyPolicy::truncate();
        PrivacyPolicy::create([
            'title' => 'POLITIQUE DE CONFIDENTIALITÉ',
            'description' => '<p>not given get</p>',
        ]);
    }
}
