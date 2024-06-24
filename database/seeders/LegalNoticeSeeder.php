<?php

namespace Database\Seeders;

use App\Models\BackOffice\LegalNotice;
use Illuminate\Database\Seeder;

class LegalNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LegalNotice::truncate();
        LegalNotice::create([
            'title' => 'MENTIONS LÉGALES',
            'description' => '<p>not given get</p>',
        ]);
    }
}
