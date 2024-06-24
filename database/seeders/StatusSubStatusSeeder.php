<?php

namespace Database\Seeders;

use App\Models\CRM\LeadStatusSubStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\ProjectStatusSubStatus;
use App\Models\CRM\ProjectSubStatus;
use Illuminate\Database\Seeder;

class StatusSubStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // LeadStatusSubStatus::truncate();
        // ProjectStatusSubStatus::truncate();
        // foreach(LeadSubStatus::all() as $sub_status){
        //     for($i=1; $i<=7; $i++){
        //         LeadStatusSubStatus::create([
        //             'status_id' => $i,
        //             'sub_status_id' => $sub_status->id,
        //         ]);
        //     }
        // }
        // foreach(ProjectSubStatus::all() as $sub_status){
        //     for($i=1; $i<=8; $i++){
        //         ProjectStatusSubStatus::create([
        //             'status_id' => $i,
        //             'sub_status_id' => $sub_status->id,
        //         ]);
        //     }
        // }
    }
}
