<?php

namespace App\Console\Commands;

use App\Mail\SubventionStatusMail;
use App\Models\CRM\NewProject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DailyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subvention Alert Mail';

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
        $projects = NewProject::where('deleted_status', 0)->get();
        foreach($projects as $project){
            $interventions = $project->getIntervention->where('type', 'Installation')->first();
            if($interventions && $interventions->Statut_Installation == 'Terminé'){
                continue;
            }else{
                $subvention  = $project->getSubventions->where('Statut_subvention', 'yes')->first();
                if($subvention && $subvention->Statut_subvention == 'yes' && $subvention->Date_forclusion){ 
                    
                    if(Carbon::now()->addDays(15) >= Carbon::parse($subvention->Date_forclusion) && $subvention->Statut_subvention_yes_15_days_before_mail_status == 0){
                        $client_name = $project->Prenom ?? '';
                        $subject = 'Délai de forclusion arrive à échéance '.$client_name; 
                        $amount = $subvention->montant_subvention_accorde;
                        $date = $subvention->subvention_accorde_le ? Carbon::parse($subvention->subvention_accorde_le)->format('d-m-Y'):'';
                        $date_forclusion = $subvention->Date_forclusion ? Carbon::parse($subvention->Date_forclusion)->format('d-m-Y'):'';
                        $travaux = '';
                        
                        foreach($project->ProjectBareme as $key => $value){
                            $travaux .= $value->travaux . ($project->ProjectBareme->count() == $key +1 ? '':', '); 
                        }
                        $department = getDepartment($project->Code_Postal); 
                        $mail_body = "<p  style='font-size:18px margin-top:10px'>
                                        Bonjour,
                                    </p>
                                    <table>
                                        <tr>
                                            <td colspan='2'>La subvention de $client_name arrive à forclusion.
                                            </td> 
                                        </tr> 
                                        <tr>
                                            <td>Montant subvention accordé</td>
                                            <td>: €$amount</td>
                                        </tr>
                                        <tr>
                                            <td>Subvention accordé le</td>
                                            <td>: $date</td>
                                        </tr>
                                        <tr>
                                            <td>Date forclusion</td>
                                            <td>: $date_forclusion</td>
                                        </tr>
                                        <tr>
                                            <td>Travaux</td>
                                            <td>: $travaux</td>
                                        </tr>
                                        <tr>
                                            <td>Département</td>
                                            <td>: $department</td>
                                        </tr>
                                    </table>";  
                        if($project->projectGestionnaire && $project->projectGestionnaire->status == 'active' && $project->projectGestionnaire->email_professional){
                            Mail::to($project->projectGestionnaire->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                        } 
                        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [10,11,12,13,14])->get();
                        foreach($users as $user){
                            if($user->email_professional && $user->status == 'active'){
                                Mail::to($user->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                            }
                        }
                        $subvention->Statut_subvention_yes_15_days_before_mail_status = 1;
                        $subvention->save();
                    }elseif(Carbon::now()->addDays(30) >= Carbon::parse($subvention->Date_forclusion) && $subvention->Statut_subvention_yes_1_month_before_mail_status == 0){
                        $client_name = $project->Prenom ?? '';
                        $subject = 'Délai de forclusion arrive à échéance '.$client_name; 
                        $amount = $subvention->montant_subvention_accorde;
                        $date = $subvention->subvention_accorde_le ? Carbon::parse($subvention->subvention_accorde_le)->format('d-m-Y'):'';
                        $date_forclusion = $subvention->Date_forclusion ? Carbon::parse($subvention->Date_forclusion)->format('d-m-Y'):'';
                        $travaux = '';
                        
                        foreach($project->ProjectBareme as $key => $value){
                            $travaux .= $value->travaux . ($project->ProjectBareme->count() == $key +1 ? '':', '); 
                        }
                        $department = getDepartment($project->Code_Postal); 
                        $mail_body = "<p  style='font-size:18px margin-top:10px'>
                                        Bonjour,
                                    </p>
                                    <table>
                                        <tr>
                                            <td colspan='2'>La subvention de $client_name arrive à forclusion.
                                            </td> 
                                        </tr> 
                                        <tr>
                                            <td>Montant subvention accordé</td>
                                            <td>: €$amount</td>
                                        </tr>
                                        <tr>
                                            <td>Subvention accordé le</td>
                                            <td>: $date</td>
                                        </tr>
                                        <tr>
                                            <td>Date forclusion</td>
                                            <td>: $date_forclusion</td>
                                        </tr>
                                        <tr>
                                            <td>Travaux</td>
                                            <td>: $travaux</td>
                                        </tr>
                                        <tr>
                                            <td>Département</td>
                                            <td>: $department</td>
                                        </tr>
                                    </table>";  
                        if($project->projectGestionnaire && $project->projectGestionnaire->status == 'active' && $project->projectGestionnaire->email_professional){
                            Mail::to($project->projectGestionnaire->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                        } 
                        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [10,11,12,13,14])->get();
                        foreach($users as $user){
                            if($user->status == 'active' && $user->email_professional){
                                Mail::to($user->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                            }
                        }
                        $subvention->Statut_subvention_yes_1_month_before_mail_status = 1;
                        $subvention->save();
                    }elseif(Carbon::now()->addDays(60) >= Carbon::parse($subvention->Date_forclusion) && $subvention->Statut_subvention_yes_2_month_before_mail_status == 0){
                        $client_name = $project->Prenom ?? '';
                        $subject = 'Délai de forclusion arrive à échéance '.$client_name; 
                        $amount = $subvention->montant_subvention_accorde;
                        $date = $subvention->subvention_accorde_le ? Carbon::parse($subvention->subvention_accorde_le)->format('d-m-Y'):'';
                        $date_forclusion = $subvention->Date_forclusion ? Carbon::parse($subvention->Date_forclusion)->format('d-m-Y'):'';
                        $travaux = '';
                        
                        foreach($project->ProjectBareme as $key => $value){
                            $travaux .= $value->travaux . ($project->ProjectBareme->count() == $key +1 ? '':', '); 
                        }
                        $department = getDepartment($project->Code_Postal); 
                        $mail_body = "<p  style='font-size:18px margin-top:10px'>
                                        Bonjour,
                                    </p>
                                    <table>
                                        <tr>
                                            <td colspan='2'>La subvention de $client_name arrive à forclusion.
                                            </td> 
                                        </tr> 
                                        <tr>
                                            <td>Montant subvention accordé</td>
                                            <td>: €$amount</td>
                                        </tr>
                                        <tr>
                                            <td>Subvention accordé le</td>
                                            <td>: $date</td>
                                        </tr>
                                        <tr>
                                            <td>Date forclusion</td>
                                            <td>: $date_forclusion</td>
                                        </tr>
                                        <tr>
                                            <td>Travaux</td>
                                            <td>: $travaux</td>
                                        </tr>
                                        <tr>
                                            <td>Département</td>
                                            <td>: $department</td>
                                        </tr>
                                    </table>";  
                        if($project->projectGestionnaire && $project->projectGestionnaire->status == 'active' && $project->projectGestionnaire->email_professional){
                            Mail::to($project->projectGestionnaire->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                        } 
                        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [10,11,12,13,14])->get();
                        foreach($users as $user){
                            if($user->status == 'active' && $user->email_professional){
                                Mail::to($user->email_professional)->send(new SubventionStatusMail($subject, $mail_body)); 
                            }
                        }
                        $subvention->Statut_subvention_yes_2_month_before_mail_status = 1;
                        $subvention->save();
                    }
                }
            }
        }
    }
}
