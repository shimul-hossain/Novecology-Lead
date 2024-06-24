<?php

namespace App\Console\Commands;

use App\Mail\AutomatisationMail;
use App\Models\Automatise;
use App\Models\CRM\ControleSurSite;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewProject;
use App\Models\CRM\ProjectIntervention;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class RecurrenceAutomatise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurrence:automatise';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recurrence Automatisation';

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
        $leads = LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', '!=', 7)->where(function($query) {
            $query->where('etiquette_automatise_recurrence_status', 1)
            ->orWhere('statut_automatise_recurrence_status', 1);
           })->get();
        $projects = NewProject::where('deleted_status', 0)->where(function($query) {
            $query->where('etiquette_automatise_recurrence_status', 1)
            ->orWhere('statut_automatise_recurrence_status', 1);
           })->get();
                   
        $second_table_projects = NewProject::where('deleted_status', 0)->whereHas('projectSecondTable', function ($query) {
            $query->where('etiquette_automatise_not_change', 1)->orWhere('statut_automatise_not_change', 1);
        })->get();

        $stop_recurrence = ['Saturday' => '2', 'Sunday' => '1'];
        foreach($leads as $lead){

            $lead_travaux = '';
            $lead_travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $lead_travaux .= $item->travaux .($lead_travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $lead_travaux_count++;
            }
            
            if($lead->etiquette_automatise_recurrence_status == 1){
                $automatisation = Automatise::find($lead->etiquette_automatise_id);
                if($automatisation && $automatisation->recurrence == 'Oui' && $lead->etiquette_automatise_recurrence_start){
                    if($automatisation->fin > $lead->etiquette_fin){
                        if(Carbon::now() > Carbon::parse($lead->etiquette_automatise_recurrence_start)->addDays($automatisation->frequence)){
                            if(array_key_exists(Carbon::now()->format('l'), $stop_recurrence)){
                                $lead->etiquette_automatise_recurrence_start = Carbon::parse($lead->etiquette_automatise_recurrence_start)->addDays($stop_recurrence[Carbon::now()->format('l')]);
                                $lead->save();
                                continue;
                            }
                            if($automatisation->fin == ($lead->etiquette_fin + 1)){
                                $lead->etiquette_automatise_recurrence_status = 0;    
                                $lead->etiquette_automatise_id = 0;     
                                $lead->etiquette_fin = 0;    
                                $lead->etiquette_automatise_recurrence_start = null;        
                            }else{
                                $lead->etiquette_fin = $lead->etiquette_fin + 1;    
                                $lead->etiquette_automatise_recurrence_start = Carbon::now();
                            } 
                            if($automatisation->sending_type == 'send_email')
                            {
                                $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                $subject = $template->object;
                                $body = $template->body;
                                
                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $lead->lead_ko_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $lead_travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                                
                                // $subject = $automatisation->name;
                                if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                {
                                
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files =public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }

                                        if($automatisation->select_to == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            } 
                                        }
                                
                                        // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }

                                }
                                if($automatisation->select_to == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                }

                                if($automatisation->select_to == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                }
                                
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                    {
                                    
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        {
                                        
                                            
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cc == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }
                                            }
                                        }
        
                                    }
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                    if($automatisation->select_to_cc == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email_cc;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                    {
                                    
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        {
                                        
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cci == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }

                                            }
                                        }
        
                                    }
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                    if($automatisation->select_to_cci == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email_cci;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                }
                            }
                        else
                        {

                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
                                
                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $lead->lead_ko_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $lead_travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                                $subject = $automatisation->name;
                                
                                if($automatisation->select_to == 'Client')
                                { 
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $lead->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                    
                                    }

                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                        
                                        }
            
                                    }
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                        
                                        }
            
                                    }
                                }
                                
                                
                            }
                        }
                        
                    }else{
                        $lead->etiquette_automatise_recurrence_status = 0;    
                        $lead->etiquette_automatise_id = 0;    
                        $lead->etiquette_fin = 0;    
                        $lead->etiquette_automatise_recurrence_start = null;    
                    }
                }else{
                    $lead->etiquette_automatise_recurrence_status = 0;
                    $lead->etiquette_automatise_id = 0; 
                    $lead->etiquette_fin = 0;
                    $lead->etiquette_automatise_recurrence_start = null;
                }
            }
            if($lead->statut_automatise_recurrence_status == 1){
                $automatisation = Automatise::find($lead->statut_automatise_id);
                if($automatisation && $automatisation->recurrence == 'Oui' && $lead->statut_automatise_recurrence_start){
                    if($automatisation->fin > $lead->statut_fin){
                        if(Carbon::now() > Carbon::parse($lead->statut_automatise_recurrence_start)->addDays($automatisation->frequence)){
                            if(array_key_exists(Carbon::now()->format('l'), $stop_recurrence)){
                                $lead->statut_automatise_recurrence_start = Carbon::parse($lead->statut_automatise_recurrence_start)->addDays($stop_recurrence[Carbon::now()->format('l')]);
                                $lead->save();
                                continue;
                            }
                            if($automatisation->fin == ($lead->statut_fin + 1)){
                                $lead->statut_automatise_recurrence_status = 0;    
                                $lead->statut_automatise_id = 0;     
                                $lead->statut_fin = 0;    
                                $lead->statut_automatise_recurrence_start = null;        
                            }else{
                                $lead->statut_fin = $lead->statut_fin + 1;    
                                $lead->statut_automatise_recurrence_start = Carbon::now();
                            } 
                            if($automatisation->sending_type == 'send_email')
                            {
                                $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                
                                $subject = $template->object;
                                $body = $template->body;

                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $lead->lead_ko_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $lead_travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                        
                                if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                {
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    { 
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                
                                        if($automatisation->select_to == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                        // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }

                                }
                                if($automatisation->select_to == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));

                                }
                                
                                if($automatisation->select_to == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                    {
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        { 
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cc == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }

                                            }
                                            // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }

                                    }
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                            // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));

                                    } 
                                    if($automatisation->select_to_cc == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email_cc;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 

                                    } 
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                    {
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        { 
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cci == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }

                                            }
                                        }

                                    }
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                    if($automatisation->select_to_cci == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email_cci;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    } 
                                }
                            }
                            else
                            {
    
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;

                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $lead->lead_ko_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $lead_travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                                $subject = $automatisation->name;
                                
                                if($automatisation->select_to == 'Client')
                                { 
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $lead->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                            
                            
                            }
                        }
                        
                    }else{
                        $lead->statut_automatise_recurrence_status = 0;    
                        $lead->statut_automatise_id = 0;    
                        $lead->statut_fin = 0;    
                        $lead->statut_automatise_recurrence_start = null;    
                    }
                }else{
                    $lead->statut_automatise_recurrence_status = 0;
                    $lead->statut_automatise_id = 0; 
                    $lead->statut_fin = 0;
                    $lead->statut_automatise_recurrence_start = null;
                }
            } 
            $lead->save();
        }
        foreach($projects as $project){

            $travaux = '';
            $travaux_count = 1;
            foreach($project->ProjectTravaux as $item){
                $travaux .= $item->travaux .($travaux_count != $project->ProjectTravaux->count() ? ', ':'');
                $travaux_count++;
            }

            if($project->etiquette_automatise_recurrence_status == 1){
                $automatisation = Automatise::find($project->etiquette_automatise_id);
                if($automatisation && $automatisation->recurrence == 'Oui' && $project->etiquette_automatise_recurrence_start){
                    if($automatisation->fin > $project->etiquette_fin){
                        if(Carbon::now() > Carbon::parse($project->etiquette_automatise_recurrence_start)->addDays($automatisation->frequence)){
                            if(array_key_exists(Carbon::now()->format('l'), $stop_recurrence)){
                                $project->etiquette_automatise_recurrence_start = Carbon::parse($project->etiquette_automatise_recurrence_start)->addDays($stop_recurrence[Carbon::now()->format('l')]);
                                $project->save();
                                continue;
                            }
                            // $travaux = '';
                            // foreach($project->ProjectTravaux as $item){
                            //     $travaux .= $item->travaux ;
                            // }
                            if($automatisation->fin == ($project->etiquette_fin + 1)){
                                $project->etiquette_automatise_recurrence_status = 0;    
                                $project->etiquette_automatise_id = 0;     
                                $project->etiquette_fin = 0;    
                                $project->etiquette_automatise_recurrence_start = null;        
                            }else{
                                $project->etiquette_fin = $project->etiquette_fin + 1;    
                                $project->etiquette_automatise_recurrence_start = Carbon::now();
                            } 
                            if($automatisation->sending_type == 'send_email')
                            {
                                 $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                 $body = $template->body;
                                 $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                 $body = str_replace('{id_prospect}', ' ', $body);
                                 $body = str_replace('{titre}', $project->Titre, $body);
                                 $body = str_replace('{nom_client}', $project->Nom, $body);
                                 $body = str_replace('{prénom_client}', $project->Prenom, $body);
                                 $body = str_replace('{email_client}', $project->Email, $body);
                                 $body = str_replace('{téléphone_client}', $project->phone, $body);
                                 $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                                 $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                                 $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                                 $body = str_replace('{projet_travaux}', $travaux, $body);
                                 $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                                 $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                                 $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                                 $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                                 $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                                 $body = str_replace('{raison}', $project->project_ko_reason, $body);
     
                                 $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                                 if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                     $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                     $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                     $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                     if($intervention_technico_commercial->Date_intervention){
                                         $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                         $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                     }
                                     $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                                 }else{
                                     $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                     $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                     $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                     $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                     $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                 }
     
                                 $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                                 if($intervention_etude && $intervention_etude->getUser){
                                     $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                     $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                     $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                     if($intervention_etude->Date_intervention){
                                         $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                     }else{
                                         $body = str_replace('{etude_date_intervention}', ' ', $body);
                                     }
                                     $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                                 }else{
                                     $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                     $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                     $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                     $body = str_replace('{etude_date_intervention}', ' ', $body);
                                     $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                                 }
     
                                 $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                                 if($control_sur_site){
                                     if($control_sur_site->Date_de_contrôle){
                                         $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                     }else{
                                         $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                     }
                                     $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                                 }else{
                                     $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                     $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                                 }
     
                                 $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                                 if($intervention_installation){ 
                                     if($intervention_installation->Date_intervention){
                                         $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                     }else{
                                         $body = str_replace('{installation_date_intervention}', ' ', $body);
                                     }
                                     $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                                 }else{
                                      $body = str_replace('{installation_date_intervention}', ' ', $body);
                                     $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                 }
     
                                 $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                                 if($intervention_sav){ 
                                     if($intervention_sav->Date_intervention){
                                         $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                     }else{
                                         $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                     }
                                     $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                                 }else{
                                      $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                     $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                 }
     
     
                                 if($project->getProjectTelecommercial){
                                     $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                     $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                     $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                     if($project->getProjectTelecommercial->getRegie){
                                         $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                         $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                         $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                         $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                     }else{
                                         $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                         $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                         $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                         $body = str_replace('{regie}', ' ', $body);
                                     }
                                 }else{
                                     $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                     $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                     $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                     $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                     $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                     $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                     $body = str_replace('{regie}', ' ', $body);
                                 }   
     
                                 $subject = $template->object;
                                 if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                 {
                                    
                                     if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                     {
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to == 'Telecommercial'){
                                             $data["email"] = $project->getProjectTelecommercial->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($project->getProjectTelecommercial->email_professional){
                                                 $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
                                         
                                         // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                     }
     
                                 }
                                 if($automatisation->select_to == 'Client')
                                 {
                                         // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                         // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
     
                                         $data["email"] = $project->Email ?? $project->__tracking__Email;
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($data["email"]){
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }
     
                                         // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                 }
     
                                 if(($automatisation->select_to == 'Responsable commercial' || $automatisation->select_to == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                 { 
                                     
                                     $data["subject"] = $subject;
                                     $data["body"] = $body;
                                     if($template->file){
                                         $files = public_path('uploads/email-files').'/'.$template->file;
                                     }else{
                                         $files = '';
                                     }
                                     if($automatisation->select_to == 'Responsable commercial'){
                                         $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                         // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                         //     $message->to($data["email"])
                                         //             ->subject($data["subject"]);
                                 
                                         //     foreach ($files as $file){
                                         //         $message->attach($file);
                                         //     }            
                                         // });
                                         Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                     }else{
                                         if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                             $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }
                                     }
       
     
                                     // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                 }
     
                                 if(($automatisation->select_to == 'Chargé d’etude' || $automatisation->select_to == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                 { 
                                     $data["subject"] = $subject;
                                     $data["body"] = $body;
                                     if($template->file){
                                         $files = public_path('uploads/email-files').'/'.$template->file;
                                     }else{
                                         $files = '';
                                     }
                                     if($automatisation->select_to == 'Chargé d’etude'){
                                         $data["email"] = $intervention_etude->getUser->email;
                                         // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                         //     $message->to($data["email"])
                                         //             ->subject($data["subject"]);
                                 
                                         //     foreach ($files as $file){
                                         //         $message->attach($file);
                                         //     }            
                                         // });
                                         Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                     }else{
                                         if($intervention_etude->getUser->email_professional){
                                             $data["email"] = $intervention_etude->getUser->email_professional;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
     
                                         }
                                     }
       
     
                                     // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                 }
     
                                 if(($automatisation->select_to == 'Prévisiteur Technico-commercial' || $automatisation->select_to == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active') 
                                 { 
                                     
                                     $data["subject"] = $subject;
                                     $data["body"] = $body;
                                     if($template->file){
                                         $files = public_path('uploads/email-files').'/'.$template->file;
                                     }else{
                                         $files = '';
                                     }
                                     if($automatisation->select_to == 'Prévisiteur Technico-commercial'){
                                         $data["email"] = $intervention_technico_commercial->getUser->email;
                                         // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                         //     $message->to($data["email"])
                                         //             ->subject($data["subject"]);
                                 
                                         //     foreach ($files as $file){
                                         //         $message->attach($file);
                                         //     }            
                                         // });
                                         Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                     }else{
                                         if($intervention_technico_commercial->getUser->email_professional){
                                             $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }
     
                                     }
        
                                 }
     
                                 if(($automatisation->select_to == 'Gestionnaire' || $automatisation->select_to == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                 { 
                                     
                                     $data["subject"] = $subject;
                                     $data["body"] = $body;
                                     if($template->file){
                                         $files = public_path('uploads/email-files').'/'.$template->file;
                                     }else{
                                         $files = '';
                                     }
                             
                                     if($automatisation->select_to == 'Gestionnaire'){
                                         $data["email"] = $project->projectGestionnaire->email;
                                         // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                         //     $message->to($data["email"])
                                         //             ->subject($data["subject"]);
                                 
                                         //     foreach ($files as $file){
                                         //         $message->attach($file);
                                         //     }            
                                         // });
                                         Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                     }else{
                                         if($project->projectGestionnaire->email_professional){
                                             $data["email"] = $project->projectGestionnaire->email_professional;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
     
                                         }
                                     }
        
                                 }
     
                                 if($automatisation->select_to == 'Mail personnalisé')
                                 { 
                                     $data["email"] = $automatisation->custom_email;
                                     $data["subject"] = $subject;
                                     $data["body"] = $body;
                                     if($template->file){
                                         $files = public_path('uploads/email-files').'/'.$template->file;
                                     }else{
                                         $files = '';
                                     }
                                     if($data["email"]){
                                         // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                         //     $message->to($data["email"])
                                         //             ->subject($data["subject"]);
                                  
                                         //     foreach ($files as $file){
                                         //         $message->attach($file);
                                         //     }            
                                         // });
                                         Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                     }
                                     // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                 }
     
                                 if($automatisation->select_to_cc){
                                     if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                     {
                                     
                                         if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                         {
                                             
                                             $data["subject"] = $subject;
                                             $data["body"] = $body;
                                             if($template->file){
                                                 $files = public_path('uploads/email-files').'/'.$template->file;
                                             }else{
                                                 $files = '';
                                             }
                                     
                                             if($automatisation->select_to_cc == 'Telecommercial'){
                                                 $data["email"] = $project->getProjectTelecommercial->email;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }else{
                                                 if($project->getProjectTelecommercial->email_professional){
                                                     $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                     // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                     //     $message->to($data["email"])
                                                     //             ->subject($data["subject"]);
                                             
                                                     //     foreach ($files as $file){
                                                     //         $message->attach($file);
                                                     //     }            
                                                     // });
                                                     Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                 }
                                             }
                                             
                                             // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                         }
     
                                     }
                                     if($automatisation->select_to_cc == 'Client')
                                     {
                                             // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                             // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
     
                                             $data["email"] = $project->Email ?? $project->__tracking__Email;
                                             $data["subject"] = $subject;
                                             $data["body"] = $body;
                                             if($template->file){
                                                 $files = public_path('uploads/email-files').'/'.$template->file;
                                             }else{
                                                 $files = '';
                                             }
                                             if($data["email"]){
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
     
                                             // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
                                     if($automatisation->select_to_cc == 'Mail personnalisé')
                                     { 
                                        $data["email"] = $automatisation->custom_email_cc;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                     }
     
                                     if(($automatisation->select_to_cc == 'Responsable commercial' || $automatisation->select_to_cc == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                 
                                         if($automatisation->select_to_cc == 'Responsable commercial'){
                                             $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                 $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });                                        
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
     
                                         // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
     
                                     if(($automatisation->select_to_cc == 'Chargé d’etude' || $automatisation->select_to_cc == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cc == 'Chargé d’etude'){
                                             $data["email"] = $intervention_etude->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($intervention_etude->getUser->email_professional){
                                                 $data["email"] = $intervention_etude->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
     
                                         // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
     
                                     if(($automatisation->select_to_cc == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cc == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cc == 'Prévisiteur Technico-commercial'){
                                             $data["email"] = $intervention_technico_commercial->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($intervention_technico_commercial->getUser->email_professional){
                                                 $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
                                     }
     
                                     if(($automatisation->select_to_cc == 'Gestionnaire' || $automatisation->select_to_cc == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cc == 'Gestionnaire'){
                                             $data["email"] = $project->projectGestionnaire->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($project->projectGestionnaire->email_professional){
                                                 $data["email"] = $project->projectGestionnaire->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
                                     } 
                                 }
                                 if($automatisation->select_to_cci){
                                     if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                     {
                                     
                                         if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                         {
                                             
                                             $data["subject"] = $subject;
                                             $data["body"] = $body;
                                             if($template->file){
                                                 $files = public_path('uploads/email-files').'/'.$template->file;
                                             }else{
                                                 $files = '';
                                             }
                                             if($automatisation->select_to_cci == 'Telecommercial'){
                                                 $data["email"] = $project->getProjectTelecommercial->email;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }else{
                                                 if($project->getProjectTelecommercial->email_professional){
                                                     $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                     // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                     //     $message->to($data["email"])
                                                     //             ->subject($data["subject"]);
                                             
                                                     //     foreach ($files as $file){
                                                     //         $message->attach($file);
                                                     //     }            
                                                     // });
                                                     Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                 }
                                             }
                                             
                                             // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                         }
     
                                     }
                                     if($automatisation->select_to_cci == 'Client')
                                     {
                                             // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                             // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
     
                                             $data["email"] = $project->Email ?? $project->__tracking__Email;
                                             $data["subject"] = $subject;
                                             $data["body"] = $body;
                                             if($template->file){
                                                 $files = public_path('uploads/email-files').'/'.$template->file;
                                             }else{
                                                 $files = '';
                                             }
                                             if($data["email"]){
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
     
                                             // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
                                     if($automatisation->select_to_cci == 'Mail personnalisé')
                                     { 
                                        $data["email"] = $automatisation->custom_email_cci;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                     }
     
                                     if(($automatisation->select_to_cci == 'Responsable commercial' || $automatisation->select_to_cci == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cci == 'Responsable commercial'){
                                             $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                         }else{
                                             if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                 $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
     
                                         // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
     
                                     if(($automatisation->select_to_cci == 'Chargé d’etude' || $automatisation->select_to_cci == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cci == 'Chargé d’etude'){
                                             $data["email"] = $intervention_etude->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             
                                         }else{
                                             if($intervention_etude->getUser->email_professional){
                                                 $data["email"] = $intervention_etude->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
     
                                             }
     
                                         }
         
     
                                         // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                     }
     
                                     if(($automatisation->select_to_cci == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cci == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cci == 'Prévisiteur Technico-commercial'){
                                             $data["email"] = $intervention_technico_commercial->getUser->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
     
                                         }else{
                                             if($intervention_technico_commercial->getUser->email_professional){
                                                 $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // });  
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
                                         }
         
                                     }
     
                                     if(($automatisation->select_to_cci == 'Gestionnaire' || $automatisation->select_to_cci == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                     { 
                                         
                                         $data["subject"] = $subject;
                                         $data["body"] = $body;
                                         if($template->file){
                                             $files = public_path('uploads/email-files').'/'.$template->file;
                                         }else{
                                             $files = '';
                                         }
                                         if($automatisation->select_to_cci == 'Gestionnaire'){
                                             $data["email"] = $project->projectGestionnaire->email;
                                             // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                             //     $message->to($data["email"])
                                             //             ->subject($data["subject"]);
                                     
                                             //     foreach ($files as $file){
                                             //         $message->attach($file);
                                             //     }            
                                             // });
                                             Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             
                                         }else{
                                             if($project->projectGestionnaire->email_professional){
                                                 $data["email"] = $project->projectGestionnaire->email_professional;
                                                 // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                 //     $message->to($data["email"])
                                                 //             ->subject($data["subject"]);
                                         
                                                 //     foreach ($files as $file){
                                                 //         $message->attach($file);
                                                 //     }            
                                                 // }); 
                                                 Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                             }
     
                                         }
         
                                     } 
                                 }
                            }
                            else
                            {
     
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
                                $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                $body = str_replace('{id_prospect}', ' ', $body);
                                $body = str_replace('{titre}', $project->Titre, $body);
                                $body = str_replace('{nom_client}', $project->Nom, $body);
                                $body = str_replace('{prénom_client}', $project->Prenom, $body);
                                $body = str_replace('{email_client}', $project->Email, $body);
                                $body = str_replace('{téléphone_client}', $project->phone, $body);
                                $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                                $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                                $body = str_replace('{raison}', $project->project_ko_reason, $body);
                                
                                $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                                if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_technico_commercial->Date_intervention){
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                                if($intervention_etude && $intervention_etude->getUser){
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_etude->Date_intervention){
                                        $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                                }
        
                                $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                                if($control_sur_site){
                                    if($control_sur_site->Date_de_contrôle){
                                        $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    }
                                    $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                                if($intervention_installation){
                                    if($intervention_installation->Date_intervention){
                                        $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                                if($intervention_sav){
                                    if($intervention_sav->Date_intervention){
                                        $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                }
        
                                if($project->getProjectTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                    if($project->getProjectTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
        
                                $subject = $template->name;
                                if($automatisation->select_to == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
        
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    {
                                        
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $project->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                        
                                        }
            
                                    }
                                
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    {
                                        
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $project->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                        
                                        }
            
                                    }
                                
                                }
                             
                             
                            }
                        }
                        
                    }else{
                        $project->etiquette_automatise_recurrence_status = 0;    
                        $project->etiquette_automatise_id = 0;    
                        $project->etiquette_fin = 0;    
                        $project->etiquette_automatise_recurrence_start = null;    
                    }
                }else{
                    $project->etiquette_automatise_recurrence_status = 0;
                    $project->etiquette_automatise_id = 0; 
                    $project->etiquette_fin = 0;
                    $project->etiquette_automatise_recurrence_start = null;
                }
            }
            if($project->statut_automatise_recurrence_status == 1){
                $automatisation = Automatise::find($project->statut_automatise_id);
                if($automatisation && $automatisation->recurrence == 'Oui' && $project->statut_automatise_recurrence_start){
                    if($automatisation->fin > $project->statut_fin){
                        if(Carbon::now() > Carbon::parse($project->statut_automatise_recurrence_start)->addDays($automatisation->frequence)){
                            if(array_key_exists(Carbon::now()->format('l'), $stop_recurrence)){
                                $project->statut_automatise_recurrence_start = Carbon::parse($project->statut_automatise_recurrence_start)->addDays($stop_recurrence[Carbon::now()->format('l')]);
                                $project->save();
                                continue;
                            }
                            if($automatisation->fin == ($project->statut_fin + 1)){
                                $project->statut_automatise_recurrence_status = 0;    
                                $project->statut_automatise_id = 0;     
                                $project->statut_fin = 0;    
                                $project->statut_automatise_recurrence_start = null;        
                            }else{
                                $project->statut_fin = $project->statut_fin + 1;    
                                $project->statut_automatise_recurrence_start = Carbon::now();
                            } 
                            if($automatisation->sending_type == 'send_email')
                            {
                                $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                $body = $template->body;
                                $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                $body = str_replace('{id_prospect}', ' ', $body);
                                $body = str_replace('{titre}', $project->Titre, $body);
                                $body = str_replace('{nom_client}', $project->Nom, $body);
                                $body = str_replace('{prénom_client}', $project->Prenom, $body);
                                $body = str_replace('{email_client}', $project->Email, $body);
                                $body = str_replace('{téléphone_client}', $project->phone, $body);
                                $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                                $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                                $body = str_replace('{raison}', $project->project_ko_reason, $body);
                                
                                $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                                if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_technico_commercial->Date_intervention){
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                   }else{
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                                if($intervention_etude && $intervention_etude->getUser){
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_etude->Date_intervention){
                                        $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                                }
    
                                $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                                if($control_sur_site){
                                    if($control_sur_site->Date_de_contrôle){
                                        $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    }
                                    $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                                if($intervention_installation){
                                    if($intervention_installation->Date_intervention){
                                        $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                                }else{
                                     $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                                if($intervention_sav){
                                    if($intervention_sav->Date_intervention){
                                        $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                                }else{
                                     $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                }
    
                                if($project->getProjectTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                    if($project->getProjectTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $subject = $template->object;
                                if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                {
                                    if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                    {
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to == 'Telecommercial'){
                                            $data["email"] = $project->getProjectTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->getProjectTelecommercial->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
    
                                        }
    
                                        // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                }
                                if($automatisation->select_to == 'Client')
                                {
                                    $data["email"] = $project->Email ?? $project->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
    
                                }
    
                                if(($automatisation->select_to == 'Responsable commercial' || $automatisation->select_to == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Responsable commercial'){
                                        $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        
                                    }else{
                                        if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }
    
                                    }
    
      
    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if(($automatisation->select_to == 'Chargé d’etude' || $automatisation->select_to == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Chargé d’etude'){
                                        $data["email"] = $intervention_etude->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        
                                    }else{
                                        if($intervention_etude->getUser->email_professional){
                                            $data["email"] = $intervention_etude->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    }
      
    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if(($automatisation->select_to == 'Prévisiteur Technico-commercial' || $automatisation->select_to == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Prévisiteur Technico-commercial'){
                                        $data["email"] = $intervention_technico_commercial->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        
                                    }else{
                                        if($intervention_technico_commercial->getUser->email_professional){
                                            $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
    
                                    }
       
                                }
    
                                if(($automatisation->select_to == 'Gestionnaire' || $automatisation->select_to == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Gestionnaire'){
                                        $data["email"] = $project->projectGestionnaire->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        
                                    }else{
                                        if($project->projectGestionnaire->email_professional){
                                            $data["email"] = $project->projectGestionnaire->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }
                                        
                                    }
       
                                }
    
    
                                if($automatisation->select_to == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                 
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                    {
                                        if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                        {
                                           
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cc == 'Telecommercial'){
                                                $data["email"] = $project->getProjectTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
    
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($project->getProjectTelecommercial->email_professional){
                                                    $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });  
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                                }
                                            }
    
                                            // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
    
                                    }
                                    if($automatisation->select_to_cc == 'Client')
                                    {
                                        $data["email"] = $project->Email ?? $project->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
    
                                    }
                                    if($automatisation->select_to_cc == 'Mail personnalisé')
                                    {
                                        $data["email"] = $automatisation->custom_email_cc;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
    
                                    }
    
                                    if(($automatisation->select_to_cc == 'Responsable commercial' || $automatisation->select_to_cc == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Responsable commercial'){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cc == 'Chargé d’etude' || $automatisation->select_to_cc == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                    { 
                                        $data["email"] = $intervention_etude->getUser->email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Chargé d’etude'){
                                            $data["email"] = $intervention_etude->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($intervention_etude->getUser->email_professional){
                                                $data["email"] = $intervention_etude->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cc == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cc == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Prévisiteur Technico-commercial'){
                                            $data["email"] = $intervention_technico_commercial->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($intervention_technico_commercial->getUser->email_professional){
                                                $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
                                    }
    
                                    if(($automatisation->select_to_cc == 'Gestionnaire' || $automatisation->select_to_cc == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Gestionnaire'){
                                            $data["email"] = $project->projectGestionnaire->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($project->projectGestionnaire->email_professional){
                                                $data["email"] = $project->projectGestionnaire->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
    
                                        }
        
                                    } 
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                    {
                                        if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                        {
                                            
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cci == 'Telecommercial'){
                                                $data["email"] = $project->getProjectTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }else{
                                                if($project->getProjectTelecommercial->email_professional){
                                                    $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                                }
                                            }
    
                                            // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
    
                                    }
                                    if($automatisation->select_to_cci == 'Client')
                                    {
                                        $data["email"] = $project->Email ?? $project->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
    
                                    }
                                    if($automatisation->select_to_cci == 'Mail personnalisé')
                                    {
                                        $data["email"] = $automatisation->custom_email_cci;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){ 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
    
                                    }
    
                                    if(($automatisation->select_to_cci == 'Responsable commercial' || $automatisation->select_to_cci == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                
                                        if($automatisation->select_to_cci == 'Responsable commercial'){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cci == 'Chargé d’etude' || $automatisation->select_to_cci == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Chargé d’etude'){
                                            $data["email"] = $intervention_etude->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($intervention_etude->getUser->email_professional){
                                                $data["email"] = $intervention_etude->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cci == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cci == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Prévisiteur Technico-commercial'){
                                            $data["email"] = $intervention_technico_commercial->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });                                     
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($intervention_technico_commercial->getUser->email_professional){
                                                $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });                                     
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
    
                                        }
        
                                    }
    
                                    if(($automatisation->select_to_cci == 'Gestionnaire' || $automatisation->select_to_cci == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Gestionnaire'){
                                            $data["email"] = $project->projectGestionnaire->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($project->projectGestionnaire->email_professional){
                                                $data["email"] = $project->projectGestionnaire->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
                                        }
        
                                    } 
                                }
                            }
                            else
                            {
     
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
                                $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                $body = str_replace('{id_prospect}', ' ', $body);
                                $body = str_replace('{titre}', $project->Titre, $body);
                                $body = str_replace('{nom_client}', $project->Nom, $body);
                                $body = str_replace('{prénom_client}', $project->Prenom, $body);
                                $body = str_replace('{email_client}', $project->Email, $body);
                                $body = str_replace('{téléphone_client}', $project->phone, $body);
                                $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                                $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                                $body = str_replace('{raison}', $project->project_ko_reason, $body);
                                
                                $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                                if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_technico_commercial->Date_intervention){
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                                if($intervention_etude && $intervention_etude->getUser){
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_etude->Date_intervention){
                                        $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                                }
        
                                $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                                if($control_sur_site){
                                    if($control_sur_site->Date_de_contrôle){
                                        $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    }
                                    $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                                if($intervention_installation){
                                    if($intervention_installation->Date_intervention){
                                        $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                }
        
                                $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                                if($intervention_sav){
                                    if($intervention_sav->Date_intervention){
                                        $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                }
        
                                if($project->getProjectTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                    if($project->getProjectTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $subject = $template->name;
                                if($automatisation->select_to == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    {
                                        
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $project->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    {
                                        
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $project->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                            }
                        }
                        
                    }else{
                        $project->statut_automatise_recurrence_status = 0;    
                        $project->statut_automatise_id = 0;    
                        $project->statut_fin = 0;    
                        $project->statut_automatise_recurrence_start = null;    
                    }
                }else{
                    $project->statut_automatise_recurrence_status = 0;
                    $project->statut_automatise_id = 0; 
                    $project->statut_fin = 0;
                    $project->statut_automatise_recurrence_start = null;
                }
            } 
            $project->save();
        }
        foreach($second_table_projects as $project){
            $second_table_project = $project->projectSecondTable;
            if(!$second_table_project){
                continue;
            }
            $travaux = '';
            $travaux_count = 1;
            foreach($project->ProjectTravaux as $item){
                $travaux .= $item->travaux .($travaux_count != $project->ProjectTravaux->count() ? ', ':'');
                $travaux_count++;
            }

            if($second_table_project->etiquette_automatise_not_change == 1){
                $automatisation = Automatise::find($second_table_project->etiquette_automatise_not_change_id);
                if($automatisation && $automatisation->duration && $second_table_project->etiquette_automatise_not_change_start){ 
                    if(Carbon::now() > Carbon::parse($second_table_project->etiquette_automatise_not_change_start)->addDays($automatisation->duration)){
                        $second_table_project->update([
                            'etiquette_automatise_not_change' => 0,
                            'etiquette_automatise_not_change_id' => null,
                            'etiquette_automatise_not_change_start' => null,
                       ]);      
                         
                        if($automatisation->sending_type == 'send_email')
                        {
                                $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                $body = $template->body;
                                $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                $body = str_replace('{id_prospect}', ' ', $body);
                                $body = str_replace('{titre}', $project->Titre, $body);
                                $body = str_replace('{nom_client}', $project->Nom, $body);
                                $body = str_replace('{prénom_client}', $project->Prenom, $body);
                                $body = str_replace('{email_client}', $project->Email, $body);
                                $body = str_replace('{téléphone_client}', $project->phone, $body);
                                $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                                $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                                $body = str_replace('{raison}', $project->project_ko_reason, $body);
    
                                $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                                if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_technico_commercial->Date_intervention){
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                                if($intervention_etude && $intervention_etude->getUser){
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                    if($intervention_etude->Date_intervention){
                                        $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                                }
    
                                $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                                if($control_sur_site){
                                    if($control_sur_site->Date_de_contrôle){
                                        $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    }
                                    $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                                if($intervention_installation){ 
                                    if($intervention_installation->Date_intervention){
                                        $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                }
    
                                $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                                if($intervention_sav){ 
                                    if($intervention_sav->Date_intervention){
                                        $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                    }else{
                                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    }
                                    $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                }
    
    
                                if($project->getProjectTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                    if($project->getProjectTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }   
    
                                $subject = $template->object;
                                if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                {
                                
                                    if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                    {
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to == 'Telecommercial'){
                                            $data["email"] = $project->getProjectTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->getProjectTelecommercial->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                        
                                        // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                }
                                if($automatisation->select_to == 'Client')
                                {
                                        // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                        // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
    
                                        $data["email"] = $project->Email ?? $project->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if(($automatisation->select_to == 'Responsable commercial' || $automatisation->select_to == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Responsable commercial'){
                                        $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    }
    
    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if(($automatisation->select_to == 'Chargé d’etude' || $automatisation->select_to == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                { 
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Chargé d’etude'){
                                        $data["email"] = $intervention_etude->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($intervention_etude->getUser->email_professional){
                                            $data["email"] = $intervention_etude->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }
                                    }
    
    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if(($automatisation->select_to == 'Prévisiteur Technico-commercial' || $automatisation->select_to == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active') 
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Prévisiteur Technico-commercial'){
                                        $data["email"] = $intervention_technico_commercial->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($intervention_technico_commercial->getUser->email_professional){
                                            $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
    
                                    }
    
                                }
    
                                if(($automatisation->select_to == 'Gestionnaire' || $automatisation->select_to == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                            
                                    if($automatisation->select_to == 'Gestionnaire'){
                                        $data["email"] = $project->projectGestionnaire->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($project->projectGestionnaire->email_professional){
                                            $data["email"] = $project->projectGestionnaire->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }
                                    }
    
                                }
    
                                if($automatisation->select_to == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                }
    
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                    {
                                    
                                        if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                        {
                                            
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                    
                                            if($automatisation->select_to_cc == 'Telecommercial'){
                                                $data["email"] = $project->getProjectTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($project->getProjectTelecommercial->email_professional){
                                                    $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }
                                            }
                                            
                                            // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
    
                                    }
                                    if($automatisation->select_to_cc == 'Client')
                                    {
                                            // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                            // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
    
                                            $data["email"] = $project->Email ?? $project->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
    
                                            // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
                                    if($automatisation->select_to_cc == 'Mail personnalisé')
                                    { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    } 
                                    }
    
                                    if(($automatisation->select_to_cc == 'Responsable commercial' || $automatisation->select_to_cc == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                
                                        if($automatisation->select_to_cc == 'Responsable commercial'){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });                                        
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cc == 'Chargé d’etude' || $automatisation->select_to_cc == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Chargé d’etude'){
                                            $data["email"] = $intervention_etude->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($intervention_etude->getUser->email_professional){
                                                $data["email"] = $intervention_etude->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cc == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cc == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Prévisiteur Technico-commercial'){
                                            $data["email"] = $intervention_technico_commercial->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($intervention_technico_commercial->getUser->email_professional){
                                                $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
                                    }
    
                                    if(($automatisation->select_to_cc == 'Gestionnaire' || $automatisation->select_to_cc == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Gestionnaire'){
                                            $data["email"] = $project->projectGestionnaire->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->projectGestionnaire->email_professional){
                                                $data["email"] = $project->projectGestionnaire->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
                                    } 
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                    {
                                    
                                        if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                        {
                                            
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($automatisation->select_to_cci == 'Telecommercial'){
                                                $data["email"] = $project->getProjectTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($project->getProjectTelecommercial->email_professional){
                                                    $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }
                                            }
                                            
                                            // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
    
                                    }
                                    if($automatisation->select_to_cci == 'Client')
                                    {
                                            // $body = str_replace('{assignee_name}', $project->getProjectTelecommercial->name, $body);
                                            // $body = str_replace('{client_name}', $project->Prenom . ' ' . $project->Nom, $body);
    
                                            $data["email"] = $project->Email ?? $project->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
    
                                            // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
                                    if($automatisation->select_to_cci == 'Mail personnalisé')
                                    { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    } 
                                    }
    
                                    if(($automatisation->select_to_cci == 'Responsable commercial' || $automatisation->select_to_cci == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Responsable commercial'){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cci == 'Chargé d’etude' || $automatisation->select_to_cci == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Chargé d’etude'){
                                            $data["email"] = $intervention_etude->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            
                                        }else{
                                            if($intervention_etude->getUser->email_professional){
                                                $data["email"] = $intervention_etude->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                            }
    
                                        }
        
    
                                        // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                    }
    
                                    if(($automatisation->select_to_cci == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cci == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Prévisiteur Technico-commercial'){
                                            $data["email"] = $intervention_technico_commercial->getUser->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
    
                                        }else{
                                            if($intervention_technico_commercial->getUser->email_professional){
                                                $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });  
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
        
                                    }
    
                                    if(($automatisation->select_to_cci == 'Gestionnaire' || $automatisation->select_to_cci == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                    { 
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Gestionnaire'){
                                            $data["email"] = $project->projectGestionnaire->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            
                                        }else{
                                            if($project->projectGestionnaire->email_professional){
                                                $data["email"] = $project->projectGestionnaire->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
    
                                        }
        
                                    } 
                                }
                        }
                        else
                        {
    
                            $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                            $body = $template->body;
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{id_prospect}', ' ', $body);
                            $body = str_replace('{titre}', $project->Titre, $body);
                            $body = str_replace('{nom_client}', $project->Nom, $body);
                            $body = str_replace('{prénom_client}', $project->Prenom, $body);
                            $body = str_replace('{email_client}', $project->Email, $body);
                            $body = str_replace('{téléphone_client}', $project->phone, $body);
                            $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                            $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                            $body = str_replace('{raison}', $project->project_ko_reason, $body);
                            
                            $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                            if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                if($intervention_technico_commercial->Date_intervention){
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                            if($intervention_etude && $intervention_etude->getUser){
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                if($intervention_etude->Date_intervention){
                                    $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                            }
    
                            $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                            if($control_sur_site){
                                if($control_sur_site->Date_de_contrôle){
                                    $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                }
                                $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                            if($intervention_installation){
                                if($intervention_installation->Date_intervention){
                                    $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                            if($intervention_sav){
                                if($intervention_sav->Date_intervention){
                                    $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            }
    
                            if($project->getProjectTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                if($project->getProjectTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
    
                            $subject = $template->name;
                            if($automatisation->select_to == 'Client')
                            {
                                
                            
                                try {
    
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                        
                                    $receiverNumber = $project->phone;
                                    $message = $body;
                        
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                        
                                    
                                    
                                } catch (Exception $e) {
                                    
                                }
    
                            }
    
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                    
                                    }
        
                                }
                            
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                    
                                    }
        
                                }
                            
                            }
                            
                            
                        }
                    }     
                }else{
                    $second_table_project->update([
                        'etiquette_automatise_not_change' => 0,
                        'etiquette_automatise_not_change_id' => null,
                        'etiquette_automatise_not_change_start' => null,
                   ]);
                }
            }
            if($second_table_project->statut_automatise_not_change == 1){
                $automatisation = Automatise::find($second_table_project->statut_automatise_not_change_id);
                if($automatisation && $automatisation->duration && $second_table_project->statut_automatise_not_change_start){ 
                    if(Carbon::now() > Carbon::parse($second_table_project->statut_automatise_not_change_start)->addDays($automatisation->duration)){
                        $second_table_project->update([
                            'statut_automatise_not_change' => 0,
                            'statut_automatise_not_change_id' => null,
                            'statut_automatise_not_change_start' => null,
                       ]); 
                       
                        if($automatisation->sending_type == 'send_email')
                        {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            $body = $template->body;
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{id_prospect}', ' ', $body);
                            $body = str_replace('{titre}', $project->Titre, $body);
                            $body = str_replace('{nom_client}', $project->Nom, $body);
                            $body = str_replace('{prénom_client}', $project->Prenom, $body);
                            $body = str_replace('{email_client}', $project->Email, $body);
                            $body = str_replace('{téléphone_client}', $project->phone, $body);
                            $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                            $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                            $body = str_replace('{raison}', $project->project_ko_reason, $body);
                            
                            $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                            if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                if($intervention_technico_commercial->Date_intervention){
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            }

                            $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                            if($intervention_etude && $intervention_etude->getUser){
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                if($intervention_etude->Date_intervention){
                                    $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                            }

                            $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                            if($control_sur_site){
                                if($control_sur_site->Date_de_contrôle){
                                    $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                }
                                $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                            }

                            $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                            if($intervention_installation){
                                if($intervention_installation->Date_intervention){
                                    $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                            }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            }

                            $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                            if($intervention_sav){
                                if($intervention_sav->Date_intervention){
                                    $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                            }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            }

                            if($project->getProjectTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                if($project->getProjectTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            $subject = $template->object;
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                                if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                {
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $project->getProjectTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($project->getProjectTelecommercial->email_professional){
                                            $data["email"] = $project->getProjectTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }

                                    }

                                    // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            {
                                $data["email"] = $project->Email ?? $project->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                            
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                
                                // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));

                            }

                            if(($automatisation->select_to == 'Responsable commercial' || $automatisation->select_to == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                            { 
                                
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($automatisation->select_to == 'Responsable commercial'){
                                    $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                            
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    
                                }else{
                                    if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                        $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }

                                }

    

                                // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if(($automatisation->select_to == 'Chargé d’etude' || $automatisation->select_to == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                            { 
                                
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($automatisation->select_to == 'Chargé d’etude'){
                                    $data["email"] = $intervention_etude->getUser->email;
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                            
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    
                                }else{
                                    if($intervention_etude->getUser->email_professional){
                                        $data["email"] = $intervention_etude->getUser->email_professional;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                }
    

                                // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if(($automatisation->select_to == 'Prévisiteur Technico-commercial' || $automatisation->select_to == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                            { 
                                
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($automatisation->select_to == 'Prévisiteur Technico-commercial'){
                                    $data["email"] = $intervention_technico_commercial->getUser->email;
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                            
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    
                                }else{
                                    if($intervention_technico_commercial->getUser->email_professional){
                                        $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }

                                }
    
                            }

                            if(($automatisation->select_to == 'Gestionnaire' || $automatisation->select_to == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                            { 
                                
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($automatisation->select_to == 'Gestionnaire'){
                                    $data["email"] = $project->projectGestionnaire->email;
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                            
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    
                                }else{
                                    if($project->projectGestionnaire->email_professional){
                                        $data["email"] = $project->projectGestionnaire->email_professional;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }
                                    
                                }
    
                            }


                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                    if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                    {
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $project->getProjectTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });

                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($project->getProjectTelecommercial->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });  
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                            }
                                        }

                                        // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }

                                }
                                if($automatisation->select_to_cc == 'Client')
                                {
                                    $data["email"] = $project->Email ?? $project->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));

                                }
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                {
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    } 

                                }

                                if(($automatisation->select_to_cc == 'Responsable commercial' || $automatisation->select_to_cc == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cc == 'Responsable commercial'){
                                        $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }
                                    }
    

                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }

                                if(($automatisation->select_to_cc == 'Chargé d’etude' || $automatisation->select_to_cc == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                { 
                                    $data["email"] = $intervention_etude->getUser->email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cc == 'Chargé d’etude'){
                                        $data["email"] = $intervention_etude->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($intervention_etude->getUser->email_professional){
                                            $data["email"] = $intervention_etude->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }
                                    }
    

                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }

                                if(($automatisation->select_to_cc == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cc == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cc == 'Prévisiteur Technico-commercial'){
                                        $data["email"] = $intervention_technico_commercial->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($intervention_technico_commercial->getUser->email_professional){
                                            $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    }
    
                                }

                                if(($automatisation->select_to_cc == 'Gestionnaire' || $automatisation->select_to_cc == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cc == 'Gestionnaire'){
                                        $data["email"] = $project->projectGestionnaire->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($project->projectGestionnaire->email_professional){
                                            $data["email"] = $project->projectGestionnaire->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }

                                    }
    
                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                    if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active')
                                    {
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $project->getProjectTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }else{
                                            if($project->getProjectTelecommercial->email_professional){
                                                $data["email"] = $project->getProjectTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                            }
                                        }

                                        // Mail::to($project->getProjectTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }

                                }
                                if($automatisation->select_to_cci == 'Client')
                                {
                                    $data["email"] = $project->Email ?? $project->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                    
                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));

                                }
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                {
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    } 

                                }

                                if(($automatisation->select_to_cci == 'Responsable commercial' || $automatisation->select_to_cci == 'Responsable commercial - professionnel') && $project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie && $project->getProjectTelecommercial->getRegie->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                            
                                    if($automatisation->select_to_cci == 'Responsable commercial'){
                                        $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($project->getProjectTelecommercial->getRegie->getUser->email_professional){
                                            $data["email"] = $project->getProjectTelecommercial->getRegie->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }
                                    }
    

                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }

                                if(($automatisation->select_to_cci == 'Chargé d’etude' || $automatisation->select_to_cci == 'Chargé d’etude - professionnel') && $intervention_etude && $intervention_etude->getUser && $intervention_etude->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cci == 'Chargé d’etude'){
                                        $data["email"] = $intervention_etude->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($intervention_etude->getUser->email_professional){
                                            $data["email"] = $intervention_etude->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }
                                    }
    

                                    // Mail::to($project->Email)->send(new AutomatisationMail($body, $subject));
                                }

                                if(($automatisation->select_to_cci == 'Prévisiteur Technico-commercial' || $automatisation->select_to_cci == 'Prévisiteur Technico-commercial - professionnel') && $intervention_technico_commercial && $intervention_technico_commercial->getUser && $intervention_technico_commercial->getUser->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cci == 'Prévisiteur Technico-commercial'){
                                        $data["email"] = $intervention_technico_commercial->getUser->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });                                     
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($intervention_technico_commercial->getUser->email_professional){
                                            $data["email"] = $intervention_technico_commercial->getUser->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });                                     
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }

                                    }
    
                                }

                                if(($automatisation->select_to_cci == 'Gestionnaire' || $automatisation->select_to_cci == 'Gestionnaire - professionnel') && $project->projectGestionnaire && $project->projectGestionnaire->status == 'active')
                                { 
                                    
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($automatisation->select_to_cci == 'Gestionnaire'){
                                        $data["email"] = $project->projectGestionnaire->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                    }else{
                                        if($project->projectGestionnaire->email_professional){
                                            $data["email"] = $project->projectGestionnaire->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));

                                        }
                                    }
    
                                } 
                            }
                        }
                        else
                        {
    
                            $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                            $body = $template->body;
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{id_prospect}', ' ', $body);
                            $body = str_replace('{titre}', $project->Titre, $body);
                            $body = str_replace('{nom_client}', $project->Nom, $body);
                            $body = str_replace('{prénom_client}', $project->Prenom, $body);
                            $body = str_replace('{email_client}', $project->Email, $body);
                            $body = str_replace('{téléphone_client}', $project->phone, $body);
                            $body = str_replace('{adresse_des_travaux}', $project->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $project->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $project->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', $project->Statut_Projet, $body);
                            $body = str_replace('{faisabilité_du_projet}', $project->Faisabilité_du_projet, $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', $project->projectGestionnaire->prenom_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', $project->projectGestionnaire->email_professional ?? ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', $project->projectGestionnaire->phone_professional ?? ' ', $body);
                            $body = str_replace('{raison}', $project->project_ko_reason, $body);
                            
                            $intervention_technico_commercial = ProjectIntervention::where('project_id', $project->id)->where('type', 'Pré-Visite Technico-Commercial')->orderBy('created_at', 'desc')->first();
                            if($intervention_technico_commercial && $intervention_technico_commercial->getUser){
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', $intervention_technico_commercial->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', $intervention_technico_commercial->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', $intervention_technico_commercial->getUser->phone_professional ?? ' ', $body);
                                if($intervention_technico_commercial->Date_intervention){
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', Carbon::parse($intervention_technico_commercial->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', $intervention_technico_commercial->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_etude = ProjectIntervention::where('project_id', $project->id)->where('type', 'Etude')->orderBy('created_at', 'desc')->first();
                            if($intervention_etude && $intervention_etude->getUser){
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', $intervention_etude->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', $intervention_etude->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', $intervention_etude->getUser->phone_professional ?? ' ', $body);
                                if($intervention_etude->Date_intervention){
                                    $body = str_replace('{etude_date_intervention}', Carbon::parse($intervention_etude->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{etude_horaire_intervention}', $intervention_etude->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body);
                            }
    
                            $control_sur_site = ControleSurSite::where('project_id', $project->id)->where('type', 'COFRAC')->orderBy('id', 'desc')->first();
                            if($control_sur_site){
                                if($control_sur_site->Date_de_contrôle){
                                    $body = str_replace('{cofrac_date_de_contrôle}', Carbon::parse($control_sur_site->Date_de_contrôle)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                }
                                $body = str_replace('{cofrac_horaire_intervention}', $control_sur_site->horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body);
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_installation = ProjectIntervention::where('project_id', $project->id)->where('type', 'Installation')->orderBy('created_at', 'desc')->first();
                            if($intervention_installation){
                                if($intervention_installation->Date_intervention){
                                    $body = str_replace('{installation_date_intervention}', Carbon::parse($intervention_installation->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{installation_horaire_intervention}', $intervention_installation->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            }
    
                            $intervention_sav = ProjectIntervention::where('project_id', $project->id)->where('type', 'SAV')->orderBy('created_at', 'desc')->first();
                            if($intervention_sav){
                                if($intervention_sav->Date_intervention){
                                    $body = str_replace('{SAV_date_intervention}', Carbon::parse($intervention_sav->Date_intervention)->format('d/m/Y'), $body);
                                }else{
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                }
                                $body = str_replace('{SAV_horaire_intervention}', $intervention_sav->Horaire_intervention ?? ' ', $body);
                            }else{
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            }
    
                            if($project->getProjectTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $project->getProjectTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $project->getProjectTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $project->getProjectTelecommercial->phone_professional ?? ' ', $body);
                                if($project->getProjectTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $project->getProjectTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $project->getProjectTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            $subject = $template->name;
                            if($automatisation->select_to == 'Client')
                            {
                                
                            
                                try {
    
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                        
                                    $receiverNumber = $project->phone;
                                    $message = $body;
                        
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                        
                                    
                                    
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Client')
                                {
                                    
                                
                                    try {
        
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                            
                                        $receiverNumber = $project->phone;
                                        $message = $body;
                            
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                            
                                        
                                        
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
                            }
                        }
                    }
                }else{
                    $second_table_project->update([
                        'statut_automatise_not_change' => 0,
                        'statut_automatise_not_change_id' => null,
                        'statut_automatise_not_change_start' => null,
                   ]);
                }
            }  
        }
    }
}
