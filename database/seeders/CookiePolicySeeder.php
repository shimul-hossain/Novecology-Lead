<?php

namespace Database\Seeders;

use App\Models\BackOffice\CookiePolicy;
use Illuminate\Database\Seeder;

class CookiePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CookiePolicy::truncate();
        CookiePolicy::create([
            'title' => 'POLITIQUE DE COOKIES',
            'description' => '<p>not given get</p>',
        ]);
    }
}
