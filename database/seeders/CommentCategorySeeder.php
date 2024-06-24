<?php

namespace Database\Seeders;

use App\Models\CRM\CommentCategory;
use Illuminate\Database\Seeder;

class CommentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentCategory::create([
            'name' => 'Commercial'
        ]);
        CommentCategory::create([
            'name' => 'Subvention'
        ]);
        CommentCategory::create([
            'name' => 'Prévisite'
        ]);
        CommentCategory::create([
            'name' => 'Installation'
        ]);
        CommentCategory::create([
            'name' => 'Facturation : le commentaires'
        ]);
    }
}
