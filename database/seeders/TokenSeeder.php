<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Seeder;
use Str;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Token::create(['token' => Str::random(60)]);
    }

    
}
