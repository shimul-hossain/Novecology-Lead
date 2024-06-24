<?php

namespace Database\Seeders;

use App\Models\CRM\StatutMaprimerenov;
use Illuminate\Database\Seeder;

class StatutMaprimerenovSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatutMaprimerenov::create([
            'name' => 'Demande de subvention déposé'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Dépôt de subvention en attente de complément'
        ]);
        StatutMaprimerenov::create([
            'name' => 'En cours d’instruction'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Demande accepté'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Demande de solde déposé'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Demande de solde en attente de complément'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Accepté pour paiement'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Subvention rejetée'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Demande de subvention arrivé à échéance'
        ]);
        StatutMaprimerenov::create([
            'name' => 'Forclusion'
        ]);
    }
}
