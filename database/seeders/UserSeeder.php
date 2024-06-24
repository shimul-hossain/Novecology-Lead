<?php

namespace Database\Seeders;

use App\Models\CRM\UserHeader;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHeader::create([
                'header' => ['en' => 'ID', 'fr'=> 'ID'],
        ]);
        UserHeader::create([
                'header' => ['en' => 'First Name', 'fr'=> 'Prenom'],
        ]);
        UserHeader::create([
                'header' => ['en' => 'Name', 'fr'=> 'Nom'],
        ]);

        UserHeader::create([
                'header' => ['en' => 'Regie', 'fr'=> 'Regie'],
        ]);

        // UserHeader::create([
        //         'header' => ['en' => 'Team Leader', 'fr'=> "CHEF D’EQUIPE"],
        // ]);
        // UserHeader::create([
        //         'header' => ['en' => 'User Name', 'fr'=> 'Nom d\'utilisateur'],
        // ]);
        UserHeader::create([
                'header'    => ['en' => 'phone', 'fr' => 'téléphone'],
        ]);
        UserHeader::create([
                'header'    => ['en' => 'email', 'fr' => 'e-mail'],
        ]);
        UserHeader::create([
                'header'    => ['en' => 'Role', 'fr' => 'Rôle'],
        ]);
        UserHeader::create([
                'header'    => ['en' => 'Status', 'fr' => 'Statut'],
        ]);
    }
}
