<?php

namespace Database\Seeders;

use App\Models\BackOffice\NewContact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewContact::truncate();
        NewContact::create([
            'title' => 'Nous Contacter',
            'subtitle' => 'Vous avez un projet de rénovation énergétique ?',
            'description' => 'Le service client du Groupe Verlaine est à votre disposition pour répondre à toutes vos questions en matière de rénovation énergétique. Des conseillers spécialisés sauront répondre à vos interrogations et vous aider à concrétiser votre projet de rénovation énergétique.',
            'button_text' => 'Prendre rendez-vous',
            'image' => 'bear-map-image.png',
        ]);
    }
}
