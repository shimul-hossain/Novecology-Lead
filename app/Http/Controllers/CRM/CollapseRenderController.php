<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller; 
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollapseRenderController extends Controller
{
    public function leadCollapseBlock(Request $request){
        $lead = LeadClientProject::where('id', $request->lead_id)->first();  
        if($request->tab_value){  
            $view = view('admin.blocks.lead.'.$request->tab_value, compact('lead'))->render();
        }else{
            $view ='';
        }
        session()->put('active_lead_tab_collapse', $request->tab_value);

        return response($view);
    }

    public function projectCollapseBlock(Request $request){
 
        $project = NewProject::where('id', $request->project_id)->first();  
        $user_actions = Auth::user()->checkAction;  
        $role = Auth::user()->role;

        if($request->tab_value){  
            $view = view('admin.blocks.project.'.$request->tab_value, compact('project', 'user_actions', 'role'))->render();
        }else{
            $view ='';
        }
        session()->put('active_project_tab_collapse', $request->tab_value);
        return response($view);

        // $tax = ProjectTax::where('project_id', $project->id)->orderBy('primary', 'asc')->get();
        // $primary_tax = ProjectTax::where('project_id', $project->id)->where('primary', 'yes')->first();
        // // $tax_zone = checkZone($project->lead_id, $project->company_id);
        // $childrens = Children::where('project_id', $project->id)->get(); 
        // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
        // $project_statuses = ProjectNewStatus::all();
        // if($primary_tax && $primary_tax->postal_code){
        //     $tax_zone = getPrimaryZone($primary_tax->postal_code);
        //     $tax_precariousness = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $primary_tax->postal_code);
        // }else{
        //     $tax_zone = '';
        //     $tax_precariousness = '';
        // }

        // $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $project->id)->orderBy('id', 'desc')->get(); 
        
        // $trait = ProjectTrait::where('project_id', $project->id)->first();
        // if(!$trait){
        //     $trait = ProjectTrait::create(['project_id' => $project->id]);
        // }
        // $intervention = Intervention::where('project_id', $project->id)->first();
        // if(!$intervention){
        //     $intervention = Intervention::create(['project_id' => $project->id]);
        // }
        // $report  = Rapport::where('project_id', $project->id)->first(); 
        // if(!$report){
        //     $report  = Rapport::create(['project_id' => $project->id]); 
        // }
        // $report2  = SecondReport::where('project_id', $project->id)->first(); 
        // if(!$report2){
        //     $report2  = SecondReport::create(['project_id' => $project->id]); 
        // }

        // $work = Work::where('project_id', $project->id)->first();
        // if(!$work){
        //     $work = Work::create(['project_id' => $project->id]);
        // }
        // $question = Question::where('project_id', $project->id)->first();
        // if(!$question){
        //     $question = Question::create(['project_id' => $project->id]);
        // }

        // $preInstallation = PreInstallation::where('project_id', $project->id)->first();
        // if(!$preInstallation){
        //     $preInstallation = PreInstallation::create(['project_id' => $project->id]);
        // }
        // $postInstallation = PostInstallation::where('project_id', $project->id)->first();
        // if(!$postInstallation){
        //     $postInstallation = PostInstallation::create(['project_id' => $project->id]);
        // }
        // $second_project = SecondProject::where('project_id', $project->id)->first();
        // if(!$second_project){
        //     $second_project = SecondProject::create(['project_id' => $project->id]);
        // }
        // if(role() == 's_admin'){
        //     $comments = ProjectComment::where('project_id', $project->id)->orderBy('id', 'desc')->get(); 
        //     $categories = CommentCategory::all();
        // }else{
        //     $comments = ProjectComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('project_id', $project->id)->orderBy('id', 'desc')->get(); 
        //     $categories = Auth::user()->commentCategory; 
        // }
        
        // $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        // $tenhnicians = User::where('deleted_status', 'no')->where('status', 'active')->where('role', 'technicians')->get();
        // $operations = WorkDone::where('project_id', $project->id)->get();  
        // $addition_products = AdditionalProduct::where('project_id', $project->id)->orderBy('order', 'asc')->get();

        // $energy_aid = EnergyAid::where('project_id', $project->id)->first();
        // if(!$energy_aid){
        //     $energy_aid = EnergyAid::create(['project_id' => $project->id]);
        // }
        // $suppliers = Fournisseur::where('active', 'Oui')->get();
        // $campagne_types = Campagnetype::all();
        // $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        // $heatings = HeatingMode::all(); 
        // $agents = Agent::where('active', 'Oui')->get();
        // $travauxs = TravauxList::all();
        // $scales = Scale::where('active', 'yes')->where('deleted_status', 'no')->get();
        // $banques = Banque::all();  
        // $quality_controls = ControleQuality::where('project_id', $project->id)->orderBy('id', 'desc')->get();
        // $control_sur_sites = ControleSurSite::where('project_id', $project->id)->orderBy('id', 'desc')->get();
        // $control_offices = Control::all();
        // $inspection_statuses = InspectionStatus::all();
        // $controlled_works = ControlledWork::all();
        // $compliances = Compliance::all(); 
        // $commissioning_technicians = CommissioningTechnician::all();
        // $commissioning_statuses = CommissioningStatus::all();
        // $deals = Deal::all();
        // $prestation_group = PrestationGroup::all();
        // $installers = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get();
        // $facturation = Facturation::where('project_id', $project->id)->first();
        // if(!$facturation){
        //     $facturation = Facturation::create(['project_id' => $project->id]);
        // }
        // $delegates = Delegate::all();
        // $management_control = ManagementControl::where('project_id', $project->id)->first();
        // if(!$management_control){
        //     $management_control = ManagementControl::create(['project_id' => $project->id]);
        // }


        // $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        // $min_30_interval = [];
        // foreach($schedules30 as $d){
        //     $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        // }  
        
        // if(!$energy_aid){
        //     $energy_aid = EnergyAid::create(['project_id' => $project->id]);
        // }
        // $sidebar_info = DevisSidebar::where('project_id', $project->id)->first();
        // if(!$sidebar_info){
        //     $sidebar_info = DevisSidebar::create(['project_id' => $project->id]);
        // } 
        // $single_ticket = Ticketing::latest()->first(); 
        // $qc_type = QualityControlType::all();
        // $document_controls = DocumentControl::orderBy('order', 'asc')->get();
        // $status_planning = StatusPlanningIntervention::all();
        // $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();
        // $ko_reasons = ProjectDeadReason::all();
        // $reflection_reasons = ProjectReflectionReason::all();
        // $products = Product::latest()->get();
        // $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
        // $team_laeders = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        // $project_control_photos = ProjectControlPhoto::all();
        // $offices = Auditor::all();
        // $status_audits = AuditStatus::all();
        // $report_results = ReportResult::all();
        // $statut_maprimerenovs = StatutMaprimerenov::orderBy('order', 'asc')->get();
        // $mandataire_maprimerenovs = Agent::all();
        // $administrarif_role_id  = Role::where('category_id', 3)->pluck('id');
        // $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        // $all_inputs = ProjectCustomField::all();
        // $entreprise_de_travauxs = Installer::all();
        // $documents = Document::all();
        // $reject_reasons = RejectReason::all();
        // $amos = Amo::all();
        // $emails = [$project->Email, $project->Compte_email, $project->Compte_Email_de_récupération_email, $project->Email_de_transfert_Email, $project->Compte_MaPrimeRenov_email]; 
        // $all_emails = StoreEmail::whereIn('from', $emails)->get();
        // $selected_baremes = $project->ProjectBareme;
        // if (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe'){
        //     $project_interventions = $project->getIntervention()->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->get();
        // }else{
        //     $project_interventions = $project->getIntervention;
        // }
        // $tag_users_id = []; 
        // if($project->getProjectTelecommercial){
        //     $tag_users_id[] = $project->project_telecommercial;
        //     if($project->getProjectTelecommercial->getRegie &&  $project->getProjectTelecommercial->getRegie->getUser){
        //         $tag_users_id[] = $project->getProjectTelecommercial->getRegie->getUser->id; 
        //     }
        // }
        // foreach($project->getIntervention as $intervention){
        //     if($intervention->user_id){
        //         $tag_users_id[] = $intervention->user_id;
        //     }
        // }
        // if($project->projectGestionnaire){
        //     $tag_users_id[] = $project->project_gestionnaire; 
        // }
        // $assign_users = User::whereIn('id', $tag_users_id)->get();

        // $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
        // $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

        // $tag_users = $admin_users->merge($assign_users);

        // $project_static_tabs = ProjectStaticTab::all();
        // $role = Auth::user()->role;
        // $user_actions = Auth::user()->checkAction; 
        // $technical_referees = TechnicalReferee::all();
    }
}
