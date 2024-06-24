<?php

namespace Database\Seeders;

use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use Illuminate\Database\Seeder;

class DatabaseDataUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = NewClient::where('deleted_status', 0)->has('primaryTax')->get();
        foreach($clients as $client){
            if($client->primaryTax){
                $client->primaryTax->update([
                    'pays' => $client->Revenue_Fiscale_de_Référence,
                    'family_person' => $client->Nombre_de_personnes,
                ]); 
            }
        }
        $projects = NewProject::where('deleted_status', 0)->has('primaryTax')->get();
        foreach($projects as $project){
            if($project->primaryTax){
                $project->primaryTax->update([
                    'pays' => $project->Revenue_Fiscale_de_Référence,
                    'family_person' => $project->Nombre_de_personnes,
                ]); 
            }
        }
    }
}
