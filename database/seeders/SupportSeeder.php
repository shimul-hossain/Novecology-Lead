<?php

namespace Database\Seeders;

use App\Models\BackOffice\Support;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'title' => 'Des conseillers à votre écoute',
                'description' => 'Disponibles du lundi au vendredi de 8h à 19h.',
                'icon' => 'support-icon-1.png',
            ],
            [
                'title' => 'Experts en rénovation',
                'description' => 'Formés en continu aux nouveautés du secteur.',
                'icon' => 'support-icon-2.png',
            ],
            [
                'title' => 'Un suivi personnalisé',
                'description' => 'Nos recommandations sont adaptées à votre logement.',
                'icon' => 'support-icon-3.png',
            ],
            [
                'title' => 'Une assistance pour obtenir vos aides',
                'description' => "Vous êtes guidé pour obtenir la Prime Effy et MaPrimeRenov'.",
                'icon' => 'support-icon-4.png',
            ],
        ];
        Support::truncate();
        foreach ($items as $item){
            Support::create([
                'title' => $item['title'],
                'description' => $item['description'],
                'icon' => $item['icon'],
            ]);
        }
    }
}
