<?php

namespace App\Console\Commands;

use App\Models\CRM\LeadTax;
use App\Mail\RecallAlertMail;
use App\Models\CRM\ClientTax;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\ProjectTax;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MinutelyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minutely:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Rappeller email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $leads = LeadClientProject::where('lead_deleted_status', 0)->get();
        $clients = NewClient::where('deleted_status', 0)->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        // $leads = LeadTax::where('primary', 'yes')->get();
        // $clients = ClientTax::where('primary', 'yes')->get();
        // $projects = ProjectTax::where('primary', 'yes')->get();
        foreach($leads as $lead){
            if($lead->callback_time && $lead->callbackUser && $lead->callback_mail_status == 'no' && Carbon::now()->addMinutes(5) >= Carbon::parse($lead->callback_time)){
                $body = "Salut , ". $lead->callbackUser->name ." tu dois rappeler ". $lead->Prenom .' '.$lead->Nom ." à ".Carbon::parse($lead->callback_time)->format('d/m/Y, H:i')." - ne l'oublie pas :)";
                if($lead->callbackUser->email_professional && $lead->callbackUser->status == 'active'){
                    Mail::to($lead->callbackUser->email_professional)->send(new RecallAlertMail('Alerte de rappel', $body));
                }
                $lead->update([
                    'callback_mail_status' => 'yes',
                ]);
            }
        } 
        foreach($clients as $client){
            if($client->callback_time && $client->callbackUser && $client->callback_mail_status == 'no' && Carbon::now()->addMinutes(5) >= Carbon::parse($client->callback_time)){
                $body = "Salut , ". $client->callbackUser->name ." tu dois rappeler ". $client->Prenom .' '.$client->Nom ." à ".Carbon::parse($client->callback_time)->format('d/m/Y, H:i')." - ne l'oublie pas :)";
                if($client->callbackUser->email_professional && $client->callbackUser->status == 'active'){
                    Mail::to($client->callbackUser->email_professional)->send(new RecallAlertMail('Alerte de rappel', $body));
                }
                $client->update([
                    'callback_mail_status' => 'yes',
                ]);
            }
        } 
        foreach($projects as $project){
            if($project->callback_time && $project->callbackUser && $project->callback_mail_status == 'no' && Carbon::now()->addMinutes(5) >= Carbon::parse($project->callback_time)){
                $body = "Salut , ". $project->callbackUser->name ." tu dois rappeler ". $project->Prenom .' '.$project->Nom ." à ".Carbon::parse($project->callback_time)->format('d/m/Y, H:i')." - ne l'oublie pas :)";
                if($project->callbackUser->email_professional && $project->callbackUser->status == 'active'){
                    Mail::to($project->callbackUser->email_professional)->send(new RecallAlertMail('Alerte de rappel', $body));
                }
                $project->update([
                    'callback_mail_status' => 'yes',
                ]);
            }
        }

    }
}
