<?php

namespace Database\Seeders;

use App\Models\BackOffice\ReferenceGallery;
use App\Models\BackOffice\ReferenceGalleryCategory;
use App\Models\BackOffice\ReferenceInfo;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferenceInfo::truncate();
        ReferenceGallery::truncate();
        ReferenceGalleryCategory::truncate();
        ReferenceInfo::create([
            'title' => 'Nos références',
            'description' => 'Depuis plus de 12 ans, nous avons accompagné des milliers de clients dans leurs projets de rénovation énergétique. Nous avons su leur donner satisfaction en leur proposant des solutions innovantes, performantes et durables.',
            'image' => 'references-image.JPG',
            'gallery_title' => 'Nos dernières installations',
        ]);

        $category_items = ['Chaudière à granulés', 'Pompe à Chaleur Air/Eau', 'Pompe à Chaleur Air/Air', 'Solaire', 'Isolation'];

        $items = [
            [
                'category_id' => '1',
                'image' => 'service-image-1.jpg',
            ],
            [
                'category_id' => '2',
                'image' => 'service-image-2.jpg',
            ],
            [
                'category_id' => '3',
                'image' => 'service-image-3.jpg',
            ],
            [
                'category_id' => '4',
                'image' => 'service-image-4.jpg',
            ],
            [
                'category_id' => '5',
                'image' => 'service-image-5.jpg',
            ],
        ];

        foreach($category_items as $category){
            ReferenceGalleryCategory::create([
                'name' => $category
            ]);
        }

        foreach ($items as $item){
            ReferenceGallery::create([
                'category_id' => $item['category_id'],
                'image' => $item['image'],
            ]);
        }
    }
}
