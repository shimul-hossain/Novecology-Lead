<?php

namespace Database\Seeders;

use App\Models\CRM\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'In-Process',
            'color' => 'primary',
        ]);
        Tag::create([ 
            'name' => 'On-Hold', 
            'color' => 'warning'
        ]);
        Tag::create([ 
            'name' => 'Testing', 
            'color' => 'info'
        ]);
        Tag::create([ 
            'name' => 'Development', 
            'color' => 'success'
        ]);
        Tag::create([ 
            'name' => 'Team', 
            'color' => 'danger'
        ]);
        Tag::create([ 
            'name' => 'Update', 
            'color' => 'secondary'
        ]);
    }
}
