<?php

namespace App\Http\Controllers\CRM;

use App\Console\Commands\RecurrenceAutomatise;
use App\Events\PannelLog;
use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Tax;
use App\Models\CRM\Work;
use App\Models\CRM\Audit;
use App\Models\CRM\Banque;
use App\Models\CRM\Client;
use App\Models\CRM\Account;
use App\Models\CRM\Project;
use App\Models\CRM\Rapport;
use Illuminate\Support\Str;
use App\Mail\CRM\AssignMail;
use App\Models\CRM\Children;
use App\Models\CRM\Question;
use App\Models\CRM\WorkDone;
use Illuminate\Http\Request;
use App\Models\CRM\EnergyAid;
use App\Models\CRM\Compliance;
use App\Models\CRM\ProjectSav;
use App\Models\CRM\Subvention;
use App\Models\CRM\ActivityLog;
use App\Models\CRM\AuditStatus;
use App\Models\CRM\BanqueDepot;
use App\Models\CRM\Facturation;
use App\Models\CRM\Information;
use App\Models\CRM\LeadTracker;
use App\Models\CRM\ProjectUser;
use App\Models\CRM\StudyOffice;
use App\Models\CRM\TravauxList;
use App\Models\CRM\ClientHeader;
use App\Models\CRM\DevisSidebar;
use App\Models\CRM\Intervention;
use App\Models\CRM\ProjectTrait;
use App\Models\CRM\ReportResult;
use App\Models\CRM\SavDataField;
use App\Models\CRM\SavFieldData;
use App\Models\CRM\SecondReport;
use App\Models\CRM\ControlOffice;
use App\Models\CRM\Notifications;
use App\Models\CRM\ProjectAssign;
use App\Models\CRM\ProjectHeader;
use App\Models\CRM\ProjectStatus;
use App\Models\CRM\SecondProject;
use App\Models\CRM\TechnicianSav;
use PhpParser\Node\Expr\FuncCall;
use App\Models\CRM\ControlledWork;
use App\Models\CRM\ProjectComment;
use App\Models\CRM\QualityControl;
use App\Models\CRM\TravauxProduct;
use App\Models\CRM\PreInstallation;
use App\Models\CRM\StatusPrevisite;
use App\Models\CRM\TechnicianStudy;
use App\Models\CRM\TravauxQuestion;
use App\Http\Controllers\Controller;
use App\Imports\ProjectImport;
use App\Imports\ProjectImportManual;
use App\Mail\AutomatisationMail;
use App\Mail\CRM\CommentMentionMail;
use App\Mail\CRM\SubventionStatusYesMail;
use App\Mail\SubventionStatusMail;
use App\Models\Automatise;
use App\Models\Brand;
use App\Models\CRM\ActionPermission;
use App\Models\CRM\ControlOfficeCsp;
use App\Models\CRM\InspectionStatus;
use App\Models\CRM\PostInstallation;
use App\Models\CRM\TechnicalReferee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CRM\AdditionalProduct;
use App\Models\CRM\Agent;
use App\Models\CRM\AuditReportStatus;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\CommercialTerrain;
use App\Models\CRM\ProjectEquipeUser;
use App\Models\CRM\SecondInformation;
use App\Models\CRM\StatusPlanningSav;
use App\Models\CRM\ClientHeaderFilter;
use App\Models\CRM\Commercial;
use App\Models\CRM\InterventionModule;
use App\Models\CRM\ProjectTableStatus;
use App\Models\CRM\StatusCounterVisit;
use App\Models\CRM\CommissioningStatus;
use App\Models\CRM\CompanyCommissioned;
use App\Models\CRM\ProjectHeaderFilter;
use App\Models\CRM\StatusPlanningStudy;
use App\Models\CRM\StatusResolutionSav;
use App\Models\CRM\TechnicianPrevisite;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Models\CRM\StatusInvoiceCompany;
use App\Models\CRM\ProjectStatusPlanning;
use App\Models\CRM\ProjectDocumentControl;
use App\Models\CRM\QualityControlQuestion;
use App\Models\CRM\StatusFeasibilityStudy;
use App\Models\CRM\TechnicianCounterVisit;
use App\Models\CRM\CommissioningTechnician; 
use App\Models\CRM\InstallerInvoiceStats;
use App\Models\CRM\InstallerInvoiceStatus;
use App\Models\CRM\StatusPlanningPrevisite;
use App\Models\CRM\InterventionInstallation;
use App\Models\CRM\ManagementControl;
use App\Models\CRM\Previsitor;
use App\Models\CRM\StatusPlanningDeplacement;
use App\Models\CRM\StatusFeasibilityPrevisite;
use App\Models\CRM\StatusPlanningCounterVisit;
use App\Models\CRM\StatusPlanningInstallation;
use App\Models\CRM\StatusFeasibilityCounterVisit;
use App\Models\CRM\TicketProblemStatus;
use App\Models\CRM\Benefit;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\CompleteAction;
use App\Models\CRM\ControleQuality;
use App\Models\CRM\ControleSurSite;
use App\Models\CRM\DefaultHeaderFilter;
use App\Models\CRM\DemandeMairie;
use App\Models\CRM\Document;
use App\Models\CRM\EnergyType;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\HeatingMode;
use App\Models\CRM\InterventionTravaux;
use App\Models\CRM\InterventionTravauxProjectControl;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\NewProject2;
use App\Models\CRM\NonConfirmReason;
use App\Models\CRM\PannelLogActivity;
use App\Models\CRM\PrestationGroup;
use App\Models\CRM\PrestationGroupItem;
use App\Models\CRM\Product;
use App\Models\CRM\ProjectBareme;
use App\Models\CRM\ProjectBaremes;
use App\Models\CRM\ProjectCommentFile;
use App\Models\CRM\ProjectControlPhoto;
use App\Models\CRM\ProjectCustomField;
use App\Models\CRM\ProjectDefaultHeaderFilter;
use App\Models\CRM\ProjectFacturation;
use App\Models\CRM\ProjectFile;
use App\Models\CRM\ProjectGestion;
use App\Models\CRM\ProjectImportHeader;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectProductNombre;
use App\Models\CRM\ProjectSubStatus;
use App\Models\CRM\ProjectTag;
use App\Models\CRM\ProjectTagProduct;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\ProjectTaxDeclarant;
use App\Models\CRM\ProjectTravaux;
use App\Models\CRM\Regie;
use App\Models\CRM\Role;
use App\Models\CRM\StatusChangeLog;
use App\Models\CRM\StatusPlanningIntervention;
use App\Models\CRM\StatutMaprimerenov;
use App\Models\CRM\ZoneInfo;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use ParagonIE\Sodium\Core\Curve25519\H;
use PDO;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use CURLFile;
use GuzzleHttp\Client as GuzzleHttpClient;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Throwable;

class ProjectController extends Controller
{

    // Index

    public function imoprtTestDone($id){
        if(Auth::id() != 1){
            return back();
        }

        $project = NewProject::find($id);
        if($project && $project->projectSecondTable && $project->projectSecondTable->manual_import == 2){
            $project->projectSecondTable->update([
                'manual_import' => 1
            ]);
        }

        return redirect()->route('project-import.index', 0);

    }
    public function projectImport($status = 1){
        if(role() != 's_admin'){
            return back();
        }
        $headers = ProjectHeader::all(); 
        $filter_status = ProjectHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('project_header_id', 'asc')->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get(); 
        $project_status = ProjectNewStatus::orderBy('order', 'asc')->get();
        $default_filters = ProjectDefaultHeaderFilter::with('getProjectHeader')->get();
        $project_current_label = ProjectNewStatus::find($status);
        
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $pagination_number = paginationNumber('project-import'); 

        $filter_telecommercial_status = true;
        if($status == 0){
            $projects = NewProject::where('deleted_status', 1)->whereHas('projectSecondTable', function ($query) {
                $query->where('manual_import', 2);
            })->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->orderBy('Code_Postal', 'asc')->get();
        }else{
            $projects = NewProject::where('project_label', $status)->where('deleted_status', 1)->whereHas('projectSecondTable', function ($query) {
                $query->where('manual_import', 1);
            })->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
        }

        $client_id = 0;
        $role = Auth::user()->role;
        $user_action_create = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'create')->exists();
        $user_action_assign = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'assign')->exists();
        $user_action_import = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'import')->exists();
        $user_action_add_filter = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'add_filter')->exists();
        $user_action_filter_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'filter_blue_button')->exists();
        $user_action_statut_visible = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_visible')->exists();
        $user_action_statut_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_edit')->exists();
        $user_action_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'blue_button')->exists();
        $user_action_mpr_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'mpr_button')->exists();
        $user_action_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'edit')->exists(); 
        
        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        return view('admin.manual-imported-projects', compact('headers', 'client_id', 'project_status', 'projects', 'telecommercials', 'default_filters', 'status', 'suvbention_gestionnaires', 'filter_telecommercial_status', 'filter_status', 'pagination_number', 'role', 'user_action_assign', 'user_action_import', 'user_action_add_filter', 'user_action_filter_blue_button', 'user_action_statut_visible', 'user_action_statut_edit', 'user_action_blue_button', 'user_action_mpr_button', 'user_action_edit', 'permission_regies', 'user_action_create'));
    }
    public function projectImportCreate(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $client = NewClient::create([
            'user_id' => Auth::id(),
            'company_id' => 1,
            'deleted_status' => 1,
        ]);
        $project = NewProject::create([
            'user_id' => Auth::id(),
            'company_id' => 1,
            'client_id' => $client->id,
            'project_label' => $request->status,
            'deleted_status' => 1
        ]);

        NewProject2::create([
            'project_id' => $project->id,
            'manual_import' => 1,            
            'montant_cee' => $request->montant_cee  ?? null,            
            'precariousness' => $request->situation ?? null,
        ]);
 
        return back();
        return redirect()->route('files-import.index', $project->id)->with('success', 'Nouveau projet créé avec succès');;
    }

    public function projectImportMoveto(Request $request){
        $project_ids = explode(',', $request->bulk_selected_project);
        $count = 0;
        foreach($project_ids as $project_id){
            $project = NewProject::find($project_id);
            if($project){
                $count++;
                $project->update([
                    'deleted_status' => 0,
                ]);
                if($project->getClient){
                    $project->getClient->update([
                        'deleted_status' => 0,
                    ]);
                }
            }
        }
        $message = $count." chantier".($count > 1 ? 's':'')." successfully move to main chantier";
        return back()->with('success', $message);
    }

    public function projectIndex($status = 1){
        // $command = new RecurrenceAutomatise();
        // dd($command->handle());
        $headers = ProjectHeader::all(); 
        $filter_status = ProjectHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('project_header_id', 'asc')->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get(); 
        $project_status = ProjectNewStatus::orderBy('order', 'asc')->get();
        $default_filters = ProjectDefaultHeaderFilter::with('getProjectHeader')->get();
        $project_current_label = ProjectNewStatus::find($status);
        if(!$project_current_label){
            return redirect()->route('project.index');
        }
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $pagination_number = paginationNumber('project');

        if(in_array(role(), $administrarif_role)){
            $filter_telecommercial_status = true;
            $projects = NewProject::where('project_label', $status)->where('deleted_status', 0)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
        }else{
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects = NewProject::whereIn('project_telecommercial', $user_ids)->where('project_label', $status)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else if(role() == 'team_leader'){
                $telecommercials = [];
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $projects = NewProject::whereIn('id', $intervention_project_ids)->where('project_label', $status)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
            }else{
                $telecommercials = [];
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $projects = Auth::user()->getTelecommiercialProjects()->where('project_label', $status)->where('deleted_status', 0)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                    $projects = NewProject::whereIn('id', $intervention_project_ids)->where('project_label', $status)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                } 
            }
        }
        $client_id = 0;
        $role = Auth::user()->role;
        $user_action_create = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'create')->exists();
        $user_action_assign = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'assign')->exists();
        $user_action_import = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'import')->exists();
        $user_action_add_filter = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'add_filter')->exists();
        $user_action_filter_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'filter_blue_button')->exists();
        $user_action_statut_visible = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_visible')->exists();
        $user_action_statut_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_edit')->exists();
        $user_action_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'blue_button')->exists();
        $user_action_mpr_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'mpr_button')->exists();
        $user_action_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'edit')->exists(); 
        
        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        return view('admin.projects', compact('headers', 'client_id', 'project_status', 'projects', 'telecommercials', 'default_filters', 'status', 'suvbention_gestionnaires', 'filter_telecommercial_status', 'filter_status', 'pagination_number', 'role', 'user_action_assign', 'user_action_import', 'user_action_add_filter', 'user_action_filter_blue_button', 'user_action_statut_visible', 'user_action_statut_edit', 'user_action_blue_button', 'user_action_mpr_button', 'user_action_edit', 'permission_regies', 'user_action_create'));
    }

    public function projectCreate(Request $request){
        if(!checkAction(Auth::id(), 'project', 'create') && role() != 's_admin'){
            return back();
        }
        $client = NewClient::create([
            'user_id' => Auth::id(),
            'company_id' => 1,
        ]);
        $project = NewProject::create([
            'user_id' => Auth::id(),
            'company_id' => 1,
            'client_id' => $client->id,
            'project_label' => 1,
        ]);

        if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
            $project->project_telecommercial = Auth::id(); 
            $project->save();
        }

       
        
        $pannel_activity = PannelLogActivity::create([
            'key'           => 'new_project__create',
            'feature_id'    => $project->id,
            'feature_type'  => 'project',
            'user_id'       => Auth::id(), 
        ]);

        event(new PannelLog($pannel_activity->id));


        return redirect()->route('files.index', $project->id)->with('success', 'Nouveau projet créé avec succès');;
    }

    public function projectFilter($status){
        if(!checkAction(Auth::id(), 'project', 'filter_blue_button') && role() != 's_admin'){
            return back();
        }
        $headers = ProjectHeader::all();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 16)->get();
        $project_status = ProjectNewStatus::orderBy('order', 'asc')->get();
        $default_filters = ProjectDefaultHeaderFilter::all();

        $project_current_label = ProjectNewStatus::find($status);
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        
        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        $project = NewProject::query();

        $filter_telecommercial_status = true;
        if(!in_array(role(), $administrarif_role)){
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $project->whereIn('project_telecommercial', $user_ids);
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else if(role() == 'team_leader'){
                $telecommercials = [];
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $project->whereIn('id', $intervention_project_ids);
            }else{
                $telecommercials = [];
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $project->where('project_telecommercial', Auth::id());
                }else{  
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray(); 
                    $project->whereIn('id', $intervention_project_ids);
                } 
            }
        }

        if(request()->__tracking__Fournisseur_de_lead){
            if(request()->__tracking__Fournisseur_de_lead == 'no-data'){
                $project->where(function($query){
                    $query->where('__tracking__Fournisseur_de_lead', null)->orWhere('__tracking__Fournisseur_de_lead', '');
                });
            }else{
                $project->where('__tracking__Fournisseur_de_lead', request()->__tracking__Fournisseur_de_lead);
            }
        }
        if(request()->__tracking__Type_de_campagne){
            if(request()->__tracking__Type_de_campagne == 'no-data'){
                $project->where(function($query){
                    $query->where('__tracking__Type_de_campagne', null)->orWhere('__tracking__Type_de_campagne', '');
                });
            }else{
                $project->where('__tracking__Type_de_campagne', request()->__tracking__Type_de_campagne);
            }
        }
        if(request()->__tracking__Nom_campagne){
            $project->where('__tracking__Nom_campagne','LIKE', '%'.request()->__tracking__Nom_campagne.'%');
        }
        if(request()->__tracking__Date_demande_lead_from || request()->__tracking__Date_demande_lead_to){
            $from = request()->__tracking__Date_demande_lead_from ?? Carbon::now();
            $to = request()->__tracking__Date_demande_lead_to ?? Carbon::now();
            $project->whereBetween('__tracking__Date_demande_lead', [$from, $to]);
        }
        if(request()->__tracking__Date_attribution_télécommercial){
            $project->where('__tracking__Date_attribution_télécommercial','LIKE', '%'.request()->__tracking__Date_attribution_télécommercial.'%');
        } 
        if(request()->Prenom){
            $project->where('Prenom','LIKE', '%'.request()->Prenom.'%');
        }
        if(request()->Nom){
            $project->where('Nom','LIKE', '%'.request()->Nom.'%');
        } 
        if(request()->Email){
            $project->where('Email','LIKE', '%'.request()->Email.'%');
        } 
        if(request()->Type_occupation){
            if(request()->Type_occupation == 'no-data'){
                $project->where(function($query){
                    $query->where('Type_occupation', null)->orWhere('Type_occupation', '');
                });
            }else{
                $project->where('Type_occupation', request()->Type_occupation);
            }
        } 
        if(request()->Zone){
            if(request()->Zone == 'no-data'){
                $project->where(function($query){
                    $query->where('Zone', null)->orWhere('Zone', '');
                });
            }else{
                $project->where('Zone', request()->Zone);
            }
        }
        if(request()->precariousness){
            if(request()->precariousness == 'no-data'){
                $project->where(function($query){
                    $query->where('precariousness', null)->orWhere('precariousness', '');
                });
            }else{
                $project->where('precariousness', request()->precariousness);
            }
        }
        if(request()->Mode_de_chauffage){
            if(request()->Mode_de_chauffage == 'no-data'){
                $project->where(function($query){
                    $query->where('Mode_de_chauffage', null)->orWhere('Mode_de_chauffage', '');
                });
            }else{
                $project->where('Mode_de_chauffage', request()->Mode_de_chauffage);
            }
        }
        if(request()->Surface_habitable){
            $project->where('Surface_habitable','LIKE', '%'.request()->Surface_habitable.'%');
        }
        if(request()->Situation_familiale){
            if(request()->Situation_familiale == 'no-data'){
                $project->where(function($query){
                    $query->where('Situation_familiale', null)->orWhere('Situation_familiale', '');
                });
            }else{
                $project->where('Situation_familiale', request()->Situation_familiale);
            }
        }
        if(request()->Ville){
            $project->where('Ville','LIKE', '%'.request()->Ville.'%');
        }
        if(request()->department){
            $department_request_data = [];
            foreach(request()->department as $dd){
                if(strlen($dd) == 1){
                    $department_request_data[] = '0'.$dd;
                }else{
                    $department_request_data[] = $dd;
                }
            }
            if(in_array('no-data', $department_request_data)){
                $project->where(function($query) use ($department_request_data){
                    $query->where('Code_Postal', null)->orWhere('Code_Postal', '');
                    foreach($department_request_data as $request_department){
                        $query->orWhere('Code_Postal','LIKE', $request_department.'%');
                    }
                });
            }else{
                $project->where(function($query) use ($department_request_data){
                    foreach($department_request_data as $request_department){
                        $query->orWhere('Code_Postal','LIKE', $request_department.'%');
                    }
                }); 
            }
            // if(request()->department == 'no-data'){
            //     $project->where(function($query){
            //         $query->where('Code_Postal', null)->orWhere('Code_Postal', '');
            //     });
            // }else{
            //     if(strlen(request()->department) == 1){
            //         $request_department = '0'.request()->department;
            //     }else{
            //         $request_department = request()->department;
            //     }
    
            //     $project->where('Code_Postal','LIKE', $request_department.'%');
            // }
        }
        if(request()->bareme){
            $ids = ProjectBareme::whereIn('barame_id', request()->bareme)->pluck('project_id');
            if(in_array('no-data', request()->bareme)){
                $bareme_project_ids = ProjectBareme::get()->pluck('project_id')->toArray();
                $project->where(function($query) use ($bareme_project_ids, $ids) {
                    $query->whereNotIn('id', $bareme_project_ids)->orWhereIn('id', $ids);
                });
            }else{
                $project->whereIn('id', $ids);
            }
        }
        if(request()->travaux){
            $ids = ProjectTravaux::whereIn('travaux_id', request()->travaux)->pluck('project_id');
            if(in_array('no-data', request()->travaux)){
                $travaux_project_ids = ProjectTravaux::get()->pluck('project_id')->toArray();
                $project->where(function($query) use ($travaux_project_ids, $ids) {
                    $query->whereNotIn('id', $travaux_project_ids)->orWhereIn('id', $ids);
                });
            }else{
                $project->whereIn('id', $ids);
            }
        }
        if(request()->tag){
            if(request()->tag == 'no-data'){
                $bareme_project_ids = ProjectBareme::get()->pluck('project_id')->toArray();
                $project->whereNotIn('id', $bareme_project_ids);
            }else{
                $ids = ProjectBareme::where('barame_id', request()->tag)->pluck('project_id');
                $project->whereIn('id', $ids);
            }
        }
        if(request()->product){
            $ids = ProjectTagProduct::where('product_id', request()->product)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Type_de_contrat){
            if(request()->Type_de_contrat == 'no-data'){
                $project->where(function($query){
                    $query->where('Type_de_contrat', null)->orWhere('Type_de_contrat', '');
                });
            }else{
                $project->where('Type_de_contrat',request()->Type_de_contrat);
            }
        } 
        if(request()->Statut_Projet){
            if(request()->Statut_Projet == 'no-data'){
                $project->where(function($query){
                    $query->where('Statut_Projet', null)->orWhere('Statut_Projet', '');
                });
            }else{
                $project->where('Statut_Projet',request()->Statut_Projet);
            }
        } 
        if(request()->Pièces_manquante){
            $project->where('Pièces_manquante',request()->Pièces_manquante);
        }
        if(request()->intervention_type){
            $ids = ProjectIntervention::where('type', request()->intervention_type)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_planning){
            $ids = ProjectIntervention::where('Statut_planning', request()->Statut_planning)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Faisabilité_du_chantier){
            $ids = ProjectIntervention::where('Faisabilité_du_chantier', request()->Faisabilité_du_chantier)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Dossier_administratif_complet){
            $ids = ProjectIntervention::where('Dossier_administratif_complet', request()->Dossier_administratif_complet)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Installateur_technique){
            $ids = ProjectIntervention::where('type', 'Installation')->where('user_id', request()->Installateur_technique)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_Installation){
            $ids = ProjectIntervention::where('Statut_Installation', request()->Statut_Installation)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Chargé_étude){
            $ids = ProjectIntervention::where('type', 'Etude')->where('user_id', request()->Chargé_étude)->pluck('project_id');
            $project->whereIn('id', $ids);
        }

        if(request()->Réfèrent_technique){ 
            $ids = ProjectIntervention::where('Réfèrent_technique', request()->Réfèrent_technique)->pluck('project_id');
            $project->whereIn('id', $ids);
        }

        if(request()->Prévisiteur_Technico_Commercial){
            $ids = ProjectIntervention::where('type', 'Pré-Visite Technico-Commercial')->where('user_id', request()->Prévisiteur_Technico_Commercial)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Contre_prévisiteur){
            $ids = ProjectIntervention::where('type', 'Contre Visite Technique')->where('user_id', request()->Contre_prévisiteur)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Technicien_SAV){
            $ids = ProjectIntervention::where('type', 'SAV')->where('user_id', request()->Technicien_SAV)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_SAV){ 
            $ids = ProjectIntervention::where('Statut_SAV', request()->Statut_SAV)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->subvention_status){ 
            $ids = Subvention::where('subvention_status', request()->subvention_status)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->mandataire){ 
            $ids = Subvention::where('mandataire', request()->mandataire)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->gestionnaire_depot){ 
            $ids = Subvention::where('gestionnaire_depot', request()->gestionnaire_depot)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_subvention){ 
            $ids = Subvention::where('Statut_subvention', request()->Statut_subvention)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_1_hyphen_MyMPR){
            $project->where('Statut_1_hyphen_MyMPR','LIKE', '%'.request()->Statut_1_hyphen_MyMPR.'%');
        }
        if(request()->banque){ 
            $ids = BanqueDepot::where('banque_id', request()->banque)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->banque_status){ 
            $ids = BanqueDepot::where('banque_status', request()->banque_status)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_accord_banque){ 
            $ids = BanqueDepot::where('Statut_accord_banque', request()->Statut_accord_banque)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->audit_status){ 
            $ids = Audit::where('audit_status', request()->audit_status)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->report_result){ 
            $ids = Audit::where('report_result', request()->report_result)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->csp_type){
            $ids = ControleSurSite::where('type', request()->csp_type)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Conformité_du_chantier){
            $ids = ControleSurSite::where('Conformité_du_chantier', request()->Conformité_du_chantier)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->facturation_type){
            $ids = ProjectFacturation::where('type', request()->facturation_type)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_règlement){
            $ids = ProjectFacturation::where('Statut_règlement', request()->Statut_règlement)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Paiement_inférieur_au_montant_prévu){
            $ids = ProjectFacturation::where('Paiement_inférieur_au_montant_prévu', request()->Paiement_inférieur_au_montant_prévu)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->facturationMandataire){
            $ids = ProjectFacturation::where('Mandataire', request()->facturationMandataire)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Avance_délégataire_MaPrimeRénov){
            $ids = ProjectFacturation::where('Avance_délégataire_MaPrimeRénov', request()->Avance_délégataire_MaPrimeRénov)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Statut_règlement_banque){
            $ids = ProjectFacturation::where('type', 'Encaissement Banque')->where('Statut_règlement', request()->Statut_règlement_banque)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Banque_facturation){
            $ids = ProjectFacturation::where('type', 'Encaissement Banque')->where('Banque', request()->Banque_facturation)->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->Numero_lot){
            $ids = ProjectFacturation::where('Numero_lot', request()->Numero_lot)->where(function($query){
                $query->where('type', 'Encaissement CEE')->orWhere('type', 'CEE');
            })->pluck('project_id');
            $project->whereIn('id', $ids);
        }
        if(request()->sub_status){ 
            if(in_array('no-data', request()->sub_status)){
                $project->where(function($query){
                    $query->whereIn('project_sub_status', request()->sub_status)->orWhere('project_sub_status', null)->orWhere('project_sub_status', '');
                });
            }else{
                $project->whereIn('project_sub_status', request()->sub_status);
            }
        }
        if(($filter_telecommercial_status || role() == 'sales_manager' || role() == 'sales_manager_externe') && request()->telecommercial_id){
            if(request()->telecommercial_id == 'no-data'){
                $project->where(function($query){
                    $query->where('project_telecommercial', null)->orWhere('project_telecommercial', '');
                });
            }else{
                $project->where('project_telecommercial', request()->telecommercial_id);
            }
        } 
        if($filter_telecommercial_status && request()->gestionnaire_id){
            if(request()->gestionnaire_id == 'no-data'){
                $project->where(function($query){
                    $query->where('project_gestionnaire', null)->orWhere('project_gestionnaire', '');
                });
            }else{
                $project->where('project_gestionnaire', request()->gestionnaire_id);
            }
        } 
        if($permission_regies && request()->regie){
            if(request()->regie == 'no-regie'){
                $project->doesnthave('getProjectTelecommercial');
            }else{
                $user_ids = User::where('regie_id', request()->regie)->where('deleted_status', 'no')->pluck('id');
                $project->whereIn('project_telecommercial', $user_ids);
            }
        } 

        $client_id = 0;
        
        $pagination_number = paginationNumber('project');
        $projects = $project->where('project_label', $status)->where('deleted_status', 0)->with('getSubStatus', 'projectGestionnaire', 'getProjectTelecommercial', 'ProjectTravauxTags', 'getDepot', 'getAudit', 'getSupplier')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);

        $role = Auth::user()->role;
        $user_action_create = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'create')->exists();
        $user_action_assign = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'assign')->exists();
        $user_action_import = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'import')->exists();
        $user_action_add_filter = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'add_filter')->exists();
        $user_action_filter_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'filter_blue_button')->exists();
        $user_action_statut_visible = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_visible')->exists();
        $user_action_statut_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'statut_edit')->exists();
        $user_action_blue_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'blue_button')->exists();
        $user_action_mpr_button = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'mpr_button')->exists();
        $user_action_edit = ActionPermission::where('user_id', Auth::id())->where('module_name', 'project')->where('action_name', 'edit')->exists(); 
        $filter_status = ProjectHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('project_header_id', 'asc')->get();
        
        return view('admin.projects', compact('headers', 'users', 'client_id', 'project_status', 'projects', 'telecommercials', 'default_filters', 'status', 'gestionnaires', 'suvbention_gestionnaires', 'filter_telecommercial_status', 'role', 'user_action_assign', 'user_action_import', 'user_action_add_filter', 'user_action_filter_blue_button', 'user_action_statut_visible', 'user_action_statut_edit', 'user_action_blue_button', 'user_action_mpr_button', 'user_action_edit', 'pagination_number', 'filter_status', 'permission_regies', 'user_action_create'));
    }

    // Header Filter
    public function projectHeaderFilter(Request $request){

        if(!checkAction(Auth::id(), 'project', 'add_filter') && role() != 's_admin'){
            return back();
        }

        $existing_filter = ProjectHeaderFilter::where('user_id', Auth::id())->get();

        foreach($existing_filter as $item){
            $item->delete();
        }

        if($request->header_id){
            foreach($request->header_id as $id){
                ProjectHeaderFilter::create([
                    'project_header_id'  => $id,
                    'user_id'           => Auth::id(),
                ]);
            }
        }

        return back()->with('success', __('Filter Added'));
    }

    // Project Search
    public function projectSearch(Request $request){
        $headers = ProjectHeader::all();
        $filter_status =ProjectHeaderFilter::where('user_id', Auth::id())->orderBy('project_header_id', 'asc')->get();
        $column = $request->column;
        $search = $request->search;
        if($search != ''){
            if($request->status == '0'){
                $projects = Project::whereNull('user_status')->where('deleted_status', 'no')->where($column, 'LIKE' , "%$search%")->orderBy('id', 'desc')->get();
            }else{
                $projects = Project::where('deleted_status', 'no')->where('user_status', $request->status)->where($column, 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->get();
            }
        }
        else{
            if($request->status == '0'){

                $projects = Project::whereNull('user_status')->where('deleted_status', 'no')->orderBy('id', 'desc')->get();
            }else{
                $projects = Project::where('deleted_status', 'no')->where('user_status', $request->status)->orderBy('id', 'desc')->get();
            }
        }

        $item_data_id = $request->status;

        if($request->status == '0'){
            $view = view('admin.project-no-status', compact('projects', 'filter_status', 'item_data_id'));
        }else{
            $view = view('admin.project-by-status', compact('projects', 'filter_status', 'item_data_id'));
        }
        $response = $view->render();
        return response()->json(['response' => $response]);

    }

    // Update Comment
    public function updateProjectComment(Request $request){
        $data = Project::find($request->project_id);
        $data->comment = $request->comment;
        $data->save();

        return response()->json(['comment' => $data->comment, 'alert' => __('Comment Updated')]);
    }

    // Image Update
    public function updateProjectImage(Request $request){

        $data = Project::findOrFail($request->project_id);

        if($request->file('image')){

            $image = $request->file('image');
            $filename = $data->id . 'project.' . $image->extension('image');
            $location = public_path('uploads/crm/leads');
            $image->move($location, $filename);
            $data->image = $filename;
            $data->save();
        }

        return back()->with('success', __('Image Updated Successfully'));
    }

    // Tax create
    public function projectTaxUpdate(Request $request){
        $all_taxess = ProjectTax::where('project_id', $request->project_id)->get();

        // if(Tax::where('tax_number',$request->tax_number)->where('tax_reference', $request->tax_reference)->exists()){
        //     return response()->json(['error' => __('This fiscal and reference notice already exists')]);
        // }
        // else{
            function downloadPage( $sURL,
            $iConnectionTimeOut = 110,
            $iTimeOut = 110,
            $aHeaders = array(),
            $sPostData = '')
            {
            $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
            $sContent = '';
            $ch = curl_init();
            !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
            !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';
            if(!empty($sPostData))
            {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
            }
            curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
            curl_setopt($ch, CURLOPT_URL, $sURL);
            curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            $sContent = curl_exec($ch);
            $aInfo = curl_getinfo($ch);
            curl_close($ch);
            $sContent = str_replace("\t","",$sContent);
            $sContent = str_replace("\r","",$sContent);
            $sContent = str_replace("\n","",$sContent);
            return $sContent;
            }
            $sFiscal  = $request->tax_number;
            $sFacture  = $request->tax_reference;
            $aAnswer = [];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage($sURL);
            preg_match("/name=\"javax.faces.ViewState\" id=\"j_id__v_0:javax.faces.ViewState:1\" value=\"(.*?)\"/",$sHTML,$aData);
            $sViewState = isset($aData[1])?$aData[1]:'';
            $sPost = 'j_id_7%3Aspi='.$sFiscal.'&j_id_7%3Anum_facture='.$sFacture.'&j_id_7%3Aj_id_l=Valider&j_id_7_SUBMIT=1&javax.faces.ViewState='.urlencode($sViewState);
            $aHeaders = ['Host: cfsmsp.impots.gouv.fr',
                        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language: en-GB,en;q=0.5',
                        'Accept-Encoding: gzip, deflate, br',
                        'Referer: https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf',
                        'Content-Type: application/x-www-form-urlencoded',
                        'Origin: https://cfsmsp.impots.gouv.fr',
                        'DNT: 1',
                        'Connection: keep-alive',
                        'Upgrade-Insecure-Requests: 1',
                        'Sec-Fetch-Dest: document',
                        'Sec-Fetch-Mode: navigate',
                        'Sec-Fetch-Site: same-origin',
                        'Sec-Fetch-User: ?1'];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage( $sURL,110,110,[],$sPost);
            /*Parse Data*/

            preg_match('/<td class="labelImpair">Nom de naissance\s*<\/td>\s*<td class="labelImpair">(.*?)<\/td>\s*<td class="labelImpair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['declarant_2'] = isset($aData[2])?trim($aData[2]):'';

            preg_match('/<td class="labelPair">Nom\s*<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['noms_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['noms_declarant_2'] = isset($aData[2])?trim($aData[2]):'';


            preg_match('/<td class="labelPair">Prénom\(s\)\s*<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['prenoms_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['prenoms_declarant_2'] = isset($aData[2])?trim($aData[2]):'';


            preg_match('/<td class="labelImpair">Date de naissance\s*<\/td>\s*<td class="labelImpair">(.*?)<\/td>\s*<td class="labelImpair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['date_de_naissance_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['date_de_naissance_declarant_2'] = isset($aData[2])?trim($aData[2]):'';



            preg_match('/Adresse déclarée au (.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<\/tr>\s*<tr>\s*<td class=\"labelPair\">\s*<\/td>\s*<td colspan=\"2\" class=\"labelPair\">(.*?)<\/td>\s*<\/tr>/', $sHTML, $aData);


            $aAnswer['address_date'] = isset($aData[1])?trim(strip_tags($aData[1])):'';
            $aAnswer['address_1'] = isset($aData[2])?trim($aData[2]):'';
            $aAnswer['address_2'] = isset($aData[4])?trim($aData[4]):'';

            preg_match('/Date de mise en recouvrement de l\'avis d\'impôt\s*<\/td>\s*<td class=\"textPair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['date_recouvrement'] = isset($aData[1])?trim($aData[1]):'';

            preg_match('/Date d\'établissement\s*<\/td>\s*<td class=\"textImpair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['date_of_establishment'] = isset($aData[1])?trim($aData[1]):'';

            preg_match('/Nombre de personne\(s\) à charge\s*<\/td>\s*<td class=\"textPair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['nombre_de_personnes'] = isset($aData[1])?trim($aData[1]):'';

            preg_match('/Revenu fiscal de référence\s*<\/td>\s*<td class=\"textImpair\">(.*?) €\s*<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['date_de_personnes'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',str_replace(' ','',$aData[1])):'';

            // $aJSONAnswer = json_encode($aAnswer);
            header('Content-type: application/json');
            // echo($aAnswer['declarant_1']);
            // echo($aAnswer['declarant_2']);
            // echo($aAnswer['noms_declarant_1']);
            // echo($aAnswer['noms_declarant_2']);
            // echo($aAnswer['prenoms_declarant_1']);
            // echo($aAnswer['prenoms_declarant_2']);
            // echo($aAnswer['address_1']);
            // echo($aAnswer['address_2']);
            // echo($aAnswer['nombre_de_personnes']);
            // echo($aAnswer['date_de_personnes']);

            if($aAnswer['prenoms_declarant_1'] && $aAnswer['date_de_personnes']){
                $city = explode(' ', $aAnswer['address_2']);
                $location =  self::location($aAnswer['address_1']);
                array_shift($city);
                $taxx =  ProjectTax::create([
                    'project_id'        => $request->project_id,
                    'tax_number'        => $request->tax_number,
                    'tax_reference'     => $request->tax_reference,
                    'first_name'        => $aAnswer['prenoms_declarant_1'],
                    'last_name'         => $aAnswer['noms_declarant_1'],
                    'second_first_name' => $aAnswer['prenoms_declarant_2'] ?? null,
                    'second_last_name'  => $aAnswer['noms_declarant_2'] ?? null,
                    'kids'              => $aAnswer['nombre_de_personnes'] ?? 0,
                    'pays'              => $aAnswer['date_de_personnes'],
                    // 'city'              => getCity(substr($aAnswer['address_2'], 0,5)),
                    'city'              => implode(' ', $city),
                    'department'        => getDepartment2(substr($aAnswer['address_2'], 0,5)),
                    'postal_code'       => substr($aAnswer['address_2'], 0,5),
                    'address'           => $aAnswer['address_1'] . ' ' .$aAnswer['address_2'],
                    'address2'          => $aAnswer['address_1'],
                    'google_address'    => $aAnswer['address_1'],
                    'latitude'          => $location['status'] == 'success' ? $location['lat']:'',
                    'longitude'         => $location['status'] == 'success' ? $location['lng']:'',
                    'user_id'           => Auth::id(),
                ]);
                if($taxx->second_first_name){
                    $person = 2 + $taxx->kids;
                }
                else{
                    $person = 1 + $taxx->kids;
                }
                $MaPrimeRénov = Http::get('http://13.39.59.11:3000/api/scrap?family_name='.$aAnswer['prenoms_declarant_1'].'&dob='.$aAnswer['date_de_naissance_declarant_1'].'&tax_number='.$sFiscal.'&ref_tax_income='.$aAnswer['date_de_personnes']);

                $taxx->family_person = $person;
                $taxx->MaPrimeRénov_status = json_decode($MaPrimeRénov->getBody()->getContents())->status;
                $project = NewProject::find($request->project_id);
                if($all_taxess->count() > 0)
                {
                    $taxx->primary = 'no';
                }
                else{

                    $taxx->primary = 'yes';
                    $taxx->mark_check = 'yes';
                    $taxx->save();
                    $project->Prenom                        = $taxx->first_name;
                    $project->Nom                           = $taxx->last_name;
                    $project->Revenue_Fiscale_de_Référence  = $taxx->pays;
                    $project->Nombre_de_personnes           = $person;
                    $project->Ville                         = $taxx->city;
                    $project->Code_Postal                   = $taxx->postal_code;
                    $project->Département                   = getDepartment3($taxx->postal_code);
                    $project->zone                          = getPrimaryZone($taxx->postal_code);
                    if($project->precariousness_year == '2023'){
                        $project->precariousness                = getPrecariousness($person, $taxx->pays, $taxx->postal_code);
                    }else{
                        $project->precariousness                = getPrecariousness2024($person, $taxx->pays, $taxx->postal_code);
                    }
                    $project->Adresse                       = $taxx->address2;
                    $project->Complément_adresse            = $taxx->address;
                    $project->latitude                      = $taxx->latitude;
                    $project->longitude                     = $taxx->longitude;

                    $project->save();
                }

                $taxx->save();


                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => "Avis d'impôt",
                    'key'           => "Numéro d'exercice",
                    'value'         => $taxx->tax_number,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
                $pannel_activity =  PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => "Avis d'impôt",
                    'key'           => "Avis de référence",
                    'value'         => $taxx->tax_reference,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));


                    $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
                    $activity_log = view('includes.crm.activity-log', compact('activities'));
                    $activity = $activity_log->render();

                    $tax = ProjectTax::where('project_id', $request->project_id)->orderBy('primary', 'asc')->get();
                    $primary_tax = ProjectTax::where('project_id', $request->project_id)->where('primary', 'yes')->first();
                    $type = 'collapse_personal_information';
                    $data = NewProject::find($request->project_id);
                    $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
                    $tax_all = $all_taxes->render();
                    // $tax = Tax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
                    $all_taxes_data = view('includes.crm.project-tax', compact('tax'));
                    $tax_all_data = $all_taxes_data->render();
                    $all_taxes_data2 = view('includes.crm.project-tax-info', compact('tax'));
                    $tax_all_data2 = $all_taxes_data2->render();
                    return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'),'address' => $taxx->address,'fiscal_amount' => $project->Revenue_Fiscale_de_Référence,'family_person' => $person, 'zone' => getPrimaryZone($taxx->postal_code),'precariousness' => $project->precariousness, 'city' => getDepartment($taxx->postal_code), 'name' => $taxx->first_name.' '.$taxx->last_name, 'email' => $taxx->email, 'phone' => $taxx->phone, 'primary'=> $taxx->primary, 'log' => $activity]);
                    // return response('tax added successfully');
            }
            else{
                return response()->json(['error' => __('Wrong fiscal number and reference notice')]);
            }
        // }
    }

    // Info update
    public function taxProjectInfoUpdate(Request $request){

        $tax = ProjectTax::find($request->tax_id);
        $project = NewProject::find($request->project_id);
        // $tax->update($request->except('_token','tax_id','lead_id','company_id', 'project_id', 'custom_field_data'));

        $tax->phone  = $request->phone;
        $tax->email  = $request->email;
        $tax->telephone  = $request->telephone;
        $tax->postal_code  = $request->postal_code;
        $tax->city  = $request->city;
        $tax->title  = $request->title;
        $tax->first_name  = $request->first_name;
        $tax->last_name  = $request->last_name;
        $tax->second_title  = $request->second_title;
        $tax->second_first_name  = $request->second_first_name;
        $tax->second_last_name  = $request->second_last_name;
        $tax->observations  = $request->observations;
        // if($tax->same_as_work_address  != $request->same_as_work_address){
        $tax->same_as_work_address  = $request->same_as_work_address;
        $tax->google_address  = $request->google_address;

        if($request->same_as_work_address == 'no'){
            $tax->Adresse_Travaux  = $request->Adresse_Travaux;
            $tax->Complément_adresse_Travaux  = $request->Complément_adresse_Travaux;
            $tax->Code_postal_Travaux  = $request->Code_postal_Travaux;
            $tax->Ville_Travaux  = $request->Ville_Travaux;
        }else{
            $tax->Adresse_Travaux  = '';
            $tax->Complément_adresse_Travaux  = '';
            $tax->Code_postal_Travaux  = '';
            $tax->Ville_Travaux  = '';
        }
        if($request->google_address){
            $location = self::location($request->google_address);
            $tax->latitude  = $location['status'] == 'success' ? $location['lat']:'';
            $tax->longitude  = $location['status'] == 'success' ? $location['lng']:'';
        }

        $tax->address  = $request->address;
        $tax->address2  = $request->address2;
        $tax->save();

        foreach($tax->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Informations personnelles',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->personal_info_custom_field_data = $json;
            $project->save();
        }



        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        $tax = ProjectTax::find($request->tax_id);

        if($tax->primary == 'yes'){

            $project = NewProject::find($request->project_id);
            $project->Titre       = $tax->title;
            $project->Prenom       = $tax->first_name;
            $project->Nom        = $tax->last_name;
            $project->Email            = $tax->email;
            $project->phone            = $tax->phone;
            $project->fixed_number       = $tax->telephone;
            $project->latitude            = $tax->latitude;
            $project->longitude            = $tax->longitude;
            if($tax->same_as_work_address == 'no'){
                $project->Ville             = $tax->Ville_Travaux;
                $project->Code_Postal       = $tax->Code_postal_Travaux;
                $project->Zone              = getPrimaryZone($tax->Code_postal_Travaux);
                $project->Adresse           = $tax->Adresse_Travaux;
                $project->Complément_adresse= $tax->Complément_adresse_Travaux;
                $project->Département       = getDepartment3($tax->Code_postal_Travaux);
                if($project->precariousness_year == '2023'){
                    $project->precariousness    = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                }else{
                    $project->precariousness    = getPrecariousness2024($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                }
                $project->save();
                $zone_type = 'Zone_Hors_IDF';
                if($project->Code_Postal){
                    if(\App\Models\CRM\CheckZone::where('postal_code', substr($project->Code_Postal, 0,2))->exists()){
                        $zone_type = 'Zone_IDF';
                    }
                }
                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' => getDepartment($tax->Code_postal_Travaux), 'zone' => $project->Ville, 'precariousness' => $project->precariousness, 'department' =>getDepartment2($tax->Code_postal_Travaux), 'address' => $tax->Adresse_Travaux, 'postal_code' => $tax->Code_postal_Travaux, 'ville' => $tax->Ville_Travaux, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
            }else{
                $project->Ville             = $tax->city;
                $project->Code_Postal       = $tax->postal_code;
                $project->Zone              = getPrimaryZone($tax->postal_code);
                $project->Adresse           = $tax->address2;
                $project->Complément_adresse= $tax->address;
                $project->Département       = getDepartment3($tax->postal_code);
                if($project->precariousness_year == '2023'){
                    $project->precariousness   = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $tax->postal_code);
                }else{
                    $project->precariousness   = getPrecariousness2024($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $tax->postal_code);
                }
                $project->save();

                $zone_type = 'Zone_Hors_IDF';
                if($project->Code_Postal){
                    if(\App\Models\CRM\CheckZone::where('postal_code', substr($project->Code_Postal, 0,2))->exists()){
                        $zone_type = 'Zone_IDF';
                    }
                }

                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' => getDepartment($tax->postal_code), 'zone' => $project->Ville, 'precariousness' => $project->precariousness, 'department' =>getDepartment2($tax->postal_code), 'address' => $tax->address2, 'postal_code' => $tax->postal_code, 'ville' => $tax->city, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
            }
        }else{
            return response()->json(['alert' => __('Info Updated Successfully'), 'log' => $activity, 'loggleAddress' => urlencode($request->google_address)]);
        }

    }

    // Status Change
    public function taxProjectPrimaryUpdate(Request $request){

        $all_tax = ProjectTax::where('project_id', $request->project_id)->get();
        foreach($all_tax as $tax){
            $tax->primary = 'no';
            $tax->save();
        }

        $taxe = ProjectTax::find($request->tax_id);

            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Information Personnel',
                'block_name'    => 'Tax Notice',
                'key'           => $taxe->tax_number,
                'value'         => 'primary',
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));


        // if($taxe->second_first_name){
        //     $person = 2 + $taxe->kids;
        // }
        // else{
        //     $person = 1 + $taxe->kids;
        // }
        $taxe->primary = 'yes';
        $taxe->save();
        $project = NewProject::find($request->project_id);
        $project->Prenom       = $taxe->first_name;
        $project->Nom          = $taxe->last_name;
        $project->Ville        = $taxe->city;
        if($taxe->same_as_work_address == 'no'){ 
            $project->Code_Postal      = $taxe->Code_postal_Travaux;
            $project->Zone             = getPrimaryZone($taxe->Code_postal_Travaux);
            $project->Adresse           = $taxe->Adresse_Travaux;
            $project->Complément_adresse= $taxe->Complément_adresse_Travaux;
            $project->Département       = getDepartment3($taxe->Code_postal_Travaux);
            if($project->precariousness_year == '2023'){
                $project->precariousness   = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
            }else{
                $project->precariousness   = getPrecariousness2024($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
            }
        }else{ 
            $project->Code_Postal      = $taxe->postal_code;
            $project->Zone             = getPrimaryZone($taxe->postal_code);
            $project->Adresse           = $taxe->address2;
            $project->Complément_adresse= $taxe->address;
            $project->Département       = getDepartment3($taxe->postal_code);
            if($project->precariousness_year == '2023'){
                $project->precariousness   = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $taxe->postal_code);
            }else{
                $project->precariousness   = getPrecariousness2024($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $taxe->postal_code);
            }
        };
        
        if($taxe->google_address){
            $location = self::location($taxe->google_address);
            $project->latitude  = $location['status'] == 'success' ? $location['lat']:'';
            $project->longitude  = $location['status'] == 'success' ? $location['lng']:'';
        }

        $project->Email            = $taxe->email;
        $project->phone            = $taxe->phone;
        $project->save();

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        $tax = ProjectTax::where('project_id', $request->project_id)->orderBy('primary', 'asc')->get();
        $primary_tax = ProjectTax::where('project_id', $request->project_id)->where('primary', 'yes')->first();
        $type = 'collapse_personal_information';
        $data = NewProject::find($request->project_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render();

        return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $project->Complément_adresse, 'address2' => $project->Adresse, 'zone' => $project->Zone,'precariousness' => $project->precariousness, 'city' =>getDepartment($project->Code_Postal), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone, 'log' => $activity]);

    }

    // Work Update
    public function projectWorkUpdate(Request $request){

        $project = NewProject::findOrFail($request->project_id);
        $project->Type_occupation                  = $request->Type_occupation;
        $project->Parcelle_cadastrale              = $request->Parcelle_cadastrale;
        $project->Nombre_de_foyer                  = $request->Nombre_de_foyer;
        $project->Age_du_bâtiment                  = $request->Age_du_bâtiment;
        $project->Type_habitation                  = $request->Type_habitation;
        // $project->Revenue_Fiscale_de_Référence     = $request->Revenue_Fiscale_de_Référence;
        // $project->Nombre_de_personnes              = $request->Nombre_de_personnes;
        $project->Zone                             = $request->Zone; 
        // $project->precariousness_year              = $request->precariousness_year;  
        // if($request->precariousness_year == '2023'){
        //     $project->precariousness                   = getPrecariousness($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $project->Code_Postal);
        // }else{
        //     $project->precariousness                   = getPrecariousness2024($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $project->Code_Postal);
        // }
        $project->save();


        foreach($project->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Eligibility',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->eligibility_custom_field_data = $json;
            $project->save();
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Project Eligibility Updated'),  'log' => $activity, 'precariousness' => $project->precariousness]);
    }


    // Work site update
    public function projectPresentWorkUpdate(Request $request){

        $project = NewProject::find($request->project_id);
        $project->Type_de_logement                                                 = $request->Type_de_logement;
        $project->Type_de_chauffage                                                = $request->Type_de_chauffage;
        $project->Mode_de_chauffage                                                = $request->Mode_de_chauffage;
        $project->Date_construction_maison                                         = $request->Date_construction_maison;
        $project->Surface_habitable                                                = $request->Surface_habitable;
        $project->Consommation_chauffage_annuel                                    = $request->Consommation_chauffage_annuel;
        $project->Surface_à_chauffer                                               = $request->Surface_à_chauffer;
        $project->Mode_de_chauffage__a__                                           = $request->Mode_de_chauffage__a__;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__  = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
        $project->Consommation_Chauffage_Annuel_2                                  = $request->Consommation_Chauffage_Annuel_2;
        $project->Depuis_quand_occupez_vous_le_logement                            = $request->Depuis_quand_occupez_vous_le_logement;
        $project->auxiliary_heating_status                                         = $request->auxiliary_heating_status;
        $project->second_heating_generator_status                                  = $request->second_heating_generator_status;
        $project->auxiliary_heating                                                = $request->auxiliary_heating;
        $project->auxiliary_heating__a__                                           = $request->auxiliary_heating__a__;
        $project->second_heating_generator                                         = $request->second_heating_generator;
        $project->second_heating_generator__a__                                    = $request->second_heating_generator__a__;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement       = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
        $project->Production_dapostropheeau_chaude_sanitaire                       = $request->Production_dapostropheeau_chaude_sanitaire;
        $project->Instantanné                                                      = $request->Instantanné;
        $project->Accumulation                                                     = $request->Accumulation;
        $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude               = $request->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
        $project->Information_logement_observations                                = $request->Information_logement_observations;
        $project->Préciser_le_type_de_radiateurs_Aluminium                         = $request->Préciser_le_type_de_radiateurs_Aluminium;
        $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs    = $request->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Fonte                             = $request->Préciser_le_type_de_radiateurs_Fonte;
        $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Acier                             = $request->Préciser_le_type_de_radiateurs_Acier;
        $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre                             = $request->Préciser_le_type_de_radiateurs_Autre;
        $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre___a__                       = $request->Préciser_le_type_de_radiateurs_Autre___a__;
        $project->Type_du_courant_du_logement                                      = $request->Type_du_courant_du_logement;
        $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude   = $request->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
        $project->Instantanné_Merci_de_préciser                                    = $request->Instantanné_Merci_de_préciser;  
        $project->Accumulation_Merci_de_préciser                                   = $request->Accumulation_Merci_de_préciser;
        $project->Le_logement_possède_un_réseau_hydraulique                        = $request->Le_logement_possède_un_réseau_hydraulique;    
        $project->auxiliary_heating__Insert_à_bois_Nombre                        = $request->auxiliary_heating__Insert_à_bois_Nombre;    
        $project->auxiliary_heating__Poêle_à_bois_Nombre                        = $request->auxiliary_heating__Poêle_à_bois_Nombre;    
        $project->auxiliary_heating__Poêle_à_gaz_Nombre                        = $request->auxiliary_heating__Poêle_à_gaz_Nombre;    
        $project->auxiliary_heating__Convecteur_électrique_Nombre                        = $request->auxiliary_heating__Convecteur_électrique_Nombre;    
        $project->auxiliary_heating__Sèche_serviette_Nombre                        = $request->auxiliary_heating__Sèche_serviette_Nombre;    
        $project->auxiliary_heating__Panneau_rayonnant_Nombre                        = $request->auxiliary_heating__Panneau_rayonnant_Nombre;    
        $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                        = $request->auxiliary_heating__Radiateur_bain_dhuile_Nombre;    
        $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                        = $request->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;    
        $project->auxiliary_heating__Autre_Nombre                        = $request->auxiliary_heating__Autre_Nombre;    
        $project->save();


        foreach($project->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Chantier de travail',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->information_logement_custom_field_data = $json;
            $project->save();
        }

       $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
       $activity_log = view('includes.crm.activity-log', compact('activities'));
       $activity = $activity_log->render();



        return response()->json(['alert' => __('Project Work Info Updated'), 'log' => $activity]);

    }

    // Foyer Update
    public function projectFoyerUpdate(Request $request){
        $project = NewProject::find($request->project_id);
        if($request->birth_name){
            foreach($request->birth_name as $key => $value){
                if($value){
                    Children::create([
                        'name'          => $value,
                        'birth_date'    => $request->birth_date[$key],
                        'project_id'    => $project->id,
                        'created_by'    => Auth::id(),
                    ]);
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Situation foyer',
                        'key'           => 'Nom',
                        'value'         => $value,
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Situation foyer',
                        'key'           => 'Date De Naissance',
                        'value'         => $request->birth_date[$key],
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }

            // Children::create([
            //     'name'          => $request->birth_name,
            //     'birth_date'    => $request->birth_date,
            //     'project_id'    => $project->id,
            //     'created_by'    => Auth::id(),
            // ]);
            // $pannel_activity = PannelLogActivity::create([
            //     'tab_name'      => 'Client',
            //     'block_name'    => 'Situation foyer',
            //     'key'           => 'Nom',
            //     'value'         => $request->birth_name,
            //     'feature_id'    => $request->project_id,
            //     'feature_type'  => 'project',
            //     'user_id'       => Auth::id(),
            // ]);
            // event(new PannelLog($pannel_activity->id));
            // $pannel_activity = PannelLogActivity::create([
            //     'tab_name'      => 'Client',
            //     'block_name'    => 'Situation foyer',
            //     'key'           => 'Date De Naissance',
            //     'value'         => $request->birth_date,
            //     'feature_id'    => $request->project_id,
            //     'feature_type'  => 'project',
            //     'user_id'       => Auth::id(),
            // ]);
            // event(new PannelLog($pannel_activity->id));

        }
        $project->update($request->except(['_token','project_id', 'birth_name', 'birth_date', 'custom_field_data']));


        foreach($project->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Situation foyer',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->situation_foyer_custom_field_data = $json;
            $project->save();
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        $childrens = Children::where('project_id', $project->id)->get();

        $child = view('includes.crm.children', compact('childrens'));

        $child_rander = $child->render();

        return response()->json(['alert' => __('Updated Successfully'), 'children' => $child_rander, 'log' => $activity]);
    }

    // Trait update
    public function projectTraitUpdate(Request $request){

        $trait = ProjectTrait::where('project_id', $request->project_id)->first();
        $trait->previsite = $request->previsite;
        $trait->projet_valide = $request->projet_valide;
        $trait->devis_signe = $request->devis_signe;
        $trait->project_charge = $request->project_charge;
        $trait->additional_work = $request->additional_work;
        $trait->additional_work_payable = $request->additional_work_payable;
        $trait->user_id  = Auth::id();
        $trait->save();


        $data = $request->except(['_token', 'project_id']);
        foreach($data as $key =>$value)
        {
             if(!PannelLogActivity::where('tab_name',  'Section Projet')->where('block_name', 'TRAIT')->where('key', $key)->where('value', $value)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
             {
                 $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section Projet',
                     'block_name'    => 'TRAIT',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();


        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);


    }

    // Intervention Update
    public function projectInterventionUpdate(Request $request){

        $data = Intervention::where('project_id', $request->project_id)->first();
        $data->preview_date = $request->preview_date;
        $data->schedule = $request->schedule;
        $data->status = $request->status;
        $data->comments = $request->comments;
        $data->user_id = Auth::id();
        $data->save();

        foreach($data->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section Previsite',
                    'block_name'    => 'Intervention PREV',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $p_user = '';

        $project_users = ProjectUser::where('project_id', $request->project_id)->get();
        if($project_users->count() > 0){
            foreach($project_users as $user){
                $user->delete();
            }
        }
        if($request->project_user){
            $count = count($request->project_user);
            foreach($request->project_user as $key => $user){
                ProjectUser::create([
                    'project_id' => $request->project_id,
                    'user_id'    => $user,
                ]);
                $p_user .= $user. ($count != $key+1 ? ',':'');
            }
        }

        if(!PannelLogActivity::where('tab_name',  'Section Previsite')->where('block_name', 'Intervention PREV')->where('key', 'Techniciens')->where('value', $p_user)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
            {
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section Previsite',
                    'block_name'    => 'Intervention PREV',
                    'key'           => 'Techniciens',
                    'value'         => $p_user,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();


        Project::find($request->project_id)->update([
            'status' => $request->status,
        ]);

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);

    }

    // Repport Update
    public function projectReportUpdate(Request $request){
        $report = Rapport::where('project_id', $request->project_id)->first();
        $report->update($request->except('_token', 'project_id', 'report_list') + ['user_id' => Auth::id()]);
        foreach($report->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section Previsite',
                    'block_name'    => 'Rapport',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }
        $selected = '';
        if($request->report_list){
            $count = count($request->report_list);
            foreach($request->report_list as $key => $report_list)
            {
                $selected .= $report_list. ($count != $key+1 ? ',':'');
            }

            $report->report_list = $selected;
            $report->save();
                 if(!PannelLogActivity::where('tab_name',  'Section Previsite')->where('block_name', 'Rapport')->where('key', 'rapport__list')->where('value', $selected)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
                {
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Section Previsite',
                        'block_name'    => 'Rapport',
                        'key'           => 'rapport__list',
                        'value'         => $selected,
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

    // subvention update
    public function projectSubventionUpdate(Request $request){
        $info = Information::where('project_id', $request->project_id)->first();
        $info->update($request->except('_token', 'project_id', 'subvention_deposited_work') + ['user_id' => Auth::id()]);
        $selected = '';
        $count = count($request->subvention_deposited_work);
        foreach($request->subvention_deposited_work as $key => $subvention_deposited_work)
        {
            $selected .= $subvention_deposited_work. ($count != $key+1 ? ',':'');
        }
        $info->subvention_deposited_work = $selected;
        $info->save();
        $data = $request->except(['_token', 'project_id', 'subvention_deposited_work']);
        foreach($data as $key =>$value)
        {
             if(!PannelLogActivity::where('tab_name',  'Section MAPRIMERENOV')->where('block_name', 'subvention')->where('key', $key)->where('value', $value)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
             {

                $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section MAPRIMERENOV',
                     'block_name'    => 'subvention',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

    // Information Update
    public function projectInformationUpdate(Request $request){

        $project = NewProject::find($request->project_id);

        $project->Date_de_dépôt_MyMPR                           = $request->Date_de_dépôt_MyMPR;
        $project->N_Dossier_MPR_hyphen_MyMPR                    = $request->N_Dossier_MPR_hyphen_MyMPR;
        $project->Montant_subvention_prévisionnel_hyphen_MyMPR  = $request->Montant_subvention_prévisionnel_hyphen_MyMPR;
        $project->Travaux_deposés_hyphen_MyMPR                  = $request->Travaux_deposés_hyphen_MyMPR;
        $project->Statut_1_hyphen_MyMPR                         = $request->Statut_1_hyphen_MyMPR;
        $project->Statut_2_hyphen_MyMPR                         = $request->Statut_2_hyphen_MyMPR;
        $project->Adresse_hyphen_MyMPR                          = $request->Adresse_hyphen_MyMPR;
        $project->save();

        $montant_disponible = '';
        if($project->Statut_1_hyphen_MyMPR == 'Demande de solde' && $project->Statut_2_hyphen_MyMPR == 'Acceptée pour paiement'){
            $montant_disponible = EuroFormat(20000 - $project->Montant_subvention_prévisionnel_hyphen_MyMPR);
        }

        foreach($project->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section MAPRIMERENOV',
                    'block_name'    => 'Suivi MPR',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $project->mpr_updated_at = Carbon::now();
        $project->save();

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->myprimempr_custom_field_data = $json;
            $project->save();
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'updated_at' => Carbon::parse($project->mpr_updated_at)->format('d/m/Y, H:i'), 'montant_disponible' => $montant_disponible]);
    }

    public function projectInformationUpdate2(Request $request){

        $project = NewProject::find($request->project_id);

        $project->Date_de_dépôt_MyMPR                           = $request->Date_de_dépôt_MyMPR;
        $project->N_Dossier_MPR_hyphen_MyMPR                    = $request->N_Dossier_MPR_hyphen_MyMPR;
        $project->Montant_subvention_prévisionnel_hyphen_MyMPR  = $request->Montant_subvention_prévisionnel_hyphen_MyMPR;
        $project->Travaux_deposés_hyphen_MyMPR                  = $request->Travaux_deposés_hyphen_MyMPR;
        $project->Statut_1_hyphen_MyMPR                         = $request->Statut_1_hyphen_MyMPR;
        $project->Statut_2_hyphen_MyMPR                         = $request->Statut_2_hyphen_MyMPR;
        $project->Adresse_hyphen_MyMPR                          = $request->Adresse_hyphen_MyMPR;
        $project->save();

        $montant_disponible = '';
        if($project->Statut_1_hyphen_MyMPR == 'Demande de solde' && $project->Statut_2_hyphen_MyMPR == 'Acceptée pour paiement'){
            $montant_disponible = EuroFormat(20000 - $project->Montant_subvention_prévisionnel_hyphen_MyMPR);
        }

        foreach($project->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section MAPRIMERENOV',
                    'block_name'    => 'Suivi MPR',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $project->mpr_updated_at = Carbon::now();
        $project->save();

      
        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'updated_at' => Carbon::parse($project->mpr_updated_at)->format('d/m/Y, H:i'), 'montant_disponible' => $montant_disponible]);
    }

    // Information2 Update
    public function projectInformation2Update(Request $request){
        $data = '';
        if($request->Travaux_déposés){
            $data = implode(',', $request->Travaux_déposés);
        }
        $info = NewProject::find($request->project_id);
        $info->update($request->except(['_token', 'project_id', 'Travaux_déposés', 'custom_field_data']) + ['user_id' => Auth::id(), 'Travaux_déposés' => $data]);
        foreach($info->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section Action Logement',
                    'block_name'    => 'Information 2',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $info->subvention_custom_field_data = $json;
            $info->save();
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

     // Intervention installation Update
     public function projectInterventionInstallationUpdate(Request $request){

        $data = InterventionInstallation::where('project_id', $request->project_id)->first();
        $data->update($request->except('_token', 'project_id', 'project_equipe_user') + ['user_id' => Auth::id()]);

        foreach($data->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Section Installation',
                    'block_name'    => 'Intervention INST',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $project_users = ProjectEquipeUser::where('project_id', $request->project_id)->get();
        if($project_users->count() > 0){
            foreach($project_users as $user){
                $user->delete();
            }
        }

        $p_user = '';
        if($request->project_equipe_user){
            $count = count($request->project_equipe_user);
            foreach($request->project_equipe_user as $key => $user){
                ProjectEquipeUser::create([
                    'project_id' => $request->project_id,
                    'user_id'    => $user,
                ]);
                $p_user .= $user. ($count != $key+1 ? ',':'');
            }
        }

        if(!PannelLogActivity::where('tab_name',  'Section Installation')->where('block_name', 'Intervention INST')->where('key', 'project_equipe_user')->where('value', $p_user)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
        {
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Section Installation',
                'block_name'    => 'Intervention INST',
                'key'           => 'project_equipe_user',
                'value'         => $p_user,
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();




        Project::find($request->project_id)->update([
            'status' => $request->status
        ]);

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

    // Report 2 Update
    public function projectReport2Update(Request $request){
        $data = SecondReport::where('project_id', $request->project_id)->first();
        $data->update($request->except('_token', 'project_id') + ['user_id' => Auth::id()]);

        foreach($data->getChanges() as $key =>$value)
        {
             if($key != 'updated_at' && $key != 'user_id')
             {
                 $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section Installation',
                     'block_name'    => 'Rapport 2',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

        // Travaux Update
    public function projectTravauxUpdate(Request $request){
        $project = NewProject::find($request->project_id);
        $project->update($request->except('_token', 'project_id', 'product','bareme', 'travaux', 'tag_product', 'surface', 'custom_field_data', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement', 'Nombre_de_pièces_dans_le_logement')); 
            foreach($project->getChanges() as $key => $value){
                if($key != 'updated_at' && $key != 'user_id'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Projet',
                        'block_name'    => 'Projet',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }


        if($request->travaux){
            $travaux_list = array_merge($request->bareme,$request->travaux);
        }else{
            $travaux_list = $request->bareme;
        }
        // if(in_array(7, $request->bareme)){
            $project->ProjectTravauxTags()->sync($travaux_list);
        // }else{
        //     $project->ProjectTravauxTags()->sync($request->bareme);
        // }
        $project->ProjectBareme()->sync($request->bareme);
        $project->ProjectTravaux()->sync($travaux_list);
        ProjectTag::where('project_id', $project->id)->get()->each->delete();
        ProjectTagProduct::where('project_id', $project->id)->get()->each->delete();
        ProjectProductNombre::where('project_id', $project->id)->get()->each->delete();
        if($request->tag_product){
            foreach($request->tag_product as $tag => $product_arr){
                $tag_item = ProjectTag::create([
                    'project_id'    => $project->id,
                    'tag_id'        => $tag,
                    'surface'       => $request->surface[$tag] ?? '',
                    'Nombre_de_split'       => $request->Nombre_de_split[$tag] ?? '',
                    'Type_de_comble'       => $request->Type_de_comble[$tag] ?? '',
                    'marque'                => $request->marque[$tag] ?? null,
                    'shab'                => $request->shab[$tag] ?? null,
                    'Nombre_de_pièces_dans_le_logement'                => $request->Nombre_de_pièces_dans_le_logement[$tag] ?? null,
                    'Type_de_radiateur'                => $request->Type_de_radiateur[$tag] ?? null,
                    'Nombre_de_radiateurs_électrique'                => $request->Nombre_de_radiateurs_électrique[$tag] ?? null,
                    'Nombre_de_radiateurs_combustible'                => $request->Nombre_de_radiateurs_combustible[$tag] ?? null,
                    'Nombre_de_radiateur_total_dans_le_logement'                => $request->Nombre_de_radiateur_total_dans_le_logement[$tag] ?? null,
                    'Thermostat_supplémentaire'                => $request->Thermostat_supplémentaire[$tag] ?? null,
                    'Nombre_thermostat_supplémentaire'                => $request->Nombre_thermostat_supplémentaire[$tag] ?? null,
                    // 'Montant_TTC'   => $request->tag_product_price[$tag] ?? '',
                ]);
                if($product_arr){
                    foreach($product_arr as $product_id){
                        ProjectTagProduct::create([
                            'project_id'    => $project->id,
                            'tag_id'        => $tag_item->id,
                            'product_id'    => $product_id,
                        ]);
                    }
                }
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->project_custom_field_data = $json;
            $project->save();
        }

        
        if($request->tag_product_nombre){
            foreach($request->tag_product_nombre as $key => $value){
                $number = explode('__', $value);
                ProjectProductNombre::create([
                    'project_id' => $project->id,
                    'tag_id' => $number[0] ?? 0,
                    'product_id' => $key,
                    'number' => $number[1] ?? '',
                ]);
            }
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        $project_product = view('admin.project_product__list2', compact('project'))->render();
        $question = Question::where('project_id', $request->project_id)->first();
        $data = view('includes.crm.project_question', compact('project'));
        $question = $data->render();
        $tag_list = '';
        // dd($project->LeadBareme);
        foreach ($project->ProjectTravauxTags as $keys => $tagg){
                $tag_list .= '<span class="btn btn-sm rounded" style="border:1px solid #5a616a; background-color: #ffd966">'.$tagg->tag.'</span>';
        }
        return response()->json(['alert' => __('Updated Successfully'),'bon_de_commande' => $project->Bon_De_Commande_signé_le ? Carbon::parse($project->Bon_De_Commande_signé_le)->format('d-m-Y') : '' , 'questions' => $question, 'product'  => $project_product , 'log' => $activity,'tag' => $tag_list, 'maprime' =>MaPrimeRenovEstimatedAmount($project->Mode_de_chauffage, $project->precariousness,  ProjectBareme::where('project_id', $project->id)->pluck('barame_id')), 'cee' => CEEEstimatedAmount($project->Mode_de_chauffage, $project->precariousness,  ProjectBareme::where('project_id', $project->id)->pluck('barame_id')), 'lock_status' => $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? true : false]);
    }

    // Report 2 Update
    public function projectQuestionUpdate(Request $request){
        $data = Question::where('project_id', $request->project_id)->first();
        $data->update($request->except('_token', 'project_id') + ['user_id' => Auth::id()]);


        $data = $request->except(['_token', 'project_id']);
        foreach($data as $key =>$value)
        {
             if(!PannelLogActivity::where('tab_name',  'Section Projet')->where('block_name', 'Question')->where('key', $key)->where('value', $value)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
             {
                 $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section Projet',
                     'block_name'    => 'Question',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }
        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

    // Information Scrapping
    public function informationScrap(Request $request){
        Artisan::call('optimize:clear');

        function downloadPage( $sURL,
        $iConnectionTimeOut = 110,
        $iTimeOut = 110,
        $aHeaders = array(),
        $sPostData = '')
        {

        $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
        $sContent = '';
        $ch = curl_init();
        !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
        !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';
        if(!empty($sPostData))
        {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
        }
        curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
        curl_setopt($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
        curl_setopt($ch, CURLOPT_URL, $sURL);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        $sContent = curl_exec($ch);
        $aInfo = curl_getinfo($ch);
        curl_close($ch);
        $sContent = str_replace("\t","",$sContent);
        $sContent = str_replace("\r","",$sContent);
        $sContent = str_replace("\n","",$sContent);
        return $sContent;
        }

        $sUser      = $request->user_name;
        $sPassword  = $request->user_password;
        define('COOKIE_FILE','/cookie.txt');
        $aAnswers = [];
        $sURL = 'https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD?t='.strtotime("-1 day");
        $sPost = 'pzAuth=guest&UserIdentifier='.urlencode($sUser).'&Password='.urlencode($sPassword).'&pyActivity%3DCode-Security.Login=&lockScreenID=&lockScreenPassword=&newPassword=&confirmNewPassword=';
        $aHeaders = ['Host: www.maprimerenov.gouv.fr',
                    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language: en-GB,en;q=0.5',
                    'Accept-Encoding: gzip, deflate, br',
                    'Referer: https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Origin: https://www.maprimerenov.gouv.fr',
                    'DNT: 1',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
                    'Sec-Fetch-Dest: document',
                    'Sec-Fetch-Mode: navigate',
                    'Sec-Fetch-Site: same-origin',
                    'Sec-Fetch-User: ?1',
                    'TE: trailers'];
        $sHTML = downloadPage( $sURL,110,110,$aHeaders,$sPost);
        $sHTML = html_entity_decode($sHTML);
        preg_match_all("/<DIV class='oflowDiv'.*?>(.*?)<\/li>/",$sHTML,$aBlocks);
        if(isset($aBlocks[1][0]))
        {
            for($iBlock = 0; $iBlock < sizeof($aBlocks[1]); $iBlock++)
            {
                $aAnswer = [];
                $sBlock = $aBlocks[1][$iBlock];
                if(strpos($sBlock,'pyclassname')===false)
                {
                    continue;
                }
                preg_match("/Dossier .*?<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sBlock,$aData);
                $aAnswer['dossier'] = isset($aData[1])?$aData[1]:'';
                preg_match("/Travaux<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sBlock,$aData);
                $aAnswer['travaux'] = isset($aData[1])?$aData[1]:'';
                preg_match("/Adresse du logement à rénover<\/div><div.*?>(.*?)<\/div>/",$sBlock,$aData);
                $aAnswer['adresse'] = isset($aData[1])?strip_tags($aData[1]):'';

                preg_match_all("/RESERVE_SPACE='false'><span ><button   data-ctl='Button'.*?>(.*?)<\/button><\/span><\/div>/",$sBlock,$aData);
                $aAnswer['status_1'] = isset($aData[1][0])?$aData[1][0]:'';
                $aAnswer['status_2'] = isset($aData[1][1])?$aData[1][1]:'';

                preg_match("/Date limite de dépôt :<\/div><div.*?>(.*?)<\/div><\/div/",$sBlock,$aData);
                $aAnswer['date'] = isset($aData[1])?strip_tags($aData[1]):'';

                preg_match("/subvention<\/div><\/div><\/div><\/div><\/div><div.*?><span.*?><span.*?>(.*?)€<\/span><\/span><\/div><\/div>/",$sBlock,$aData);
                $aAnswer['price'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',$aData[1]):'';
                $aAnswers[] = $aAnswer;
            }
        }
        /*preg_match("/Dossier .*?<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['dossier'] = isset($aData[1])?$aData[1]:'';
        preg_match("/Travaux<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['travaux'] = isset($aData[1])?$aData[1]:'';
        preg_match("/Adresse du logement à rénover<\/div><div.*?>(.*?)<\/div>/",$sHTML,$aData);
        $aAnswer['adresse'] = isset($aData[1])?strip_tags($aData[1]):'';

        preg_match_all("/RESERVE_SPACE='false'><span ><button   data-ctl='Button'.*?>(.*?)<\/button><\/span><\/div>/",$sHTML,$aData);
        $aAnswer['status_1'] = isset($aData[1][0])?$aData[1][0]:'';
        $aAnswer['status_2'] = isset($aData[1][1])?$aData[1][1]:'';

        preg_match("/Date limite de dépôt :<\/div><div.*?>(.*?)<\/div><\/div/",$sHTML,$aData);
        $aAnswer['date'] = isset($aData[1])?strip_tags($aData[1]):'';

        preg_match("/subvention<\/div><\/div><\/div><\/div><\/div><div.*?><span.*?><span.*?>(.*?)€<\/span><\/span><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['price'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',$aData[1]):'';*/

        $aJSONAnswer = json_encode($aAnswers);
        header('Content-type: application/json');
        if(count($aAnswers) < 1){
            return response()->json(['error' => __('Wrong Credentials')]);
        }
         foreach($aAnswers as $myAnswer)
         {
            if(end($aAnswers) == $myAnswer) {
                return response()->json(['mpr_file' =>$myAnswer['dossier'], 'deposited_work' => $myAnswer['travaux'], 'address' => $myAnswer['adresse'], 'status_1'=> $myAnswer['status_1'], 'status_2' => $myAnswer['status_2'], 'deposit_date' => $myAnswer['date'], 'estimated_amount' =>  $myAnswer['price']]);
            }

         }

        // die();
    }

    // Info Scrap
    public function informationScrap_ddd(Request $request){
        Artisan::call('optimize:clear');

        function downloadPage( $sURL,
        $iConnectionTimeOut = 110,
        $iTimeOut = 110,
        $aHeaders = array(),
        $sPostData = '')
        {

        $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
        $sContent = '';
        $ch = curl_init();
        !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
        !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';
        if(!empty($sPostData))
        {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
        }
        curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
        curl_setopt($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
        curl_setopt($ch, CURLOPT_URL, $sURL);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        $sContent = curl_exec($ch);
        $aInfo = curl_getinfo($ch);
        curl_close($ch);
        $sContent = str_replace("\t","",$sContent);
        $sContent = str_replace("\r","",$sContent);
        $sContent = str_replace("\n","",$sContent);
        return $sContent;
        }



        $sUser      = $request->user_name;
        $sPassword  = $request->user_password;
        define('COOKIE_FILE','/cookie.txt');
        $aAnswer = [];
        $sURL = 'https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD?t='.strtotime("-1 day");
        $sPost = 'pzAuth=guest&UserIdentifier='.urlencode($sUser).'&Password='.urlencode($sPassword).'&pyActivity%3DCode-Security.Login=&lockScreenID=&lockScreenPassword=&newPassword=&confirmNewPassword=';
        $aHeaders = ['Host: www.maprimerenov.gouv.fr',
                    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language: en-GB,en;q=0.5',
                    'Accept-Encoding: gzip, deflate, br',
                    'Referer: https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Origin: https://www.maprimerenov.gouv.fr',
                    'DNT: 1',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
                    'Sec-Fetch-Dest: document',
                    'Sec-Fetch-Mode: navigate',
                    'Sec-Fetch-Site: same-origin',
                    'Sec-Fetch-User: ?1',
                    'TE: trailers'];
        $sHTML = downloadPage( $sURL,110,110,$aHeaders,$sPost);
        $sHTML = html_entity_decode($sHTML);
        /*Parse Data*/
        preg_match("/Dossier .*?<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['dossier'] = isset($aData[1])?$aData[1]:'';
        preg_match("/Travaux<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['travaux'] = isset($aData[1])?$aData[1]:'';
        preg_match("/Adresse du logement à rénover<\/div><div.*?>(.*?)<\/div>/",$sHTML,$aData);
        $aAnswer['adresse'] = isset($aData[1])?strip_tags($aData[1]):'';

        preg_match_all("/RESERVE_SPACE='false'><span ><button   data-ctl='Button'.*?>(.*?)<\/button><\/span><\/div>/",$sHTML,$aData);
        $aAnswer['status_1'] = isset($aData[1][0])?$aData[1][0]:'';
        $aAnswer['status_2'] = isset($aData[1][1])?$aData[1][1]:'';

        preg_match("/Date limite de dépôt :<\/div><div.*?>(.*?)<\/div><\/div/",$sHTML,$aData);
        $aAnswer['date'] = isset($aData[1])?strip_tags($aData[1]):'';

        preg_match("/subvention<\/div><\/div><\/div><\/div><\/div><div.*?><span.*?><span.*?>(.*?)€<\/span><\/span><\/div><\/div>/",$sHTML,$aData);
        $aAnswer['price'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',$aData[1]):'';

        $aJSONAnswer = json_encode($aAnswer);
        header('Content-type: application/json');
        // echo($aJSONAnswer);
        // die();

        return response()->json(['mpr_file' =>$aAnswer['dossier'], 'deposited_work' => $aAnswer['travaux'], 'address' => $aAnswer['adresse'], 'status_1'=> $aAnswer['status_1'], 'status_2' => $aAnswer['status_2'], 'deposit_date' => $aAnswer['date'], 'estimated_amount' =>  $aAnswer['price']]);
    }

    // Delete Activity Log
    public function activityLogDelete(Request $request){
        PannelLogActivity::find($request->id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    // Pre Installation
    public function projectPreInstallation(Request $request){

        // dd($request->all());
        $pre_installation = PreInstallation::where('project_id', $request->project_id)->first();

        $pre_installation->update($request->except('_token', 'project_id') + ['user_id' => Auth::id()]);

        $data = $request->except(['_token', 'project_id']);
        foreach($data as $key =>$value)
        {
             if(!PannelLogActivity::where('tab_name',  'Section CONTROLE QUALITE')->where('block_name', 'CQ Pre Installation')->where('key', $key)->where('value', $value)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
             {
                 $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section CONTROLE QUALITE',
                     'block_name'    => 'CQ Pre Installation',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }
        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);    }

    // Pre Installation
    public function projectPostInstallation(Request $request){

        // dd($request->all());
        $post_installation = PostInstallation::where('project_id', $request->project_id)->first();

        $post_installation->update($request->except('_token', 'project_id') + ['user_id' => Auth::id()]);

        $data = $request->except(['_token', 'project_id']);
        foreach($data as $key =>$value)
        {
             if(!PannelLogActivity::where('tab_name',  'Section CONTROLE QUALITE')->where('block_name', 'CQ Post Installation')->where('key', $key)->where('value', $value)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
             {
                 $pannel_activity = PannelLogActivity::create([
                     'tab_name'      => 'Section CONTROLE QUALITE',
                     'block_name'    => 'CQ Post Installation',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));
             }
        }
        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity]);
    }

    // Generate pdf
    public function generatePdf($id){


        $preInstallation = PreInstallation::where('project_id', $id)->first();
        return view('includes.crm.pre_pdf', compact('preInstallation'));
        // $pdf = PDF::loadView('includes.crm.pdf');
        // return $pdf->download('CQPreInstallation.pdf');
    }

    // Generate pdf
    public function generateDocument(Request $request){

        // ini_set('memory_limit', '256M');
        // set_time_limit(300);

        // $pdf = Pdf::loadView('admin.documents.pdf-test');

        // return $pdf->download('invoice.pdf');

        // return view('admin.documents.pdf-test');


        $document = Document::find($request->document);
        $project = NewProject::find($request->project_id);
        $data = $request->except(['_token', 'document','travaux']);
        if($request->travaux){
            $data['travaux'] = implode(', ', $request->travaux); 
        }
        if($document && $project){
            if($request->submit_type == 'pdf'){
                $pdf = Pdf::loadView('admin.documents.'.$document->view_name.'.index', compact('data'));
                //  dd($pdf);
                // $path = public_path('uploads/pdf-documents');
                // if(!File::exists($path)) {
                //     File::makeDirectory($path, 0777, true, true);
                // }
                // $pdf->save(public_path().'/uploads/pdf-documents/'.$document->name.'-'.time().'.pdf');
    
                return $pdf->download($document->name.'.pdf');
            }else{

                $pdf = Pdf::loadView('admin.documents.'.$document->view_name.'.index', compact('data'));
            
                $path = public_path('uploads/pdf-documents');
                if(!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $pdf_url = public_path().'/uploads/pdf-documents/'.$document->name.'-'.time().'.pdf';
                $pdf->save($pdf_url);

                // Signature code start    
            
                $baseUrl = 'https://api-sandbox.yousign.app/v3';
                $apiKey = 'P66EQU8q9OwpvwAuaStpga0G0d33CBjo';
                // $pdfDocumentPath = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';  // Pdf er download link dite hobe
                $pdfDocumentPath = $pdf_url;  // Pdf er download link dite hobe

                $curl = curl_init();

                // dd($curl);
                $name = ucwords($project->Prenom) .' '. ucwords($project->Nom);

                $data = <<<JSON
                {
                "name": "$name",
                "delivery_mode": "email",
                "timezone": "Europe/Paris"
                }
                JSON;
                curl_setopt_array($curl, [
                    CURLOPT_URL => sprintf('%s/signature_requests', $baseUrl),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_HTTPHEADER => [
                        sprintf('Authorization: Bearer %s', $apiKey),
                        'Content-Type: application/json'
                    ],
                ]);
                
                $initiateSignatureRequestResponse = curl_exec($curl);
                $signatureRequest = json_decode($initiateSignatureRequestResponse, true);
                $signatureRequestId = $signatureRequest['id'];
                // dd($signatureRequestId);
                curl_setopt_array(
                    $curl,
                    [
                        CURLOPT_URL => sprintf('%s/signature_requests/%s/documents', $baseUrl, $signatureRequestId),
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POSTFIELDS => [
                            'file' => new CURLFile($pdfDocumentPath, 'application/pdf'),
                            'nature' => 'signable_document',
                            'parse_anchors' => 'true'
                        ],
                        CURLOPT_HTTPHEADER => [
                            sprintf('Authorization: Bearer %s', $apiKey),
                        ],
                    ]);
                
                $documentUploadResponse = curl_exec($curl);
                $document = json_decode($documentUploadResponse, true);
                $documentId = $document['id'];

                $project_prenom = $project->Prenom;
                $project_nom = $project->Nom;
                $project_email = $project->Email;
                $project_phone = $project->phone;
                $first_number = mb_substr($project_phone, 0, 1);
                if($first_number != '+'){
                    $project_phone = '+'.$project_phone;
                } 



                // dd($documentId);
                // dynamic nam set korte hobe
                // email dynamic set korte hobe  jake pathaite chae seta
                // Phone number dynamic set korte hobe
                    // apatoto off thakuk but nicola eita chaitese so eita ektu dekhte hobe amar
                $data = <<<JSON
                {
                "info": {
                    "first_name": "$project_prenom", 
                    "last_name": "$project_nom",
                    "email": "$project_email", 
                    "phone_number": "$project_phone", 
                    "locale": "fr"
                },
                "signature_authentication_mode": "no_otp", 
                "signature_level": "electronic_signature",
                "fields": [
                    {
                    "document_id": "{$documentId}",
                    "type": "signature",
                    "height": 37,
                    "width": 85,
                    "page": 1,
                    "x": 0,
                    "y": 0
                    }
                ]
                }
                JSON;

                // dd($data);

                curl_setopt_array($curl, [
                    CURLOPT_URL => sprintf('%s/signature_requests/%s/signers', $baseUrl, $signatureRequestId),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_HTTPHEADER => [
                        sprintf('Authorization: Bearer %s', $apiKey),
                        'Content-Type: application/json'
                    ],
                ]);

                $addSignerResponse = curl_exec($curl);
                curl_setopt_array($curl, [
                    CURLOPT_URL => sprintf('%s/signature_requests/%s/activate', $baseUrl, $signatureRequestId),
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HTTPHEADER => [
                        sprintf('Authorization: Bearer %s', $apiKey),
                        'Content-Type: application/json'
                    ],
                ]);
                
                $activateSignatureRequestResponse = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($activateSignatureRequestResponse, true);
                if(isset($response['status']) && $response['status'] == 'ongoing'){
                    return back()->with('success', 'Signature mail sent successfully');
                }else{
                    return back()->with('error', 'Quelque chose a mal tourné');
                }
                // echo $activateSignatureRequestResponse;
            }

            // return view('admin.documents.'.$document->view_name.'.index', compact('data'));
        }else{
            return back();
        }
    }

    // Generate Post Pdf
    public function generatePostPdf($id){
        $postInstallation = PostInstallation::where('project_id', $id)->first();
        return view('includes.crm.post_pdf', compact('postInstallation'));
    }

    // Log Comment Update
    public function logCommentUpdate(Request $request){

        // PannelLogActivity::find($request->log_id)->update([
        //     'comment'   => $request->comment,
        // ]);

        return response(__('Comment Updated'));
    }

    public function notificationViewProject($notify_id, $project_id){
        $notification = Notifications::find($notify_id);
        $notification->status = '1';
        $notification->save();

        return redirect()->route('files.index', $project_id);
    }

    // Project Delete
    public function projectDelete(Request $request){
        $project = Project::find($request->project_id);
        $project->deleted_status = 'yes';
        $project->save();
        $notifications = Notifications::where('project_id', $request->project_id)->get();
        foreach($notifications as $notification){
            $notification->delete();
        }

        $unassigns = ProjectAssign::where('project_id', $request->project_id)->get();
        if($unassigns->count() > 0){
             foreach($unassigns as $unassign){
                $unassign->delete();
             }
        }

        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    //Project Assign
    public function projectAssign(Request $request){

        $project_id = $request->project_id;
        $user_id = $request->user_id;

        $unassigns = ProjectAssign::where('project_id', $project_id)->get();
        if($unassigns->count() > 0){
             foreach($unassigns as $unassign){
                $unassign->delete();
             }
        }

    //    foreach($user_id as $id){
        ProjectAssign::create([
            'project_id'     => $project_id,
            'user_id'       => $user_id,
        ]);
        // if(checkNotificationStatus('project assign', $user_id)){
            $user = User::find($user_id);
            $name = Auth::user()->name;
            $subject = 'New Project Assign';
            $body = $user->name.', You have been assigned a project by '.$name;
            // Mail::to($user->email)->send(new AssignMail($subject, $body));
        // }

        $notification = Notifications::create([
            'title'  => ['en' => 'Project Assign', 'fr' =>'Affectation des projets'],
            'body'   => ['en' => 'You have been assigned a project by '.Auth::user()->name, 'fr' =>  'Vous avez été chargé d\'un projet par '.Auth::user()->name],
            'user_id' => $user_id,
            'project_id' => $project_id,
            ]);
    //    }
        return back()->with('success', __('Project Assigned'));
    }

    // project Bulk Assign
    public function projectBulkAssign(Request $request){
        $project_id = explode(',', $request->project_id);

        $user_id = $request->user_id;

        foreach($project_id as $id){



            $unassigns = ProjectAssign::where('project_id', $id)->get();
            if($unassigns->count() > 0){
                 foreach($unassigns as $unassign){
                    $unassign->delete();
                 }
            }

        //    foreach($user_id as $user){
            ProjectAssign::create([
                'project_id'    => $id,
                'user_id'       => $user_id,
                'created_at'    => Carbon::now(),
            ]);

                // if(checkNotificationStatus('project assign', $id)){
                    $user_info = User::find($user_id);
                    $name = Auth::user()->name;
                    $subject = 'New Project Assign';
                    $body = $user_info->name.', You have been assigned a project by '.$name;
                    // Mail::to($user_info->email)->send(new AssignMail($subject, $body));
                // }

                $notification = Notifications::create([
                    'title'  => ['en' => 'Project Assign', 'fr' =>'Affectation des projets'],
                    'body'   => ['en' => 'You have been assigned a project by '.Auth::user()->name, 'fr' =>  'Vous avez été chargé d\'un projet par '.Auth::user()->name],
                    'user_id' => $user_id,
                    'project_id' => $id,
                    ]);

        //    }
        }

        return back()->with('success', __('Project Assigned'));
    }

    // Project Status create
    public function projectStatusCreate(Request $request){
        if($request->x_id){
            $data = ProjectStatus::find($request->x_id);
            $data->update([
                'status' => $request->status,
                'color' => $request->color ?? null,
            ]);
            return back()->with('success', __('Status Updated'));
        }else{
            ProjectStatus::create($request->except('_token', 'x_id'));
            return back()->with('success', __('Status Added'));
        }
    }

    public function projectStatusDelete(Request $request){
        $data = ProjectStatus::find($request->id);
        $data->delete();

        return back()->with('success', __('Deleted Successfully'));
    }

    // Tracker Update
    public function projectTrackerUpdate(Request $request){

        $project  = NewProject::find($request->project_id);

        $project->__tracking__Fournisseur_de_lead = $request->__tracking__Fournisseur_de_lead;
        $project->__tracking__Type_de_campagne = $request->__tracking__Type_de_campagne;
        $project->__tracking__Nom_campagne = $request->__tracking__Nom_campagne;
        $project->__tracking__Date_demande_lead = $request->__tracking__Date_demande_lead;
        $project->__tracking__Date_attribution_télécommercial = $request->__tracking__Date_attribution_télécommercial;
        $project->__tracking__Nom_Prénom = $request->__tracking__Nom_Prénom;
        $project->__tracking__Code_postal = $request->__tracking__Code_postal;
        $project->__tracking__Département = getDepartment2($request->__tracking__Code_postal);
        $project->__tracking__téléphone = $request->__tracking__téléphone;
        $project->__tracking__Mode_de_chauffage = $request->__tracking__Mode_de_chauffage;
        $project->__tracking__Propriétaire = $request->__tracking__Propriétaire;
        $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans = $request->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
        $project->__tracking__Email = $request->__tracking__Email;
        $project->__tracking__Type_de_campagne__a__ = $request->__tracking__Type_de_campagne__a__;
        $project->__tracking__Mode_de_chauffage__a__ = $request->__tracking__Mode_de_chauffage__a__;
        $project->__tracking__Type_de_travaux_souhaité = $request->__tracking__Type_de_travaux_souhaité;
        $project->save();

        foreach($project->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Lead Tracking',
                    'block_name'    => 'Suivi des prospects (formulaire et réponse)',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
            event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->lead_tracking_custom_field_data = $json;
            $project->save();
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'request_date' => Carbon::parse($request->__tracking__Date_demande_lead)->format('d-m-Y'), 'award_date' =>  Carbon::parse($request->__tracking__Date_attribution_télécommercial)->format('d-m-Y'), 'department' => $project->__tracking__Département]);
    }

    // Project Table status
    public function projectCreateStatus(Request $request){
        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);

        ProjectTableStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Added Successfully'));
    }

    // Status Delete
    public function projectDeleteStatus(Request $request){
        $projects = Project::where('user_status', $request->project_status_id)->get();
        if($projects->count() > 0){
            foreach($projects as $project){
                $project->user_status = 0;
                $project->save();
            }
        }
        ProjectTableStatus::find($request->project_status_id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    // Status Change
    public function projectUserStatusChange(Request $request){
        $project = Project::findOrFail($request->project_id);
        $project->user_status = $request->project_status_id;
        $project->save();

        return redirect()->back()->with('success', __('Status Updated'));
    }

    // Project Status Update
    public function projectUpdateStatus(Request $request){
        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
        ProjectTableStatus::find($request->status_id)->update($request->except('_token', 'status_id'));
        // LeadStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Updated Successfully'));
    }


    // Custom Tax verify
    public function projectTaxCustomUpdate(Request $request){

            $all_taxess = ProjectTax::where('project_id', $request->project_id)->get();
            $data = NewProject::find($request->project_id);

            $taxx =  ProjectTax::create([
                'tax_number'        => $request->tax_number,
                'tax_reference'     => $request->tax_reference,
                'project_id'        => $request->project_id,
                'type'              => 'manually',
                'user_id'           => Auth::id(),
            ]);


            if($all_taxess->count() > 0) {
                $taxx->primary = 'no';
                    $taxx->save();
                }
            else{
                $taxx->primary = 'yes';
                $taxx->pays = $data->Revenue_Fiscale_de_Référence;
                $taxx->family_person = $data->Nombre_de_personnes;
                $taxx->save();
            }
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Numéro d'exercice",
                'value'         => $taxx->tax_number,
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Avis de référence",
                'value'         => $taxx->tax_reference,
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));

            $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.activity-log', compact('activities'));
            $activity = $activity_log->render();

            $tax = ProjectTax::where('project_id', $request->project_id)->orderBy('primary', 'asc')->get();
            $primary_tax = ProjectTax::where('project_id', $request->project_id)->where('primary', 'yes')->first();
            $type = 'collapse_personal_information';
            $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
            $tax_all = $all_taxes->render();
            $all_taxes_data = view('includes.crm.project-tax', compact('tax'));
            $tax_all_data = $all_taxes_data->render();
            $all_taxes_data2 = view('includes.crm.project-tax-info', compact('tax'));
            $tax_all_data2 = $all_taxes_data2->render();
            return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'), 'primary'=> $taxx->primary, 'log' => $activity]);

    }
    public function projectTaxCustomUpdate2(Request $request){

        $taxx = ProjectTax::find($request->tax_id);
        if($taxx){
            $taxx->update([
                'tax_number'        => $request->tax_number,
                'tax_reference'     => $request->tax_reference,
            ]);

            foreach($taxx->getChanges() as $key => $value){
                if($key == 'tax_number'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Numéro d'exercice",
                        'value'         => $taxx->tax_number,
                        'feature_id'    => $taxx->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                if($key == 'tax_reference'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Avis de référence",
                        'value'         => $taxx->tax_reference,
                        'feature_id'    => $taxx->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            } 

            $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $taxx->project_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.activity-log', compact('activities'));
            $activity = $activity_log->render();
    
            return response()->json(['alert' => 'mise à jour des taxes avec succès', 'log' => $activity]);
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        }

    }
    // Custom Tax verify
    public function projectTaxCustomVerify(Request $request){
        $tax_number = $request->tax_number;
        $tax_reference = $request->tax_reference;

        $fiscal_response = Http::get("http://35.180.14.36:3003/api/scrap?numFiscal=$tax_number&reference=$tax_reference");

        $response = json_decode($fiscal_response->getBody()->getContents());
        $response_errors = [0 => "Quelque chose s'est mal passé !! Réessayez plus tard.", 2 => "La référence de l’avis ne correspond à celle du dernier avis connu pour cet usager", 3 => "Vous devez vérifier les identifiants saisis. Il peut s'agir d'une erreur de saisie ou ces identifiants ne correspondent pas à un avis."];
        if($response->status != 1){
            return response()->json(['error' => $response_errors[$response->status]]);
        }else{
            $all_taxess = ProjectTax::where('project_id', $request->project_id)->get();
            $data = NewProject::find($request->project_id);

            $taxx =  ProjectTax::create([
                'tax_number'        => $request->tax_number,
                'tax_reference'     => $request->tax_reference,
                'project_id'        => $request->project_id,
                'type'              => 'manually',
                'user_id'           => Auth::id(),
            ]);


            if($all_taxess->count() > 0) {
                $taxx->primary = 'no';
                    $taxx->save();
                }
            else{
                $taxx->primary = 'yes';
                $taxx->pays = $data->Revenue_Fiscale_de_Référence;
                $taxx->family_person = $data->Nombre_de_personnes;
                $taxx->save();
            }
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Numéro d'exercice",
                'value'         => $taxx->tax_number,
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Avis de référence",
                'value'         => $taxx->tax_reference,
                'feature_id'    => $request->project_id,
                'feature_type'  => 'project',
                'user_id'       => Auth::id(),
            ]);
            event(new PannelLog($pannel_activity->id));

            $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.activity-log', compact('activities'));
            $activity = $activity_log->render();

            $tax = ProjectTax::where('project_id', $request->project_id)->orderBy('primary', 'asc')->get();
            $primary_tax = ProjectTax::where('project_id', $request->project_id)->where('primary', 'yes')->first();
            $type = 'collapse_personal_information';
            $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
            $tax_all = $all_taxes->render();
            $all_taxes_data = view('includes.crm.project-tax', compact('tax'));
            $tax_all_data = $all_taxes_data->render();
            $all_taxes_data2 = view('includes.crm.project-tax-info', compact('tax'));
            $tax_all_data2 = $all_taxes_data2->render();
            return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => "La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné", 'primary'=> $taxx->primary, 'log' => $activity]);
        }
    }
    public function projectTaxCustomVerify2(Request $request){

        $taxx = ProjectTax::find($request->tax_id);
        if($taxx){ 
            $tax_number = $request->tax_number;
            $tax_reference = $request->tax_reference;
    
            $fiscal_response = Http::get("http://35.180.14.36:3003/api/scrap?numFiscal=$tax_number&reference=$tax_reference");
    
            $response = json_decode($fiscal_response->getBody()->getContents());
            $response_errors = [0 => "Quelque chose s'est mal passé !! Réessayez plus tard.", 2 => "La référence de l’avis ne correspond à celle du dernier avis connu pour cet usager", 3 => "Vous devez vérifier les identifiants saisis. Il peut s'agir d'une erreur de saisie ou ces identifiants ne correspondent pas à un avis."];
            if($response->status != 1){
                return response()->json(['error' => $response_errors[$response->status]]);
            }else{ 
    
                $taxx->update([
                    'tax_number'        => $request->tax_number,
                    'tax_reference'     => $request->tax_reference,
                ]); 

                foreach($taxx->getChanges() as $key => $value){
                    if($key == 'tax_number'){
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => "Avis d'impôt",
                            'key'           => "Numéro d'exercice",
                            'value'         => $taxx->tax_number,
                            'feature_id'    => $taxx->project_id,
                            'feature_type'  => 'project',
                            'user_id'       => Auth::id(),
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                    if($key == 'tax_reference'){
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => "Avis d'impôt",
                            'key'           => "Avis de référence",
                            'value'         => $taxx->tax_reference,
                            'feature_id'    => $taxx->project_id,
                            'feature_type'  => 'project',
                            'user_id'       => Auth::id(),
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                }  
                
    
                $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $taxx->project_id)->orderBy('id', 'desc')->get();
                $activity_log = view('includes.crm.activity-log', compact('activities'));
                $activity = $activity_log->render();
     
                return response()->json([ 'alert' => "La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné", 'log' => $activity]);
            }
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        }
    }

    // commnet Store
    public function projectCommentStore(Request $request){
        
        $comment = ProjectComment::create([
            'project_id' => $request->project_id,
            'comment' => $request->comment,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $path = public_path('uploads/crm/comment_file');
        if($request->file('attach_files')){
            foreach($request->file('attach_files') as $file){
                $file_type = $file->extension();
                $file_name = $comment->id.time().rand(0000,9999).'.'.$file_type;
                $file->move($path, $file_name);
                ProjectCommentFile::create(['comment_id' => $comment->id, 'name' => $file_name, 'type' => $file_type]);
            }
        }
        $input_string = $request->comment;

        // Find JSON-like objects in the input string
        preg_match_all('/\[\[(.*?)\]\]/', $input_string, $matches);
        $taged_users_id = [];
        // Parse the JSON objects and replace the corresponding values in the input string
        foreach ($matches[1] as $json_object) {
            $parsed_object = json_decode($json_object);
            if (isset($parsed_object->value)) {
                $input_string = str_replace("[[$json_object]]", "<span style='text-decoration: underline; color: #4D056E; font-weight: 700;'>@{$parsed_object->value}</span>", $input_string);
            }
            if (isset($parsed_object->id)) {
                $taged_users_id[] = (int) $parsed_object->id;
            }
        }
        $comment->comment = $input_string;
        $comment->save();

        
       $project = NewProject::find($request->project_id);
       $project_id = sprintf('%08d', $project->id);
       $project_nom = $project->Nom ?? '';
       $project_prenom = $project->Prenom ?? '';
       $link = route('files.index', $project->id);

        $project_label = $project->projectStatus->status; 
        $project_statut = $project->getSubStatus ? $project->getSubStatus->name : (($project->project_label == 1) ? 'Nouveau chantier': 'Pas de sous statut');
        if(Auth::user()->profile_photo){
            $user_profile_link =  asset('uploads/crm/profiles')."/".Auth::user()->profile_photo;
        }
        else{
            $user_profile_link = asset('crm_assets/assets/images/icons/user.png');
        }

        $user_name = Auth::user()->name;
        $created_at = Carbon::parse($comment->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. Carbon::parse($comment->created_at)->format('H:i');
        $category_color = $comment->getCategory->background_color ?? '#fff';
        $category_name = $comment->getCategory->name ?? '';
        $comment_text = $comment->comment;
        

       $title = "<p style='margin:0;font-size:20px;line-height:24px;text-align: center;'>TAG Commentaire</p>
                 <p style='text-align: center; font-size:18px margin-top:10px; margin-bottom: 0'>".Auth::user()->name." vous a mentionné dans un chantier</p>";
       $body = "<tr><td><h3 style='font-weight: 500; margin: 5px 0;'>Informations chantier:</h3></td></tr>
                <tr><td><p style='margin: 5px 0;'><strong>Id :</strong> BH$project_id </p>
                <p style='margin: 5px 0;'><strong>Nom :</strong> $project_nom </p>
                <p style='margin: 5px 0;'><strong>Prénom :</strong> $project_prenom </p>
                <p style='margin: 5px 0;'><strong>Type :</strong> Chantier </p>
                <p style='margin: 5px 0;'><strong>Etiquette :</strong> $project_label </p>
                <p style='margin: 5px 0;'><strong>Statut :</strong> $project_statut </p>
                <p style='margin: 5px 0;'><strong>Lien  :</strong> <a href='$link'>Cliquez ici </a> </p>
                </td></tr> ";
        $response = "<div style='padding-top: 20px;'>
                <div style='font-size: 14px;'>
                    <a href='#!' style='display: inline-block; text-decoration: none; color: inherit;'> 
                        <img src='$user_profile_link' alt='image' width='30' height='30' style='width:30px; height:30px; object-fit: cover; border-radius: 50%; border: 1px solid #5E5873; vertical-align: middle;'> 
                        <span style='padding-left: 5px; font-weight: 500;'>$user_name</span>
                    </a>
                    <div style='display: inline;'>
                        <span style='display: inline-block; font-size: 14px; color: #5E5873; padding-left: 6px; padding-right: 6px;'>a répondu le</span>
                        <span style='display: inline-block; font-size: 14px;'>$created_at</span>
                        <span style='border:1px solid #5a616a; background-color: $category_color; margin-left: 1rem; cursor: pointer; padding: 0.25rem 0.5rem;font-size: .875rem; line-height: 1.5; border-radius: 0.2rem'>$category_name</span>    
                    </div>
                </div>
                <div style='margin: 10px 0; padding: 10px 15px; font-size: 14px; color: #3E4B5B; background-color: #f3f3f7; border-radius: 6px;'>
                    <p style='font-size: 14px; white-space: pre-line; margin-top: 0; margin-bottom: 0;'>$comment_text</p>
                </div>
            </div>";
       foreach($taged_users_id as $tag_user){
            $user = User::find($tag_user);
            if($user && $user->status == 'active' && $user->email_professional){
                Mail::to($user->email_professional)->send(new CommentMentionMail($title, $body, $response));
            }
        } 

        if(role() == 's_admin'){
            $comments = ProjectComment::where('project_id', $request->project_id)->orderBy('id', 'desc')->get();
        }else{
            $comments = ProjectComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('project_id', $request->project_id)->orderBy('id', 'desc')->get();
        }
        $type = 'project';
        $comment = view('includes.crm.project_comment', compact('comments', 'type', 'project'))->render();
        return response()->json(['comment' => $comment, 'alert' => __('Added Succesfully')]);
    }


    // Comment Delete
    public function projectCommentDelete(Request $request){
        if(role() != 's_admin'){
            return back()->with('error', "Vous n'avez pas accès pour supprimer ceci");
        }
        $comment = ProjectComment::find($request->id);
        if($comment){
            $comment->delete();
        }
        return back()->with('success', __('Deleted Succesfully'));
        // ProjectComment::find($request->comment_id)->delete();
        // if(role() == 's_admin'){
        //     $comments = ProjectComment::where('project_id', $request->project_id)->orderBy('id', 'desc')->get();
        // }else{
        //     $comments = ProjectComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('project_id', $request->project_id)->orderBy('id', 'desc')->get();
        // }
        // $comment = view('includes.crm.project_comment', compact('comments'))->render();
        // return response()->json(['comment' => $comment, 'alert' => __('Deleted Succesfully')]);
    }

    // Comment Delete
    public function projectCommentPin(Request $request){
        $project = NewProject::find($request->project_id);

        $project->allCommecnts->each->update([
            'pin_status' => 0,
        ]);

        $comment = ProjectComment::find($request->id);
        $comment->update([
            'pin_status' => 1,
        ]);

        $pannel_activity = PannelLogActivity::create([
            'key'           => 'comment_pin_status__change',
            'value'         => $comment->comment,
            'feature_id'    => $project->id,
            'feature_type'  => 'project',
            'user_id'       => Auth::id(), 
        ]);

        event(new PannelLog($pannel_activity->id));

        return back()->with('success', 'Épingle de commentaire mise à jour avec succès');
    }

    // Project Status Planning Create
    public function projectStatusPlanningCreate(Request  $request){

        if($request->x_id){
            ProjectStatusPlanning::find($request->x_id)->update([
                'status'    => $request->status,
                'color'     => $request->color,
            ]);
            return  redirect()->back()->with('success', __('Updated Successfully'));
        }
        ProjectStatusPlanning::create([
            'status'    => $request->status,
            'color'     => $request->color,
        ]);
        return  redirect()->back()->with('success', __('Added Successfully'));
    }

    // Project Status Planning Delete
    public function projectStatusPlanningDelete(Request $request){
        $data = ProjectStatusPlanning::find($request->id);
        $data->delete();

        return back()->with('success', __('Deleted Successfully'));
    }

    // Project Name Change
    public function projectNameChange(Request $request){
        Project::find($request->project_id)->update([
            'project_name' => $request->name,
        ]);

        return back()->with('success', __('Updated Successfully'));
    }

    // Travaux product create
    public function travauxProductCreate(Request $request){
        TravauxProduct::create([
            'travaux' => $request->travaux,
            'product' => $request->product,
        ]);

        return back()->with('success', __('Created Successfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega');
    }

    // Travaux product delete
    public function travauxProductDelete(Request $request){

        TravauxProduct::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega');
    }

    // Travaux create
    public function travauxCreate(Request $request){
        TravauxList::create([
            'travaux' => $request->travaux,
            'bareme_id' => $request->bareme_id,
        ]);
        if($request->product_tab){
            return back()->with('success', __('Added Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega');
        }
        elseif($request->travaux_tab){
            return back()->with('success', __('Added Succesfully'))->with('travaux_tab_only', 'Travaux Tab bi active thakega');
        }
        else{
            return back()->with('success', __('Added Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega')->with('active_question_tab', 'form profile page active travaux');
        }
    }

    // Travaux update
    public function travauxUpdate(Request $request){
        $data = TravauxList::find($request->id);
        $travaux = Work::all();
        // foreach($travaux as $tvx){
        //     $items = explode(',', $tvx->travaux);
        //     foreach($items as $item){
        //         if($data->travaux == $item){
        //             dd('paise');
        //         }
        //     }
        // }
        $products = TravauxProduct::where('travaux', $data->travaux)->get();
        if($products){
            foreach($products as $product){
                $product->travaux = $request->travaux;
                $product->save();
            }
        }

        $questions = TravauxQuestion::where('travaux', $data->travaux)->get();
        if($questions){
            foreach($questions as $question){
                $question->travaux = $request->travaux;
                $question->save();
            }
        }

        $data->update([
            'travaux' => $request->travaux,
        ]);

        if($request->product_tab){
            return back()->with('success', __('Updated Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega');
        }
        elseif($request->travaux_tab){
            return back()->with('success', __('Updated Succesfully'))->with('travaux_tab_only', 'Travaux Tab bi active thakega');
        }
        else{
            return back()->with('success', __('Updated Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega')->with('active_question_tab', 'form profile page active travaux');
        }
    }

    // Travaux Delete
    public function travauxDelete(Request $request){
        $data = TravauxList::find($request->id);
        $products = TravauxProduct::where('travaux', $data->travaux)->get();
        if($products){
            foreach($products as $product){
                $product->delete();
            }
        }

        $questions = TravauxQuestion::where('travaux', $data->travaux)->get();
        if($questions){
            foreach($questions as $question){
                $question->delete();
            }
        }
        $data->delete();
         if($request->product_tab){
            return back()->with('success', __('Deleted Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega');
        }

        elseif($request->travaux_tab){
            return back()->with('success', __('Deleted Succesfully'))->with('travaux_tab_only', 'Travaux Tab bi active thakega');
        }

        else{
        return back()->with('success', __('Deleted Succesfully'))->with('travaux_tab_active', 'Travaux Tab bi active thakega')->with('active_question_tab', 'form profile page active travaux');
        }
    }

    public function customSavCreate(Request $request){
        ProjectSav::create($request->except('_token'));
        return back()->with('success', __('Added Succesfully'))->with('sav_tab_active', 'sav tab active');
    }

    public function projectSavFieldStore(Request $request){
        foreach($request->title as $key => $value){
            SavDataField::create([
                'sav_id' => $request->sav_id,
                'sav_type' => $request->sav_type,
                'title' => $request->title[$key],
                'name' => Str::snake($request->title[$key], '_'),
                'input_type' => $request->input_type[$key],
                'options' => $request->options[$key],
            ]);
        }
        // SavDataField::create($request->except(['_token']) + ['name' => Str::snake($request->title, '_')]);
        return back()->with('success', __('Added Succesfully'))->with('sav_tab_active', 'sav tab active');
    }

    public function projectSavFieldDataStore(Request $request){
        $input_key = [];
        $input_item = [];
        foreach($request->except(['_token','sav_id', 'sav_type']) as $key => $item){
            $data = explode('_', $key);
            if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
        }
        $costom_field_data = array_combine($input_key, $input_item);
        $json = json_encode($costom_field_data);
        $existing = SavFieldData::where('sav_id',$request->sav_id)->where('sav_type', $request->sav_type)->first();
        if($existing){
            $existing->update([
                'data'          => $json,
            ]);
            $msg = __("Updated Successfully");
        }else{
            SavFieldData::create([
                'sav_id'        => $request->sav_id,
                'sav_type'      => $request->sav_type,
                'data'          => $json,
            ]);
            $msg = __('Added Succesfully');
        }
        return back()->with('success', $msg)->with('sav_tab_active', 'sav tab active');
    }

    public function projectSavDelete(Request $req){
        ProjectSav::find($req->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('sav_tab_active', 'sav tab active');
    }

    public function projectSavField(Request $req){
        $inputs =SavDataField::where('sav_id', $req->sav_id)->where('sav_type', $req->sav_type)->get();
        $data = view('includes.crm.sav_input', compact('inputs'))->render();
        return response($data);
    }
    public function projectSavFieldDelete(Request $req){
        SavDataField::find($req->id)->delete();
        $inputs =SavDataField::where('sav_id', $req->sav_id)->where('sav_type', $req->sav_type)->get();
        $data = view('includes.crm.sav_input', compact('inputs'))->render();
        return response($data);
    }

    public function projectWorkDone(Request $request){
        $data = WorkDone::create($request->except('_token','prestation_group_id')+ ['total_ttc' => $request->unit_bonus * $request->quantity]);
        if($request->prestation_group_id){
            $group = PrestationGroup::find($request->prestation_group_id);
            foreach($group->getItems as $key => $item){
                AdditionalProduct::create([
                    'project_id'        => $request->project_id,
                    'operation_cee'     => $request->operation,
                    'prestation_id'     => $item->prestation_id,
                    'linked_operation'  => $data->id,
                    'title'             => $item->getPrestation->title,
                    'description'       => $item->getPrestation->designation,
                    'order'             => $key+1,
                    'pu_ttc'            => $item->price,
                    'tax'               => $item->tax,
                    'quantity'          => $item->quantity,
                    'unit'              => $item->getPrestation->unit,
                    'total_ttc'         => $item->price * $item->quantity,
                ]);
            }
        }
        return back()->with('success', __('Added Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function workDoneUpdate(Request $request){
        WorkDone::find($request->id)->update($request->except(['_token', 'id']) + ['total_ttc' => $request->unit_bonus * $request->quantity]);
        return back()->with('success', __('Updated Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function workDoneDelete(Request $request){
        WorkDone::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function additionalProdcutAdd(Request $request){
        AdditionalProduct::create($request->except('_token'));
        return back()->with('success', __('Added Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function additionalProductUpdate(Request $request){
        $product = AdditionalProduct::find($request->id);
        $product->update($request->except(['_token', 'id'])+['tva' => ($request->total_ttc * $product->tax)/100]);
        if(!$request->view_price){
            $product->view_price = '';
            $product->save();
        }
        return back()->with('success', __('Updated Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function additionalProductUpdate2(Request $request){
        $product = AdditionalProduct::find($request->id);
        $product->update($request->except(['_token', 'id'])+['tva' => ($request->total_ttc * $product->tax)/100]);
        return back()->with('success', __('Updated Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function additionalProductDelete(Request $request){
        AdditionalProduct::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function projectEnergyStore(Request $request){
        $data = EnergyAid::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if(!$request->prime_cee){
            $data->prime_cee = '';
        }
        if(!$request->prime_devis_condition){
            $data->prime_devis_condition = '';
        }
        if(!$request->prime_devis_deduct){
            $data->prime_devis_deduct = '';
        }
        if(!$request->prime_facture_condition){
            $data->prime_facture_condition = '';
        }
        if(!$request->prime_facture_deduct){
            $data->prime_facture_deduct = '';
        }
        if(!$request->maprime){
            $data->maprime = '';
        }
        if(!$request->maprime_devis_condition){
            $data->maprime_devis_condition = '';
        }
        if(!$request->maprime_devis_deduct){
            $data->maprime_devis_deduct = '';
        }
        if(!$request->maprime_facture_condition){
            $data->maprime_facture_condition = '';
        }
        if(!$request->maprime_facture_deduct){
            $data->maprime_facture_deduct = '';
        }
        if(!$request->maprime_output_bonus){
            $data->maprime_output_bonus = '';
        }
        if(!$request->maprime_bbc_bonus){
            $data->maprime_bbc_bonus = '';
        }
        if(!$request->maprime_removal_oil_tank){
            $data->maprime_removal_oil_tank = '';
        }
        if(!$request->action_logement){
            $data->action_logement = '';
        }
        if(!$request->logement_devis_condition){
            $data->logement_devis_condition = '';
        }
        if(!$request->logement_devis_deduct){
            $data->logement_devis_deduct = '';
        }
        if(!$request->logement_facture_condition){
            $data->logement_facture_condition = '';
        }
        if(!$request->logement_facture_deduct){
            $data->logement_facture_deduct = '';
        }
        if(!$request->charge_devis_condition){
            $data->charge_devis_condition = '';
        }
        if(!$request->charge_devis_deduct){
            $data->charge_devis_deduct = '';
        }
        if(!$request->charge_facture_condition){
            $data->charge_facture_condition = '';
        }
        if(!$request->charge_facture_deduct){
            $data->charge_facture_deduct = '';
        }
        $data->save();

        return back()->with('success', __('Updated Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function sidebarInfoUpdate(Request $request){
        DevisSidebar::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __('Updated Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function updateActiveTab(Request $request){
        if($request->module == 'project'){
            Session::put('project_tab_active', $request->id);
        }
        if($request->module == 'lead'){
            Session::put('lead_tab_active', $request->id);
        }
        return response('success');
    }

    public function projectDocumentAccessUpdate(Request $request){
        if($request->value == 'yes'){
            ProjectDocumentControl::create([
                'project_id' => $request->project_id,
                'document_id' => $request->document_id,
            ]);
        }else{
            ProjectDocumentControl::find($request->document_id)->delete();
        }

         return response(__("Updated Succesfully"));
    }

    public function projectTaxMarkCheck(Request $request){
        $taxe = ProjectTax::find($request->tax_id);
        $taxe->update([
            'mark_check' => $request->data,
        ]);
        $project =  NewProject::find($request->project_id);
        $tax = ProjectTax::where('project_id', $request->project_id)->orderBy('primary', 'asc')->get();
        $primary_tax = ProjectTax::where('project_id', $request->project_id)->where('primary', 'yes')->first();
        $fiscal_amount = ProjectTax::where('project_id', $request->project_id)->where('mark_check', 'yes')->sum('pays');
        $family_person = ProjectTax::where('project_id', $request->project_id)->where('mark_check', 'yes')->sum('family_person');

        // $project->update([
        //     'fiscal_amount'     => $fiscal_amount,
        //     'family_person'     => $family_person,
        //     'precariousness'    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->postal_code)
        // ]);


        if($project->precariousness_year == '2023'){
            if($primary_tax->same_as_work_address == 'no'){
                $project->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $project->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }
        }else{
            if($primary_tax->same_as_work_address == 'no'){
                $project->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $project->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }
        }

        $type = 'collapse_personal_information';
        $data = NewProject::find($request->project_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render();

        return response()->json(['taxes' => $tax_all, 'alert' => __('Updated Successfully'), 'fiscal_amount' => $fiscal_amount, 'family_person' => $family_person, 'precariousness' => $project->precariousness]);
    }

    public function projectCompteUpdate(Request $request){
        $project = NewProject::find($request->project_id);
        if($project){
            $project->Compte_email                                  = $request->Compte_email;
            $project->Compte_Mots_de_passe                          = $request->Compte_Mots_de_passe;
            $project->Compte_crée_le                                = $request->Compte_crée_le;
            $project->Compte_crée_par                               = $request->Compte_crée_par;
            $project->Compte_Email_de_récupération_email            = $request->Compte_Email_de_récupération_email;
            $project->Compte_Email_de_récupération_Mots_de_passe    = $request->Compte_Email_de_récupération_Mots_de_passe;
            $project->Compte_Email_de_récupération_crée_le          = $request->Compte_Email_de_récupération_crée_le;
            $project->Compte_Email_de_récupération_crée_par         = $request->Compte_Email_de_récupération_crée_par;
            $project->Compte_MaPrimeRenov_email                     = $request->Compte_MaPrimeRenov_email;
            $project->Compte_MaPrimeRenov_Mots_de_passe             = $request->Compte_MaPrimeRenov_Mots_de_passe;
            $project->Compte_MaPrimeRenov_Compte_crée_le            = $request->Compte_MaPrimeRenov_Compte_crée_le;
            $project->Compte_MaPrimeRenov_Compte_crée_par           = $request->Compte_MaPrimeRenov_Compte_crée_par;
            // $project->Compte_inscrit_sur_Thunderbird                = $request->Compte_inscrit_sur_Thunderbird;
            $project->Téléphone_de_récupération                     = $request->Téléphone_de_récupération;
            $project->Téléphone_de_récupération_Téléphone           = $request->Téléphone_de_récupération_Téléphone;
            $project->Email_de_transfert                            = $request->Email_de_transfert;
            $project->Email_de_transfert_Email                      = $request->Email_de_transfert_Email;
            $project->Compte_Observations                           = $request->Compte_Observations;
            $project->compte_email_status                           = $request->compte_email_status;
            $project->compte_email_recovery_status                  = $request->compte_email_recovery_status;
            $project->compte_MaPrimeRénov_status                    = $request->compte_MaPrimeRénov_status;
            $project->save();
            foreach($project->getChanges() as $key => $value){
                if($key != 'updated_at'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Section MAPRIMERENOV',
                        'block_name'    => 'Compte',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(),
                    ]);
                event(new PannelLog($pannel_activity->id));
                }
            }

            $input_key = [];
            $input_item = [];
            if($request->custom_field_data){
                foreach($request->custom_field_data as $key => $item){
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
                $costom_field_data = array_combine($input_key, $input_item);
                $json = json_encode($costom_field_data);
                $project->campte_custom_field_data = $json;
                $project->save();
            }
        }


        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->project_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'CompteEmail' => $project->Compte_crée_le ? Carbon::parse($project->Compte_crée_le)->format('d-m-Y'):'', 'CompteEmailDeRécupération' => $project->Compte_Email_de_récupération_crée_le ? Carbon::parse($project->Compte_Email_de_récupération_crée_le)->format('d-m-Y'):'', 'CompteMaPrimeRénov' => $project->Compte_MaPrimeRenov_Compte_crée_le ? Carbon::parse($project->Compte_MaPrimeRenov_Compte_crée_le)->format('d-m-Y'):'']);

    }

    public function projectSubventionCreate(Request $request){
       $subvention = Subvention::create($request->except('_token'));
       $subvention->update([
            'numero_de_dossier' => 'MPR-'.Carbon::now()->format('Y').'-'.sprintf('%07d', $subvention->id)
       ]);
        return back()->with('success', __('Created Successfully'))->with('maprimerenov_active', 1);
    }

    public function projectSubventionDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse_subvention', 'delete') && role() != 's_admin'){
            return back();
        } 
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->delete();
        }

        return back()->with('success', __('Deleted Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionUpdate(Request $request){
        $subvention = Subvention::find($request->subvention_id);
        $subvention->update($request->except(['_token', 'subvention_id', 'project_id', 'travaux_deposer', 'file', 'Statut_subvention_yes_file', 'Statut_subvention_no_file', 'custom_field_name']));
        $subvention->travaux()->sync($request->travaux_deposer);
        foreach($subvention->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity =  PannelLogActivity::create([
                     'tab_name'      => 'Section MAPRIMERENOV',
                     'block_name'    => 'Subvention',
                     'key'           => $key,
                     'value'         => $value,
                     'feature_id'    => $request->project_id,
                     'feature_type'  => 'project',
                     'user_id'       => Auth::id(),
                 ]);
                event(new PannelLog($pannel_activity->id));

            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $subvention->custom_field_data = $json;
            $subvention->save();
        }

        // if($request->file('file')){
        //     $file = $request->file('file');
        //     $fileName = $subvention->id.time().'.'. $file->extension();
        //     $fileOriginalName = $file->getClientOriginalName();
        //     $file->move(public_path('uploads/subventions'), $fileName);
        //     $subvention->file = $fileName;
        //     $subvention->file_name = $fileOriginalName;
        //     $subvention->save();
        // }
        // if($request->file('Statut_subvention_yes_file')){
        //     $file2 = $request->file('Statut_subvention_yes_file');
        //     $fileName2 = $subvention->id.time().'1.'. $file2->extension();
        //     $file2OriginalName = $file2->getClientOriginalName();
        //     $file2->move(public_path('uploads/subventions'), $fileName2);
        //     $subvention->Statut_subvention_yes_file = $fileName2;
        //     $subvention->Statut_subvention_yes_file_name = $file2OriginalName;
        //     $subvention->save();
        // }
        // if($request->file('Statut_subvention_no_file')){
        //     $file3 = $request->file('Statut_subvention_no_file');
        //     $fileName3 = $subvention->id.time().'0.'. $file3->extension();
        //     $file3OriginalName = $file3->getClientOriginalName();
        //     $file3->move(public_path('uploads/subventions'), $fileName3);
        //     $subvention->Statut_subvention_no_file = $fileName3;
        //     $subvention->Statut_subvention_no_file_name = $file3OriginalName;
        //     $subvention->save();
        // }

        if($request->Statut_subvention == 'yes' && $subvention->Statut_subvention_yes_mail_status == 0){
            $project = $subvention->getProject;
            $client_name = $project->Prenom ?? '';
            $subject = 'Subvention accordé '.$client_name;
            $amount = $subvention->montant_subvention_accorde;
            $date = $subvention->subvention_accorde_le ? Carbon::parse($subvention->subvention_accorde_le)->format('d-m-Y'):'';
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
                                <td colspan='2'>La subvention de $client_name a été accepté </td>
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
                                <td>Travaux</td>
                                <td>:$travaux</td>
                            </tr>
                            <tr>
                                <td>Département</td>
                                <td>: $department</td>
                            </tr>
                        </table>";

            if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active' && $project->getProjectTelecommercial->email_professional){
                Mail::to($project->getProjectTelecommercial->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
            }
            if($project->projectGestionnaire && $project->projectGestionnaire->status == 'active' && $project->projectGestionnaire->email_professional){
                Mail::to($project->projectGestionnaire->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
            }
            foreach ($project->getIntervention->where('type', 'Etude') as $intervention){
                if($intervention->getChargeDeEtude && $intervention->getChargeDeEtude->status == 'active' && $intervention->getChargeDeEtude->email_professional){
                Mail::to($intervention->getChargeDeEtude->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
                }
            }
            $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [10,11,12,13,14])->get();
            foreach($users as $user){
                if($user->email_professional){
                    Mail::to($user->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
                }
            }
            $subvention->Statut_subvention_yes_mail_status = 1;
            $subvention->save();
        }
        if($request->Statut_subvention == 'no' && $subvention->Statut_subvention_no_mail_status == 0){
            $project = $subvention->getProject;
            $client_name = $project->Prenom ?? '';
            $subject = 'Subvention refusée '.$client_name;
            $reject_date = $subvention->subvention_rejetee_le ? Carbon::parse($subvention->subvention_rejetee_le)->format('d-m-Y'):'';
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
                                <td colspan='2'>La subvention de $client_name a été refusé </td>
                            </tr>
                            <tr>
                                <td>Subvention rejetée le</td>
                                <td>: $reject_date;</td>
                            </tr>
                            <tr>
                                <td>Motif rejet</td>
                                <td>: $subvention->Motif_rejet</td>
                            </tr>
                            <tr>
                                <td>Travaux</td>
                                <td>:$travaux</td>
                            </tr>
                            <tr>
                                <td>Département</td>
                                <td>: $department</td>
                            </tr>
                        </table>";

            if($project->getProjectTelecommercial && $project->getProjectTelecommercial->status == 'active' && $project->getProjectTelecommercial->email_professional){
                Mail::to($project->getProjectTelecommercial->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
            }
            if($project->projectGestionnaire && $project->projectGestionnaire->status == 'active' && $project->projectGestionnaire->email_professional){
                Mail::to($project->projectGestionnaire->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
            }
            foreach ($project->getIntervention->where('type', 'Etude') as $intervention){
                if($intervention->getChargeDeEtude && $intervention->getChargeDeEtude->status == 'active' && $intervention->getChargeDeEtude->email_professional){
                Mail::to($intervention->getChargeDeEtude->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
                }
            }
            $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [10,11,12,13,14])->get();
            foreach($users as $user){
                if($user->email_professional){
                    Mail::to($user->email_professional)->send(new SubventionStatusMail($subject, $mail_body));
                }
            }
            $subvention->Statut_subvention_no_mail_status = 1;
            $subvention->save();
        }

        return back()->with('success', __('Updated Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionFileUpdate(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            if($request->file('file')){
                $file = $request->file('file');
                $fileName = $subvention->id.time().'.'. $file->extension();
                $fileOriginalName = $file->getClientOriginalName();
                $file->move(public_path('uploads/subventions'), $fileName);
                $subvention->file = $fileName;
                $subvention->file_name = $fileOriginalName;
                $subvention->save();
            }
        }else{
            return back();
        }
        return back()->with('success', __('Updated Successfully'))->with('maprimerenov_active', 1);
    }
    public function subventionFile2Update(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            if($request->file('Statut_subvention_yes_file')){
                $file2 = $request->file('Statut_subvention_yes_file');
                $fileName2 = $subvention->id.time().'1.'. $file2->extension();
                $file2OriginalName = $file2->getClientOriginalName();
                $file2->move(public_path('uploads/subventions'), $fileName2);
                $subvention->Statut_subvention_yes_file = $fileName2;
                $subvention->Statut_subvention_yes_file_name = $file2OriginalName;
                $subvention->save();
            }
        }else{
            return back();
        }
        return back()->with('success', __('Updated Successfully'))->with('maprimerenov_active', 1);
    }
    public function subventionFile3Update(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            if($request->file('Statut_subvention_no_file')){
                $file3 = $request->file('Statut_subvention_no_file');
                $fileName3 = $subvention->id.time().'0.'. $file3->extension();
                $file3OriginalName = $file3->getClientOriginalName();
                $file3->move(public_path('uploads/subventions'), $fileName3);
                $subvention->Statut_subvention_no_file = $fileName3;
                $subvention->Statut_subvention_no_file_name = $file3OriginalName;
                $subvention->save();
            }
        }else{
            return back();
        }
        return back()->with('success', __('Updated Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionFileDelete(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'file' => '',
                'file_name' => '',
            ]);
        }
        return back()->with('susscess', __('Deleted Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionFileNameEdit(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'file_name' => $request->name,
            ]);
        }
        return back()->with('susscess', __('Updated Successfully'))->with('maprimerenov_active', 1);

    }
    public function subventionFile2Delete(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'Statut_subvention_yes_file' => '',
                'Statut_subvention_yes_file_name' => '',
            ]);
        }
        return back()->with('susscess', __('Deleted Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionFile2NameEdit(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'Statut_subvention_yes_file_name' => $request->name,
            ]);
        }
        return back()->with('susscess', __('Updated Successfully'))->with('maprimerenov_active', 1);

    }
    public function subventionFile3Delete(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'Statut_subvention_no_file' => '',
                'Statut_subvention_no_file_name' => '',
            ]);
        }
        return back()->with('susscess', __('Deleted Successfully'))->with('maprimerenov_active', 1);
    }

    public function subventionFile3NameEdit(Request $request){
        $subvention = Subvention::find($request->id);
        if($subvention){
            $subvention->update([
                'Statut_subvention_no_file_name' => $request->name,
            ]);
        }
        return back()->with('susscess', __('Updated Successfully'))->with('maprimerenov_active', 1);
    }

    public function banqueCreate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        Banque::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('banque_active', 1);
    }

    public function banqueUpdate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        Banque::find($request->id)->update($request->except('_token'));
        return back()->with('success', __("Updated Successfully"))->with('banque_active', 1);
    }

    public function banqueDelete(Request $request){
        Banque::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('banque_active', 1);
    }

    public function banqueDepotCreate(Request $request){
        BanqueDepot::create($request->except(['_token']));
        return back()->with('success', __("Created Successfully"))->with('banque_active', 1);
    }
    public function banqueDepotDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse_depot', 'delete') && role() != 's_admin'){
            return back();
        } 
        BanqueDepot::create($request->except(['_token']));
        $deport = BanqueDepot::find($request->id);
        if($deport){
            $deport->delete();
        }
        return back()->with('success', __("Deleted Successfully"))->with('banque_active', 1);
    }

    public function banqueDepotUpdate(Request $request){
        $banque = BanqueDepot::find($request->id);
        $banque->update([
            'banque_id' => $request->banque_id,
            'banque_montant' => $request->banque_montant,
            'date_depot' => $request->date_depot,
            'banque_numero_de_dossier' => $request->banque_numero_de_dossier,
            'banque_status' => $request->banque_status,
            'Préciser_pièces_manquantes' => $request->Préciser_pièces_manquantes,
            'Statut_accord_banque' => $request->Statut_accord_banque,
            'Montant_crédit_accepté' => $request->Montant_crédit_accepté,
            'Date_de_notification_accord' => $request->Date_de_notification_accord,
            'Raison_refus_du_crédit' => $request->Raison_refus_du_crédit,
        ]);

        foreach($banque->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Banque',
                    'block_name'    => 'Depot en banque',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $banque->custom_field_data = $json;
            $banque->save();
        }

        return back()->with('success', __("Updated Successfully"))->with('banque_active', 1);
    }
    public function demandemairieCreate(Request $request){
        DemandeMairie::create($request->except(['_token']));
        return back()->with('success', __("Created Successfully"))->with('demande_mairie', 1);
    }
    public function demandemairieDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse_demande_mairie', 'delete') && role() != 's_admin'){
            return back();
        } 
        $demande = DemandeMairie::find($request->id);
        if($demande){
            $demande->delete();
        }
        return back()->with('success', __("Deleted Successfully"))->with('demande_mairie', 1);
    }

    public function demandemairieUpdate(Request $request){
        $demande = DemandeMairie::find($request->id);
        $demande->update([
            'Mairie' => $request->Mairie,
            'Statut_demande' => $request->Statut_demande,
            'Date_de_réception_de_l_accord_de_mairie' => $request->Date_de_réception_de_l_accord_de_mairie,
            'Date_de_dépôt' => $request->Date_de_dépôt,
            'Demande_de_travaux' => $request->Demande_de_travaux,
            'Réception_du_récépissé_de_dépôt' => $request->Réception_du_récépissé_de_dépôt,
            'Date_de_réception_de_récépissé_de_mairie' => $request->Date_de_réception_de_récépissé_de_mairie,
            'Observations' => $request->Observations,
        ]);

        foreach($demande->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Demande Mairie',
                    'block_name'    => 'Dépôt en Mairie',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $demande->custom_field_data = $json;
            $demande->save();
        }

        return back()->with('success', __("Updated Successfully"))->with('demande_mairie', 1);
    }

    public function projectAuditCreate(Request $request){
        Audit::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('audit_active', 1);
    }
    public function projectAuditDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse_audit', 'delete') && role() != 's_admin'){
            return back();
        } 
        $audit = Audit::find($request->id);
        if($audit){
            $audit->delete();
        }
        return back()->with('success', __("Deleted Successfully"))->with('audit_active', 1);
    }

    public function projectAuditUpdate(Request $request){

        $audit = Audit::find($request->id);
        $audit->update($request->except(['_token', 'id', 'project_id', 'Travaux_du_scénario_choisi']));

        foreach($audit->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Audit Energetique',
                    'block_name'    => 'Audit',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $audit->getTravaux()->sync($request->Travaux_du_scénario_choisi);

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $audit->custom_field_data = $json;
            $audit->save();
        }

        return back()->with('success', __("Updated Successfully"))->with('audit_active', 1);
    }

    public function officeCreate(Request $request){
        StudyOffice::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('office_active', 1);
    }

    public function officeUpdate(Request $request){
        StudyOffice::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('office_active', 1);
    }

    public function officeDelete(Request $request){
        StudyOffice::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('office_active', 1);
    }

    public function auditStatusCreate(Request $request){
        AuditStatus::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('audit_status', 1);
    }

    public function auditStatusUpdate(Request $request){
        AuditStatus::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('audit_status', 1);
    }

    public function auditStatusDelete(Request $request){
        AuditStatus::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('audit_status', 1);
    }

    public function auditReportStatusCreate(Request $request){
        AuditReportStatus::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('audit_report', 1);
    }

    public function auditReportStatusUpdate(Request $request){
        AuditReportStatus::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('audit_report', 1);
    }

    public function auditReportStatusDelete(Request $request){
        AuditReportStatus::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('audit_report', 1);
    }

    public function reportResultCreate(Request $request){
        ReportResult::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('report_result', 1);
    }

    public function reportResultUpdate(Request $request){
        ReportResult::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('report_result', 1);
    }

    public function reportResultDelete(Request $request){
        ReportResult::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('report_result', 1);
    }

    public function commercialTerrainCreate(Request $request){
        CommercialTerrain::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('commercial', 1);
    }

    public function commercialTerrainUpdate(Request $request){
        CommercialTerrain::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('commercial', 1);
    }

    public function commercialTerrainDelete(Request $request){
        CommercialTerrain::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('commercial', 1);
    }

    public function projectInterventionCreate(Request $request){
        ProjectIntervention::create($request->except('_token'));
        return back()->with('success', __('Created Successfully'))->with('intervention_active', 1);
    }

    public function statusStudyCreate(Request $request){
        StatusPlanningStudy::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_study', 1);
    }

    public function statusStudyUpdate(Request $request){
        StatusPlanningStudy::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_study', 1);
    }

    public function statusStudyDelete(Request $request){
        StatusPlanningStudy::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_study', 1);
    }

    public function technicianStudyCreate(Request $request){
        TechnicianStudy::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('technician_study', 1);
    }

    public function technicianStudyUpdate(Request $request){
        TechnicianStudy::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('technician_study', 1);
    }

    public function technicianStudyDelete(Request $request){
        TechnicianStudy::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('technician_study', 1);
    }

    public function technicalRefereeCreate(Request $request){
        TechnicalReferee::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('technical_referee', 1);
    }

    public function technicalRefereeUpdate(Request $request){
        TechnicalReferee::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('technical_referee', 1);
    }

    public function technicalRefereeDelete(Request $request){
        TechnicalReferee::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('technical_referee', 1);
    }

    public function feasibilityStudyCreate(Request $request){
        StatusFeasibilityStudy::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_feasibility', 1);
    }

    public function feasibilityStudyUpdate(Request $request){
        StatusFeasibilityStudy::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_feasibility', 1);
    }

    public function feasibilityStudyDelete(Request $request){
        StatusFeasibilityStudy::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_feasibility', 1);
    }
    public function statusPrevisiteCreate(Request $request){
        StatusPlanningPrevisite::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_planning_previsite', 1);
    }

    public function statusPrevisiteUpdate(Request $request){
        StatusPlanningPrevisite::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_planning_previsite', 1);
    }

    public function statusPrevisiteDelete(Request $request){
        StatusPlanningPrevisite::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_planning_previsite', 1);
    }
    public function technicianPrevisiteCreate(Request $request){
        TechnicianPrevisite::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('technician_previsite', 1);
    }

    public function technicianPrevisiteUpdate(Request $request){
        TechnicianPrevisite::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('technician_previsite', 1);
    }

    public function technicianPrevisiteDelete(Request $request){
        TechnicianPrevisite::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('technician_previsite', 1);
    }

    public function previsiteStatusCreate(Request $request){
        StatusPrevisite::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_previsite', 1);
    }

    public function previsiteStatusUpdate(Request $request){
        StatusPrevisite::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_previsite', 1);
    }

    public function previsiteStatusDelete(Request $request){
        StatusPrevisite::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_previsite', 1);
    }

    public function feasibilityPrevisiteCreate(Request $request){
        StatusFeasibilityPrevisite::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_feasibility_previsite', 1);
    }

    public function feasibilityPrevisiteUpdate(Request $request){
        StatusFeasibilityPrevisite::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_feasibility_previsite', 1);
    }

    public function feasibilityPrevisiteDelete(Request $request){
        StatusFeasibilityPrevisite::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_feasibility_previsite', 1);
    }

    public function statusPlanningCounterVisitCreate(Request $request){
        StatusPlanningCounterVisit::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_planning_counter', 1);
    }

    public function statusPlanningCounterVisitUpdate(Request $request){
        StatusPlanningCounterVisit::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_planning_counter', 1);
    }

    public function statusPlanningCounterVisitDelete(Request $request){
        StatusPlanningCounterVisit::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_planning_counter', 1);
    }

    public function technicianCounterVisitCreate(Request $request){
        TechnicianCounterVisit::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('technician_planning_counter', 1);
    }

    public function technicianCounterVisitUpdate(Request $request){
        TechnicianCounterVisit::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('technician_planning_counter', 1);
    }

    public function technicianCounterVisitDelete(Request $request){
        TechnicianCounterVisit::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('technician_planning_counter', 1);
    }

    public function statusCounterVisitCreate(Request $request){
        StatusCounterVisit::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_counter', 1);
    }

    public function statusCounterVisitUpdate(Request $request){
        StatusCounterVisit::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_counter', 1);
    }

    public function statusCounterVisitDelete(Request $request){
        StatusCounterVisit::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_counter', 1);
    }

    public function statusFeasibilityCounterVisitCreate(Request $request){
        StatusFeasibilityCounterVisit::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_feasibility_counter', 1);
    }

    public function statusFeasibilityCounterVisitUpdate(Request $request){
        StatusFeasibilityCounterVisit::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_feasibility_counter', 1);
    }

    public function statusFeasibilityCounterVisitDelete(Request $request){
        StatusFeasibilityCounterVisit::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_feasibility_counter', 1);
    }

    public function statusPlanningInstallationCreate(Request $request){
        StatusPlanningInstallation::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_planning_installation', 1);
    }

    public function statusPlanningInstallationUpdate(Request $request){
        StatusPlanningInstallation::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_planning_installation', 1);
    }

    public function statusPlanningInstallationDelete(Request $request){
        StatusPlanningInstallation::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_planning_installation', 1);
    }

    public function statusPlanningSavCreate(Request $request){
        StatusPlanningSav::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_planning_sav', 1);
    }

    public function statusPlanningSavUpdate(Request $request){
        StatusPlanningSav::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_planning_sav', 1);
    }

    public function statusPlanningSavDelete(Request $request){
        StatusPlanningSav::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_planning_sav', 1);
    }

    public function technicianSavCreate(Request $request){
        TechnicianSav::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('technician_sav', 1);
    }

    public function technicianSavUpdate(Request $request){
        TechnicianSav::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('technician_sav', 1);
    }

    public function technicianSavDelete(Request $request){
        TechnicianSav::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('technician_sav', 1);
    }

    public function statusResolutionSavCreate(Request $request){
        StatusResolutionSav::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_resolution_sav', 1);
    }

    public function statusResolutionSavUpdate(Request $request){
        StatusResolutionSav::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_resolution_sav', 1);
    }

    public function statusResolutionSavDelete(Request $request){
        StatusResolutionSav::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_resolution_sav', 1);
    }

    public function statusPlanningDeplacementCreate(Request $request){
        StatusPlanningDeplacement::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_planning_deplacement', 1);
    }

    public function statusPlanningDeplacementUpdate(Request $request){
        StatusPlanningDeplacement::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_planning_deplacement', 1);
    }

    public function statusPlanningDeplacementDelete(Request $request){
        StatusPlanningDeplacement::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_planning_deplacement', 1);
    }

    public function newProjectInterventionUpdate(Request $request){


        $intervention = ProjectIntervention::find($request->id);
        $intervention->Date_intervention = $request->Date_intervention;
        $intervention->Horaire_intervention = $request->Horaire_intervention;
        $intervention->Statut_planning = $request->Statut_planning;
        $intervention->Merci_de_préciser_la_raison = $request->Merci_de_préciser_la_raison;
        $intervention->user_id = $request->user_id;
        if($intervention->type == 'Etude'){
            // $intervention->Chargé_dapostropheétude = $request->Chargé_dapostropheétude;
            $intervention->Devis_signé_le = $request->Devis_signé_le;
            $intervention->Réfèrent_technique = $request->Réfèrent_technique;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Validation_referent_technique = $request->Validation_referent_technique;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
            $intervention->infaisable_raisons = $request->infaisable_raisons;
            $intervention->Statut_contrat = $request->Statut_contrat;
            $intervention->Montant_TTC_Devis = $request->Montant_TTC_Devis;
            $intervention->Réflexion_Raisons = $request->Réflexion_Raisons;
            $intervention->Réflexion_Précisions = $request->Réflexion_Précisions;
            $intervention->KO_Raisons = $request->KO_Raisons;
            $intervention->KO_Précisions = $request->KO_Précisions;
            $intervention->Dossier_administratif_complet = $request->Dossier_administratif_complet;
            $intervention->Merci_de_renseigner_les_pièces_manquantes = $request->Merci_de_renseigner_les_pièces_manquantes;
            $intervention->getTravaux->each->delete();
            if($request->Statut_contrat == 'Devis Signé'){
                foreach($request->number as $value){
                    InterventionTravaux::create([
                        'intervention_id' => $intervention->id,
                        'travaux_id' => $request->travaux_id[$value] ?? null,
                        'product_id' => $request->product_id[$value] ?? null,
                        // 'Montant_TTC' => $request->Montant_TTC[$value] ?? null,
                    ]);
                }
            }
        }
        if($intervention->type == 'Pré-Visite Technico-Commercial'){
            // $intervention->Prévisiteur_TechnicohyphenCommercial = $request->Prévisiteur_TechnicohyphenCommercial;
            $intervention->Devis_signé_le = $request->Devis_signé_le;
            $intervention->Réfèrent_technique = $request->Réfèrent_technique;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Validation_referent_technique = $request->Validation_referent_technique;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
            $intervention->infaisable_raisons = $request->infaisable_raisons;
            $intervention->Statut_contrat = $request->Statut_contrat;
            $intervention->Montant_TTC_du_devis = $request->Montant_TTC_du_devis;
            $intervention->Reste_à_charge_devis = $request->Reste_à_charge_devis;
            $intervention->Reste_à_charge_client = $request->Reste_à_charge_client;
            $intervention->Survente = $request->Survente;
            $intervention->Montant_survente = $request->Montant_survente;
            $intervention->Réflexion_Raisons = $request->Réflexion_Raisons;
            $intervention->Réflexion_Précisions = $request->Réflexion_Précisions;
            $intervention->KO_Raisons = $request->KO_Raisons;
            $intervention->KO_Précisions = $request->KO_Précisions;
            $intervention->Dossier_administratif_complet = $request->Dossier_administratif_complet;
            $intervention->Merci_de_renseigner_les_pièces_manquantes = $request->Merci_de_renseigner_les_pièces_manquantes;
            $intervention->getTravaux->each->delete();
            if($request->Statut_contrat == 'Devis Signé'){
                foreach($request->number as $value){
                    InterventionTravaux::create([
                        'intervention_id' => $intervention->id,
                        'travaux_id' => $request->travaux_id[$value] ?? null,
                        'product_id' => $request->product_id[$value] ?? null, 
                    ]);
                }
            }
        }
        if($intervention->type == 'Contre Visite Technique'){
            // $intervention->Contre_prévisiteur = $request->Contre_prévisiteur;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
            $intervention->infaisable_raisons = $request->Liste_des_travaux_à_réaliser;
            $intervention->Travaux_supplémentaires = $request->Travaux_supplémentaires;
            $intervention->getTravaux->each->delete();
            if($request->Travaux_supplémentaires && $request->number){
                foreach($request->number as $value){
                    InterventionTravaux::create([
                        'intervention_id'   => $intervention->id,
                        'travaux_id'        => $request->travaux_id[$value] ?? null,
                    ]);
                }
            }
        }
        if($intervention->type == 'Installation'){
            // $intervention->Installateur_technique = $request->Installateur_technique;
            $intervention->Dossier_Installation = $request->Dossier_Installation;
            $intervention->Préparé_par = $request->Préparé_par;
            $intervention->Date = $request->Date;
            $intervention->Statut_Installation = $request->Statut_Installation;
            $intervention->Raisons = $request->Raisons;
            if(role() != 'telecommercial' && role() != 'sales_manager_externe'){
                $intervention->Photo_sauvegardé_Dropbox = $request->Photo_sauvegardé_Dropbox ?? 'no';
                $intervention->Reception_dossier_installation = $request->Reception_dossier_installation ?? 'no';
                $intervention->Paiement_d_un_reste_à_charge = $request->Paiement_d_un_reste_à_charge ?? 'no';
                if($request->Photo_sauvegardé_Dropbox){
                    $intervention->Photo_sauvegardé_Dropbox_Par = $request->Photo_sauvegardé_Dropbox_Par ?? '';
                    $intervention->Photo_sauvegardé_Dropbox_Le = $request->Photo_sauvegardé_Dropbox_Le ?? '';
                }
                if($request->Reception_dossier_installation){
                    $intervention->Reception_dossier_installation_Par = $request->Reception_dossier_installation_Par ?? '';
                    $intervention->Reception_dossier_installation_Le = $request->Reception_dossier_installation_Le ?? '';
                }
                if($request->Paiement_d_un_reste_à_charge){
                    $intervention->Montant = $request->Montant ?? '';
                    $intervention->Moyens_de_paiement = $request->Moyens_de_paiement ? implode(',' ,$request->Moyens_de_paiement) : '';
                }
            }
            $old_travaux_id = $intervention->getTravaux()->pluck('id');
            InterventionTravauxProjectControl::whereIn('travaux_id', $old_travaux_id)->get()->each->delete();
            $intervention->getTravaux->each->delete();
            if($request->Statut_Installation == 'Terminé - Complet'){
                foreach($request->number as $value){
                    $travaux = new InterventionTravaux();
                    $travaux->intervention_id = $intervention->id;
                    $travaux->travaux_id = $request->travaux_id[$value] ?? null;
                    $travaux->product_id = $request->product_id[$value] ?? null;
                    if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe'){
                        $travaux->Réception_photos_Installation = $request->Réception_photos_Installation[$value] ?? 'no';
                        $travaux->Contrôle_conformité_photos = $request->Contrôle_conformité_photos[$value] ?? '';
                        if($request->Réception_photos_Installation[$value] == 'yes'){
                            $travaux->Réception_photos_Installation_Par = $request->Réception_photos_Installation_Par[$value] ?? '';
                            $travaux->Réception_photos_Installation_Le = $request->Réception_photos_Installation_Le[$value] ?? '';
                        }
                        if($request->Contrôle_conformité_photos[$value] == 'Oui'){
                            $travaux->Contrôle_conformité_photos_Par = $request->Contrôle_conformité_photos_Par[$value] ?? '';
                            $travaux->Contrôle_conformité_photos_Le = $request->Contrôle_conformité_photos_Le[$value] ?? '';
                        }
                    }


                    $travaux->save();
                    if($request->project_control_photo && $request->project_control_photo[$value]){
                        foreach($request->project_control_photo[$value] as $key => $data){
                            if($data){
                                InterventionTravauxProjectControl::create([
                                    'travaux_id' => $travaux->id,
                                    'project_control_id' => $key,
                                    'value' => $data,
                                ]);
                            }
                            
                        }
                        // $travaux->getProjectControl()->sync($request->project_control_photo[$value] ?? []);
                    }

                }
            }
        }
        if($intervention->type == 'SAV'){
            // $intervention->Technicien_SAV = $request->Technicien_SAV;
            $intervention->Statut_SAV = $request->Statut_SAV;
            $intervention->Raisons = $request->Raisons;
            $intervention->Reception_photo_SAV = $request->Reception_photo_SAV;
            $intervention->Par = $request->Par;
            $intervention->Le = $request->Le;
            $intervention->Réception_attestation_SAV = $request->Réception_attestation_SAV;

        }

        if($intervention->type == 'Déplacement'){
            // $intervention->Technicien = $request->Technicien;
            $intervention->Précisions_déplacement = $request->Précisions_déplacement;
            $intervention->Mission_accomplie = $request->Mission_accomplie;
        }

        if($intervention->type == 'Prévisite virtuelle'){
            // $intervention->Technicien = $request->Technicien;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
            $intervention->infaisable_raisons = $request->infaisable_raisons;
        }

        $intervention->Observations = $request->Observations;
        $intervention->save();

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $intervention->custom_field_data = $json;
            $intervention->save();
        }

        // dd($intervention->getChanges());
        // $data = InterventionModule::find($request->id);
        // $reception_photo = $data->reception_photo;
        // $reception_file = $data->reception_file;

        // if($request->reception_photo_hidden){
        //     if($request->reception_photo){
        //         $reception_photo = 'yes';
        //     }else{
        //         $reception_photo = 'no';
        //     }
        // }
        // if($request->reception_file_hidden){
        //     if($request->reception_file){
        //         $reception_file = 'yes';
        //     }else{
        //         $reception_file = 'no';
        //     }
        // }

        // $data->update($request->except(['_token', 'id', 'reception_photo_hidden', 'reception_file_hidden', 'project_id', 'block_name'])+ ['reception_photo' => $reception_photo, 'reception_file' => $reception_file]);
        // dd($intervention->getChanges());
        foreach($intervention->getChanges() as $key => $value){
            if($key != 'updated_at' && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }

            if($key == 'user_id'){
                if($intervention->type == 'Etude'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Chargé d’étude',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                elseif($intervention->type == 'Pré-Visite Technico-Commercial' || $intervention->type == 'DPE'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Prévisiteur Technico-Commercial',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                elseif($intervention->type == 'Contre Visite Technique'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Contre prévisiteur',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                elseif($intervention->type == 'Installation'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Installateur technique',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                elseif($intervention->type == 'SAV'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Technicien SAV',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }

                elseif($intervention->type == 'Déplacement' || $intervention->type == 'Prévisite virtuelle'){
                    $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Intervention',
                    'block_name'    => $request->block_name,
                    'key'           => 'Technicien',
                    'value'         => User::find($value)->name ?? '',
                    'feature_id'    => $intervention->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }
        }


        return back()->with('success', __('Updated Successfully'))->with('intervention_active', 1);
    }

    public function projectQualityControlCreate(Request $request){
        ControleQuality::create($request->except('_token'));
        return back()->with('success', __('Created Successfully'))->with('qc_active', 1);
    }
    public function projectQualityControlDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse__qc', 'delete') && role() != 's_admin'){
            return back();
        } 
        $cq = ControleQuality::find($request->id);
        if($cq){
            $cq->delete();
        }
        return back()->with('success', __('Deleted Successfully'))->with('qc_active', 1);
    }

    public function projectQualityControlUpdate(Request $request){
        $data = QualityControl::find($request->id);
        $data->update($request->except(['_token', 'id', 'installation_satisfied__hidden', 'installation_equipment_installed__hidden', 'installation_recommend__hidden', 'installation_mpr_contact__hidden', 'installation_file_validation__hidden', 'installation_client_respond__hidden', 'installation_paid_consent__hidden', 'installation_customer_call__hidden', 'installation_receive_invoice__hidden', 'installation_review__hidden', 'installation_carry_out__hidden', 'installation_action_logement__hidden', 'installation_contact_us__hidden', 'installation_contact_soon__hidden', 'installation_release_fund__hidden', 'previsite_have_insulation__hidden', 'previsite_have_insulation_wall__hidden', 'previsite_have_insulation_basement__hidden', 'previsite_bio_services__hidden', 'previsite_question_material__hidden', 'previsite_have_children__hidden', 'previsite_current_credits__hidden', 'previsite_have_bdc_copy__hidden']));

        if($request->installation_satisfied__hidden){
            if(!$request->installation_satisfied){
                $data->installation_satisfied = 'no';
            }
        }
        if($request->installation_equipment_installed__hidden){
            if(!$request->installation_equipment_installed){
                $data->installation_equipment_installed = 'no';
            }
        }
        if($request->installation_recommend__hidden){
            if(!$request->installation_recommend){
                $data->installation_recommend = 'no';
            }
        }
        if($request->installation_mpr_contact__hidden){
            if(!$request->installation_mpr_contact){
                $data->installation_mpr_contact = 'no';
            }
        }
        if($request->installation_file_validation__hidden){
            if(!$request->installation_file_validation){
                $data->installation_file_validation = 'no';
            }
        }
        if($request->installation_client_respond__hidden){
            if(!$request->installation_client_respond){
                $data->installation_client_respond = 'no';
            }
        }
        if($request->installation_paid_consent__hidden){
            if(!$request->installation_paid_consent){
                $data->installation_paid_consent = 'no';
            }
        }
        if($request->installation_customer_call__hidden){
            if(!$request->installation_customer_call){
                $data->installation_customer_call = 'no';
            }
        }
        if($request->installation_receive_invoice__hidden){
            if(!$request->installation_receive_invoice){
                $data->installation_receive_invoice = 'no';
            }
        }
        if($request->installation_review__hidden){
            if(!$request->installation_review){
                $data->installation_review = 'no';
            }
        }
        if($request->installation_carry_out__hidden){
            if(!$request->installation_carry_out){
                $data->installation_carry_out = 'no';
            }
        }
        if($request->installation_action_logement__hidden){
            if(!$request->installation_action_logement){
                $data->installation_action_logement = 'no';
            }
        }
        if($request->installation_contact_us__hidden){
            if(!$request->installation_contact_us){
                $data->installation_contact_us = 'no';
            }
        }
        if($request->installation_contact_soon__hidden){
            if(!$request->installation_contact_soon){
                $data->installation_contact_soon = 'no';
            }
        }
        if($request->installation_release_fund__hidden){
            if(!$request->installation_release_fund){
                $data->installation_release_fund = 'no';
            }
        }
        if($request->previsite_have_insulation__hidden){
            if(!$request->previsite_have_insulation){
                $data->previsite_have_insulation = 'no';
            }
        }
        if($request->previsite_have_insulation_wall__hidden){
            if(!$request->previsite_have_insulation_wall){
                $data->previsite_have_insulation_wall = 'no';
            }
        }
        if($request->previsite_have_insulation_basement__hidden){
            if(!$request->previsite_have_insulation_basement){
                $data->previsite_have_insulation_basement = 'no';
            }
        }
        if($request->previsite_bio_services__hidden){
            if(!$request->previsite_bio_services){
                $data->previsite_bio_services = 'no';
            }
        }
        if($request->previsite_question_material__hidden){
            if(!$request->previsite_question_material){
                $data->previsite_question_material = 'no';
            }
        }
        if($request->previsite_have_children__hidden){
            if(!$request->previsite_have_children){
                $data->previsite_have_children = 'no';
            }
        }
        if($request->previsite_current_credits__hidden){
            if(!$request->previsite_current_credits){
                $data->previsite_current_credits = 'no';
            }
        }
        if($request->previsite_have_bdc_copy__hidden){
            if(!$request->previsite_have_bdc_copy){
                $data->previsite_have_bdc_copy = 'no';
            }
        }

        $data->save();

        return back()->with('success', __('Updated Successfully'))->with('qc_active', 1);

    }


    public function projectControlSurSiteCreate(Request $request){
        ControleSurSite::create($request->except('_token'));
        return back()->with('susscess', __('Created Successfully'))->with('css_active', 1);
    }
    public function projectControlSurSiteDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse__section_sur_site', 'delete') && role() != 's_admin'){
            return back();
        } 
        $controle_sur_site = ControleSurSite::find($request->id);
        if($controle_sur_site){
            $controle_sur_site->delete();
        }
        return back()->with('susscess', __('Deleted Successfully'))->with('css_active', 1);
    }

    public function projectControlOfficeCreate(Request $request){
        ControlOffice::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('control_office', 1);
    }

    public function projectControlOfficeUpdate(Request $request){
        ControlOffice::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('control_office', 1);
    }

    public function projectControlOfficeDelete(Request $request){
        ControlOffice::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('control_office', 1);
    }

    public function projectInspectionStatusCreate(Request $request){
        InspectionStatus::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('inspection_status', 1);
    }

    public function projectInspectionStatusUpdate(Request $request){
        InspectionStatus::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('inspection_status', 1);
    }

    public function projectInspectionStatusDelete(Request $request){
        InspectionStatus::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('inspection_status', 1);
    }

    public function projectControlledWorkCreate(Request $request){
        ControlledWork::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('controlled_workd', 1);
    }

    public function projectControlledWorkUpdate(Request $request){
        ControlledWork::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('controlled_workd', 1);
    }

    public function projectControlledWorkDelete(Request $request){
        ControlledWork::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('controlled_workd', 1);
    }

    public function projectComplianceCreate(Request $request){
        Compliance::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('compliance', 1);
    }

    public function projectComplianceUpdate(Request $request){
        Compliance::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('compliance', 1);
    }

    public function projectComplianceDelete(Request $request){
        Compliance::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('compliance', 1);
    }

    public function projectCompanyCommissionedCreate(Request $request){
        CompanyCommissioned::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('company_commissioned', 1);
    }

    public function projectCompanyCommissionedUpdate(Request $request){
        CompanyCommissioned::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('company_commissioned', 1);
    }

    public function projectCompanyCommissionedDelete(Request $request){
        CompanyCommissioned::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('company_commissioned', 1);
    }

    public function projectCommissioningTechnicianCreate(Request $request){
        CommissioningTechnician::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('commissioning_technician', 1);
    }

    public function projectCommissioningTechnicianUpdate(Request $request){
        CommissioningTechnician::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('commissioning_technician', 1);
    }

    public function projectCommissioningTechnicianDelete(Request $request){
        CommissioningTechnician::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('commissioning_technician', 1);
    }

    public function projectCommissioningStatusCreate(Request $request){
        CommissioningStatus::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('commissioning_status', 1);
    }

    public function projectCommissioningStatusUpdate(Request $request){
        CommissioningStatus::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('commissioning_status', 1);
    }

    public function projectCommissioningStatusDelete(Request $request){
        CommissioningStatus::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('commissioning_status', 1);
    }

    public function projectStatusInvoiceCreate(Request $request){
        StatusInvoiceCompany::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('status_invoice_company', 1);
    }

    public function projectStatusInvoiceUpdate(Request $request){
        StatusInvoiceCompany::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('status_invoice_company', 1);
    }

    public function projectStatusInvoiceDelete(Request $request){
        StatusInvoiceCompany::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('status_invoice_company', 1);
    }

    public function projectControlOfficeCspCreate(Request $request){
        ControlOfficeCsp::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('control_office_csp', 1);
    }

    public function projectControlOfficeCspUpdate(Request $request){
        ControlOfficeCsp::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('control_office_csp', 1);
    }

    public function projectControlOfficeCspDelete(Request $request){
        ControlOfficeCsp::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('control_office_csp', 1);
    }


    public function controlSurSiteUpdate(Request $request){
        // dd($request->all());
        $controle_sur_site = ControleSurSite::find($request->id);
        // if($request->file('report')){
        //     $file = $request->file('report');
        //     $fileName = $controle_sur_site->id.time().'.'.$file->extension();
        //     $report_file_name = $file->getClientOriginalName();
        //     $file->move(public_path('uploads/controle_sur_site'), $fileName);
        //     $controle_sur_site->report = $fileName;
        //     $controle_sur_site->report_file_name = $report_file_name;
        // }
        if($controle_sur_site->type == 'COFRAC'){
            $controle_sur_site->Bureau_de_contrôle_id = $request->Bureau_de_contrôle_id;
            $controle_sur_site->Date_de_contrôle = $request->Date_de_contrôle;
            $controle_sur_site->horaire_intervention = $request->horaire_intervention;
            $controle_sur_site->Conformité_du_chantier = $request->Conformité_du_chantier;
            $controle_sur_site->Surface_contrôlée = $request->Surface_contrôlée;
            $controle_sur_site->Ecart_surface = $request->Ecart_surface;
            $controle_sur_site->Ecart_de_surface = $request->Ecart_de_surface;
            $controle_sur_site->Surface_réalisé_sur_facture = $request->Surface_réalisé_sur_facture;
            $controle_sur_site->Étape_du_contrôle = $request->Étape_du_contrôle;
            $controle_sur_site->getReason->each->delete();
            $controle_sur_site->getAction->each->delete();
            // if($request->Conformité_du_chantier == "Non Conforme" && $request->Raisons_de_non_conformité){
            //     foreach($request->Raisons_de_non_conformité as $reason){
            //         NonConfirmReason::create([
            //             'controle_sur_site_id' => $controle_sur_site->id,
            //             'reason'               => $reason
            //         ]);
            //     }
            // }
            if($request->number){
                foreach($request->number as $index){
                    if($request->Conformité_du_chantier == "Non Conforme"){
                        NonConfirmReason::create([
                            'controle_sur_site_id'              => $controle_sur_site->id,
                            'reason'                            => $request->Raisons_de_non_conformité[$index] ?? '',
                            'Description_action_corrective'     => $request->Description_action_corrective[$index] ?? '',
                            'Date'                              => $request->Date[$index] ?? '',
                            'Statut_mise_en_conformité'         => $request->Statut_mise_en_conformité[$index] ?? '',
                        ]); 
                    }
                    // CompleteAction::create([
                    //     'controle_sur_site_id'              => $controle_sur_site->id,
                    //     'Description_action_corrective'     => $request->Description_action_corrective[$index] ?? '',
                    //     'Date'                              => $request->Date[$index] ?? '',
                    //     'Statut_mise_en_conformité'         => $request->Statut_mise_en_conformité[$index] ?? '',
                    // ]);
                }
            }
        }

        if($controle_sur_site->type == 'MISE EN SERVICE'){
            $controle_sur_site->Société_MES = $request->Société_MES;
            $controle_sur_site->Date_MES = $request->Date_MES;
            $controle_sur_site->deal = $request->deal;
            $controle_sur_site->Rapport_MES_dans_Dropbox = $request->Rapport_MES_dans_Dropbox;
            $controle_sur_site->Conformité_du_chantier = $request->Conformité_du_chantier;
            $controle_sur_site->getReason->each->delete();
            $controle_sur_site->getAction->each->delete();
            if($request->Conformité_du_chantier && $request->Conformité_du_chantier != "Conforme" && $request->Raisons_de_non_conformité){
                foreach($request->Raisons_de_non_conformité as $reason){
                    NonConfirmReason::create([
                        'controle_sur_site_id' => $controle_sur_site->id,
                        'reason'               => $reason
                    ]);
                }
            }
            if($request->number){
                foreach($request->number as $index){
                    CompleteAction::create([
                        'controle_sur_site_id'              => $controle_sur_site->id,
                        'Description_action_corrective'     => $request->Description_action_corrective[$index] ?? '',
                        'Date'                              => $request->Date[$index] ?? '',
                        'Statut_mise_en_conformité'         => $request->Statut_mise_en_conformité[$index] ?? '',
                    ]);
                }
            }


        }
        if($controle_sur_site->type == 'CSP MPR'){
            $controle_sur_site->Bureau_de_contrôle_id = $request->Bureau_de_contrôle_id;
            $controle_sur_site->Date_de_contrôle = $request->Date_de_contrôle;
            $controle_sur_site->Réception_du_bordereau_de_passage = $request->Réception_du_bordereau_de_passage;
            $controle_sur_site->Conformité_du_chantier = $request->Conformité_du_chantier;
            $controle_sur_site->getReason->each->delete();
            if($request->Conformité_du_chantier && $request->Conformité_du_chantier != "Conforme" && $request->Raisons_de_non_conformité){
                foreach($request->Raisons_de_non_conformité as $reason){
                    NonConfirmReason::create([
                        'controle_sur_site_id' => $controle_sur_site->id,
                        'reason'               => $reason
                    ]);
                }
            }
        }

        $controle_sur_site->getTravaux()->sync($request->Travaux_contrôlés);
        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $controle_sur_site->custom_field_data = $json;
        }

        $controle_sur_site->Observations = $request->Observations;
        $controle_sur_site->save();
        // dd($data->getChanges());

        foreach($controle_sur_site->getChanges() as $key => $value){
            if($key != 'updated_at'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Contrôle sur site',
                    'block_name'    => $request->block_name,
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        return back()->with('susscess', __('Updated Successfully'))->with('css_active', 1);
    }

    public function controlSurSiteFileUpdate(Request $request){
        $controle_sur_site = ControleSurSite::find($request->id);
        if($request->file('report')){
            $file = $request->file('report');
            $fileName = $controle_sur_site->id.time().'.'.$file->extension();
            $report_file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/controle_sur_site'), $fileName);
            $controle_sur_site->report = $fileName;
            $controle_sur_site->report_file_name = $report_file_name;
        }
        $controle_sur_site->save();

        return back()->with('susscess', __('Updated Successfully'))->with('css_active', 1);
    }

    public function controlSurSiteFileDelete(Request $request){
        $controle_sur_site = ControleSurSite::find($request->id);
        if($controle_sur_site){
            $controle_sur_site->update([
                'report' => '',
                'report_file_name' => '',
            ]);
        }

        return back()->with('susscess', __('Deleted Successfully'))->with('css_active', 1);

    }

    public function controlSurSiteFileNameEdit(Request $request){
        $controle_sur_site = ControleSurSite::find($request->id);
        if($controle_sur_site){
            $controle_sur_site->update([
                'report_file_name' => $request->name,
            ]);
        }

        return back()->with('susscess', __('Updated Successfully'))->with('css_active', 1);

    }

    public function projectFacturationUpdate(Request $request){

        // dd($request->all());

        $facturation = ProjectFacturation::find($request->id);
        $invoices = '';
        if($request->Moyens_de_paiement){
            $invoices = implode(',', $request->Moyens_de_paiement);
        }
        $facturation->update($request->except(['_token', 'id', 'project_id', 'Moyens_de_paiement', 'La_lettre_de_versement', 'Entreprise_de_travaux'])+['Moyens_de_paiement' => $invoices, 'Paiement_inférieur_au_montant_prévu' => $request->Paiement_inférieur_au_montant_prévu ?? 'no', 'Avance_délégataire_MaPrimeRénov' => $request->Avance_délégataire_MaPrimeRénov ?? 'no', 'Lettre_de_versement' => $request->Lettre_de_versement ?? 'no' ]);

        foreach($facturation->getChanges() as $key =>$value)
        {
             if($key != 'updated_at')
             {
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Facturation',
                    'block_name'    => 'Suivi Facturation',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
             }
        }
        if($facturation->type == 'Encaissement MaPrimeRénov’'){
            $facturation->facturationEntreprise()->sync($request->Entreprise_de_travaux);
        }

        // if($request->file('La_lettre_de_versement')){
        //     $file = $request->file('La_lettre_de_versement');
        //     $extension = $file->extension();
        //     $fileName = time().'.'.$file->extension();
        //     $La_lettre_de_versement_file_name = $file->getClientOriginalName();
        //     $file->move(public_path('uploads/facturation'), $fileName);

        //     $facturation->La_lettre_de_versement = $fileName;
        //     $facturation->La_lettre_de_versement_file_name = $La_lettre_de_versement_file_name;
        // }
        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $facturation->custom_field_data = $json;
        }
        $facturation->save();


        return back()->with('success', __('Updated Succesfully'))->with('facturation_active', 1);
    }

    public function projectFacturationFileUpdate(Request $request){

        $facturation = ProjectFacturation::find($request->id);

        if($request->file('La_lettre_de_versement')){
            $file = $request->file('La_lettre_de_versement');
            $extension = $file->extension();
            $fileName = time().'.'.$file->extension();
            $La_lettre_de_versement_file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/facturation'), $fileName);

            $facturation->La_lettre_de_versement = $fileName;
            $facturation->La_lettre_de_versement_file_name = $La_lettre_de_versement_file_name;
            $facturation->save();
        }
        return back()->with('success', __('Updated Succesfully'))->with('facturation_active', 1);

    }

    public function projectFacturationFileDelete(Request $request){
        $facturation = ProjectFacturation::find($request->id);
        if($facturation){
            $facturation->update([
                'La_lettre_de_versement' => '',
                'La_lettre_de_versement_file_name' => '',
            ]);
        }

        return back()->with('susscess', __('Deleted Successfully'))->with('facturation_active', 1);

    }

    public function projectFacturationleNameEdit(Request $request){
        $facturation = ProjectFacturation::find($request->id);
        if($facturation){
            $facturation->update([
                'La_lettre_de_versement_file_name' => $request->name,
            ]);
        }

        return back()->with('susscess', __('Updated Successfully'))->with('facturation_active', 1);

    }

    public function qualityControleQuestionStore(Request $request){
        foreach($request->qc_label_title as $key => $value){
            QualityControlQuestion::create([
                'quality_control_id'    => $request->qc_id,
                'type'                  => 'question',
                'question_title'        => $request->qc_label_title[$key],
                'question_name'         => Str::snake($request->qc_label_title[$key], '_'),
                'question_type'         => $request->qc_input_type[$key],
                'question_required'     => $request->qc_required_optional[$key],
                'question_options'      => $request->qc_options[$key],
            ]);
        }
        return back()->with('success', __('Created Successfully'))->with('qc_active', 1);

    }

    public function qualityControleHeaderStore(Request $request){
        QualityControlQuestion::create([
            'quality_control_id'    => $request->qc_id,
            'type'                  => 'header',
            'header_title'          => $request->qc_header,
            'header_color'          => $request->qc_header_color,
        ]);
        return back()->with('success', __('Created Successfully'))->with('qc_active', 1);
    }

    public function projectQualityControlPostEtudeupdate(Request $request){
        $input_key = [];
        $input_item = [];
        $status = $request->qc_status == 'yes' ? 1:0;
        // dd($request->all());
        // foreach($request->field_name as $key => $value){
        //     if(!$request->$value){
        //         $status = 0;
        //         break;
        //     };
        // }
        foreach($request->except(['_token','id', 'project_id', 'block_name', 'field_name', 'qc_status']) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                        if(!PannelLogActivity::where('tab_name',  'Contrôle Qualité')->where('block_name', $request->block_name)->where('key', $data2)->where('value', $checkbox)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
                        {
                            $pannel_activity = PannelLogActivity::create([
                                'tab_name'      => 'Contrôle Qualité',
                                'block_name'    => $request->block_name,
                                'key'           => $data2,
                                'value'         => $checkbox,
                                'feature_id'    => $request->project_id,
                                'feature_type'  => 'project',
                                'user_id'       => Auth::id(),
                            ]);
                            event(new PannelLog($pannel_activity->id));
                        }
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;

                    if(!PannelLogActivity::where('tab_name',  'Contrôle Qualité')->where('block_name', $request->block_name)->where('key', $key)->where('value', $item)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
                    {
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Contrôle Qualité',
                            'block_name'    => $request->block_name,
                            'key'           => $key,
                            'value'         => $item,
                            'feature_id'    => $request->project_id,
                            'feature_type'  => 'project',
                            'user_id'       => Auth::id(),
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                }

        }
        $costom_field_data = array_combine($input_key, $input_item);
        $json = json_encode($costom_field_data);
        $quality_control = ControleQuality::find($request->id);
        $quality_control->data = $json;
        $quality_control->status = $status;
        $quality_control->save();


        return back()->with('success', __('Updated Successfully'))->with('qc_active', 1);
    }

    public function projectManagementControlUpdate(Request $request){
         $management_control = ManagementControl::find($request->id);

        $material_invoice = $management_control->material_invoice;
        $installer_invoice = $management_control->installer_invoice;
        $commercial_invoice = $management_control->commercial_invoice;
        $provider_invoice = $management_control->provider_invoice;
        $other_invoice_1 = $management_control->other_invoice_1;
        $other_invoice_2 = $management_control->other_invoice_2;
        $other_invoice_3 = $management_control->other_invoice_3;

        if(!$request->material_invoice){
            $management_control->material_invoice = 'no';
        }
        if(!$request->installer_invoice){
            $management_control->installer_invoice = 'no';
        }
        if(!$request->commercial_invoice){
            $management_control->commercial_invoice = 'no';
        }
        if(!$request->provider_invoice){
            $management_control->provider_invoice = 'no';
        }
        if(!$request->other_invoice_1){
            $management_control->other_invoice_1 = 'no';
        }
        if(!$request->other_invoice_2){
            $management_control->other_invoice_2 = 'no';
        }
        if(!$request->other_invoice_3){
            $management_control->other_invoice_3 = 'no';
        }

        $management_control->update($request->except(['_token', 'id', 'project_id']) + ['material_invoice' => $material_invoice, 'installer_invoice' => $installer_invoice, 'commercial_invoice' => $commercial_invoice, 'provider_invoice' => $provider_invoice, 'other_invoice_1' => $other_invoice_1, 'other_invoice_2' => $other_invoice_2, 'other_invoice_3' => $other_invoice_3]);
        $management_control->save();
        foreach($management_control->getChanges() as $key =>$value)
        {
             if($key != 'updated_at')
             {
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Facturation',
                    'block_name'    => 'Contrôle de gestion',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
             }
        }

         return back()->with('success', __('Updated Succesfully'))->with('facturation_active', 1);
    }

    public function commercialInvoiceCreate(Request $request){
        Commercial::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('invoice_commercial', 1);
    }

    public function commercialInvoiceUpdate(Request $request){
        Commercial::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('invoice_commercial', 1);
    }

    public function commercialInvoiceDelete(Request $request){
        Commercial::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('invoice_commercial', 1);
    }

    public function previsitorCreate(Request $request){
        Previsitor::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('previsiteur', 1);
    }

    public function previsitorUpdate(Request $request){
        Previsitor::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('previsiteur', 1);
    }

    public function previsitorDelete(Request $request){
        Previsitor::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('previsiteur', 1);
    }

    public function ticketProblemCreate(Request $request){
        TicketProblemStatus::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('ticket_problem_status', 1);
    }

    public function ticketProblemUpdate(Request $request){
        TicketProblemStatus::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('ticket_problem_status', 1);
    }

    public function ticketProblemDelete(Request $request){
        TicketProblemStatus::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('ticket_problem_status', 1);
    }

    public function projectPrestationChange(Request $request){
        $prestation = Benefit::find($request->id);
        $view = view('admin.prestation', compact('prestation'))->render();
        return response($view);
    }

    public function additionalProductBulkDelete(Request $request){
        $ids = explode(',', $request->ids);
        AdditionalProduct::findMany($ids)->each->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('davis_active', 'Compatability tab ko active koro');
    }

    public function energyTypeCreate(Request $request){
        EnergyType::create($request->except('_token'));
        return back()->with('success', __("Created Successfully"))->with('energy_type', 1);
    }

    public function energyTypeUpdate(Request $request){
        EnergyType::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __("Updated Successfully"))->with('energy_type', 1);
    }

    public function energyTypeDelete(Request $request){
        EnergyType::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('energy_type', 1);
    }
    public function prestationGroupCreate(Request $request){
        $prestation = PrestationGroup::where('code', $request->code)->exists();
        if($prestation){
            return back()->with('error', __("Code Already Exists"))->with('prestation_group', 1);
        }else{
            $item = PrestationGroup::create([
                'product_id'  => $request->product_id,
                'code'        => $request->code,
            ]);

            foreach($request->prestation_id as $key => $value){
                PrestationGroupItem::create([
                    'prestation_group_id'   => $item->id,
                    'prestation_id'         => $value,
                    'price'                 => $request->price[$key],
                    'quantity'              => $request->quantity[$key],
                    'tax'                   => $request->tax[$key]
                ]);
            }

            return back()->with('success', __("Created Successfully"))->with('prestation_group', 1);
        }
    }

    public function prestationGroupUpdate(Request $request){
        $prestation = PrestationGroup::find($request->id);
        if(PrestationGroup::where('code', $request->code)->where('id', '<>' ,$request->id)->exists()){
            return back()->with('error', __("Code Already Exists"))->with('prestation_group', 1);
        }else{
            $prestation->update([
                'product_id'  => $request->product_id,
                'code'        => $request->code,
            ]);
        }
        return back()->with('success', __("Updated Successfully"))->with('prestation_group', 1);
    }

    public function prestationGroupDelete(Request $request){
        PrestationGroup::find($request->id)->delete();
        PrestationGroupItem::where('prestation_group_id', $request->id)->get()->each->delete();

        return back()->with('success', __("Deleted Successfully"))->with('prestation_group', 1);
    }

    public function projectLockAccess(Request $request){

       $pannel_activity = PannelLogActivity::create($request->except(['_token','tab'])+['user_id' => Auth::id()]);

        if($request->value == 'open'){
            Session::put($request->tab, 'active');
        }else{
            Session::forget($request->tab);
        }
        event(new PannelLog($pannel_activity->id));
        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $request->feature_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response($activity);
    }

    public function projectTaxRemove(Request $request){

        $tax = ProjectTax::find($request->tax_id);
        if($tax->primary == 'yes'){
            return redirect()->back()->with('error', __('This is primary Tax, Please another one'))->with('client_active', 'tax tab ko active');
        }else{
            $tax->delete();
            return redirect()->back()->with('success', __('Tax remove successfully'))->with('client_active', 'tax tab ko active');
        }
    }

    public function projectCallbackSetting(Request $request){
        $project = NewProject::find($request->id);
        if($project){
            $project->update([
                 'callback_time' => $request->callback_time,
                 'callback_mail_status' => 'no',
                 'callback_history_type' => 0,
                 'callback_user_id' => Auth::id(),
                 'callback_observations' => $request->callback_observations,
             ]);

             $pannel_activity = PannelLogActivity::create([
                 'tab_name'      => 'client',
                 'block_name'    => "Rappler",
                 'key'           => "callback_setting__activity",
                 'value'         => $request->callback_time,
                 'feature_id'    => $project->id,
                 'feature_type'  => 'project',
                 'user_id'       => Auth::id(),
             ]);

             event(new PannelLog($pannel_activity->id));

             return back()->with(__("Updated Succesfully"));
        }else{
            return back();
        }
    }

    public function projectFiscalStatusChange(Request $request){
        ProjectTax::find($request->tax_id)->update([
            $request->field => $request->status,
        ]);

        return response('Mise à jour réussie');
    }

    public function projectStatusChange(Request $request){
        $project = NewProject::find($request->id);
        if($project->projectSecondTable && ($project->projectSecondTable->manual_import == 1 || $project->projectSecondTable->manual_import == 2)){
            $project->project_label       = $request->status;
            $project->project_sub_status  = $request->sub_status;
            $project->project_ko_reason   = $request->dead_reason;
            $project->save();
            return back()->with('success', 'Statut mis à jour');
        }
        $bareme_status = false;
        if($project->ProjectBareme->whereIn('id',  [28,29])->first()){
            $bareme_status = true;
        }

        if($project->project_label != $request->status){
            if((!$project->Type_de_contrat || !$project->Faisabilité_du_projet || !$project->Statut_Projet) && (($project->Type_de_contrat != 'BAR TH 173' || $project->project_label == 5 || $project->project_label == 6))){
                return back()->with('error', "Type de contrat, Faisabilité du projet, statut projet certains d'entre eux manquent");
            }
            if(!$bareme_status && (!$project->primaryTax || $project->primaryTax->tax_number == '0000000000') && ($request->status == '3' || $request->status == '4' || $request->status == '5' || $request->status == '6' || $request->status == '8')){
                return back()->with('error', 'Avis d’Impot pas réel');
            }
            if($project->getSubventions->first() && (!$project->getSubventions->first()->subvention_status || $project->getSubventions->first()->subvention_status == 'Demande de subvention déposé' || $project->getSubventions->first()->subvention_status == 'En cours d’instruction' || $project->getSubventions->first()->subvention_status == 'Dépôt de subvention en attente de complément') && ($request->status == '4' || $request->status == '5' || $request->status == '6' || $request->status == '8')){
                return back()->with('error', 'Statut MPR - La subvention est invalide');
            }
            $pannel_activity = PannelLogActivity::create([
                'label_prev_id' => $project->project_label,
                'label_id'      => $request->status,
                'status'        => 'change_etiquette',
                'key'           => "etiquette",
                'dead_reason'   => $request->dead_reason,
                'feature_type'  => 'project',
                'feature_id'    => $request->id,
                'user_id'       => Auth::id(),
            ]);

            $project->etiquette_automatise_recurrence_status = 0;
            $project->etiquette_automatise_id = 0; 
            $project->etiquette_fin = 1;

            StatusChangeLog::create([
                'feature_id' => $project->id,
                'from_id' => $project->project_label,
                'to_id' => $request->status,
                'statut_id' => $request->sub_status,
                'regie_id' => $project->getProjectTelecommercial ? ($project->getProjectTelecommercial->getRegie ? $project->getProjectTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $project->project_telecommercial ?? null,
                'status_type' => 'main',
                'type' => 'project', 
            ]);

            if(!$project->projectSecondTable){
                $project_second_table = NewProject2::create([
                    'project_id' => $project->id
                ]);
            }else{
                $project_second_table = $project->projectSecondTable;
            }

            $project_second_table->update([
                'etiquette_automatise_not_change' => 0,
                'etiquette_automatise_not_change_id' => null,
                'etiquette_automatise_not_change_start' => null,
           ]);

            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'chantier')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $automatisation_status_not_changes = Automatise::where('automatisation_for', 'chantier')->where('type_de_campagne', 'status_not_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($project->ProjectTravaux as $item){
                $travaux .= $item->travaux .($travaux_count != $project->ProjectTravaux->count() ? ', ':'');
                $travaux_count++;
            }
            foreach($automatisation_status_not_changes as $automatisation_status_not_change)
            {
                if(str_contains($automatisation_status_not_change->status, 'main'))
                {
                     $status = explode('_', $automatisation_status_not_change->status); 

                    if($status[1] == $request->status)
                    {
                        $project_second_table->update([
                             'etiquette_automatise_not_change' => 1,
                             'etiquette_automatise_not_change_id' => $automatisation_status_not_change->id,
                             'etiquette_automatise_not_change_start' => Carbon::now(),
                        ]);
                    }   
                }
            }
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'main'))
                {
                     $status = explode('_', $automatisation->status); 

                    if($status[1] == $request->status)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $project->etiquette_automatise_recurrence_status = 1;
                            $project->etiquette_automatise_id = $automatisation->id;
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
                            $body = str_replace('{raison}', $request->dead_reason, $body);

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
                        $body = str_replace('{raison}', $request->dead_reason, $body);
                        
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
                }
            }



        }
        if($project->project_sub_status != $request->sub_status){
            $pannel_activity = PannelLogActivity::create([
                'status_prev_id' => $project->project_sub_status,
                'status_id'      => $request->sub_status,
                'status'         => 'change_etiquette',
                'key'            => "status",
                'feature_type'   => 'project',
                'feature_id'     => $request->id,
                'user_id'        => Auth::id(),
            ]);

            $project->statut_automatise_recurrence_status = 0;
            $project->statut_automatise_id = 0; 
            $project->statut_fin = 1;

            StatusChangeLog::create([
                'feature_id' => $project->id,
                'from_id' => $project->project_sub_status,
                'to_id' => $request->sub_status,
                'statut_id' => $request->sub_status,
                'regie_id' => $project->getProjectTelecommercial ? ($project->getProjectTelecommercial->getRegie ? $project->getProjectTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $project->project_telecommercial ?? null,
                'status_type' => 'sub',
                'type' => 'project', 
            ]);

            if(!$project->projectSecondTable){
                $project_second_table = NewProject2::create([
                    'project_id' => $project->id
                ]);
            }else{
                $project_second_table = $project->projectSecondTable;
            }

            $project_second_table->update([
                'statut_automatise_not_change' => 0,
                'statut_automatise_not_change_id' => null,
                'statut_automatise_not_change_start' => null,
           ]);

            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'chantier')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $automatisation_status_not_changes = Automatise::where('automatisation_for', 'chantier')->where('type_de_campagne', 'status_not_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($project->ProjectTravaux as $item){
                $travaux .= $item->travaux .($travaux_count != $project->ProjectTravaux->count() ? ', ':'');
                $travaux_count++;
            }


            
            foreach($automatisation_status_not_changes as $automatisation_status_not_change)
            {
                if(str_contains($automatisation_status_not_change->status, 'sub'))
                {
                     $status = explode('_', $automatisation_status_not_change->status); 

                    if($status[1] == $request->sub_status)
                    {
                        $project_second_table->update([
                            'statut_automatise_not_change' => 1,
                            'statut_automatise_not_change_id' => $automatisation_status_not_change->id,
                            'statut_automatise_not_change_start' => Carbon::now(),
                       ]);
                    }   
                }
            }
            
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'sub'))
                {
                     $status = explode('_', $automatisation->status); 

                    if($status[1] == $request->sub_status)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $project->statut_automatise_recurrence_status = 1;
                            $project->statut_automatise_id = $automatisation->id;
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
                            $body = str_replace('{raison}', $request->dead_reason, $body);
                            
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
                         $body = str_replace('{raison}', $request->dead_reason, $body);
                         
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
                }
            }


        }

        $project->project_label       = $request->status;
        $project->project_sub_status  = $request->sub_status;
        $project->project_ko_reason   = $request->dead_reason;
        $project->save();

        // $project->update([
        //     'project_label'       => $request->status,
        //     'project_sub_status'  => $request->sub_status,
        //     'project_ko_reason'   => $request->dead_reason,
        // ]);


        return back()->with('success', 'Statut mis à jour');
    }

    public function projectKoRaisonUpdate(Request $request){
        NewProject::find($request->project_id)->update([
            'project_ko_reason' => $request->value,
        ]);
        return response('success');
    }

    public function projectSimilarFile($id){
        $project = NewProject::find($id);
        if($project && $project->deleted_status == 0  && ($project->Nom || $project->Adresse || $project->phone)){
            $projects = NewProject::where('deleted_status', 0)->where(function($query) use($project){
                if($project->Nom && $project->Adresse && $project->phone){
                    $query->where('Nom', $project->Nom)->orWhere('Adresse', $project->Adresse)->orWhere('phone', $project->phone);
                }elseif($project->Nom && $project->Adresse){
                    $query->where('Nom', $project->Nom)->orWhere('Adresse', $project->Adresse);
                }elseif($project->Nom && $project->phone){
                    $query->where('Nom', $project->Nom)->orWhere('phone', $project->phone);
                }elseif($project->Adresse && $project->phone){
                    $query->where('Adresse', $project->Adresse)->orWhere('phone', $project->phone);
                }elseif($project->Nom){
                    $query->where('Nom', $project->Nom);
                }elseif($project->Adresse){
                    $query->where('Adresse', $project->Adresse);
                }elseif($project->phone){
                    $query->where('phone', $project->phone);
                }
            })->get();

            return view('admin.project-similar-file', compact('projects'));
        }
        // $primary_tax = ProjectTax::find($tax_id);
        // if($primary_tax->getProject && $primary_tax->getProject->deleted_status == 0){
        //     $similar_tax = ProjectTax::whereIn('id', checkProjectDuplicateEntry($primary_tax))->get();
        //     return view('admin.project-similar-file', compact('primary_tax', 'similar_tax'));
        // }
        return redirect()->route('project.index');
    }

    public function projectTelecommercialAssign(Request $request){
        $selected_id = explode(',', $request->checkedProject);
        foreach($selected_id as $id){
            $project = NewProject::find($id);
            if($project && $request->user_id != $project->project_telecommercial){
                $project->update([
                    'project_telecommercial' => $request->user_id,
                ]);

                $pannel_activity = PannelLogActivity::create([
                    'key'           => 'telecommercial__change',
                    'value'         => $request->user_id,
                    'feature_id'    => $project->id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(), 
                ]);

                event(new PannelLog($pannel_activity->id));
            }
        }
        return back()->with('success', __('Updated Successfully'));
    }
    public function projectGestionnaireAssign(Request $request){
        $selected_id = explode(',', $request->checkedProject);
        foreach($selected_id as $id){
            $project = NewProject::find($id);
            if($project && $request->user_id != $project->project_gestionnaire){
                $project->update([
                    'project_gestionnaire' => $request->user_id,
                ]);

                $pannel_activity = PannelLogActivity::create([
                    'key'           => 'gestionnaire__change',
                    'value'         => $request->user_id,
                    'feature_id'    => $project->id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(), 
                ]);

                event(new PannelLog($pannel_activity->id));
            }
        }
        return back()->with('success', __('Updated Successfully'));
    }
    public function projectTelecommercialUnassign(Request $request){
        $selected_id = explode(',', $request->checkedProject);
        foreach($selected_id as $id){
            $project = NewProject::find($id);
            if($project){
                $project->update([
                    'project_telecommercial' => null,
                ]);
            }
        }
        return back()->with('success', __('Updated Successfully'));
    }
    public function projectGestionnaireUnassign(Request $request){
        $selected_id = explode(',', $request->checkedProject);
        foreach($selected_id as $id){
            $project = NewProject::find($id);
            if($project){
                $project->update([
                    'project_gestionnaire' => null,
                ]);
            }
        }
        return back()->with('success', __('Updated Successfully'));
    }

    public function projectBarameChange(Request $request){
        $selected_bareme = $request->id;
        if($request->id && $request->travaux){
            $tagList = array_merge($request->id,$request->travaux);
        }else{
            $tagList = $request->id;
        }
        $selected_travaux = $request->travaux;

        $tag_product = $request->tag_product;
        $surface = $request->surface;
        $Nombre_de_split = $request->Nombre_de_split;
        $Type_de_comble = $request->Type_de_comble;
        $tag_product_nombre = $request->tag_product_nombre;
        $marque = $request->marque;
        $shab = $request->shab;
        $Nombre_de_pièces_dans_le_logement = $request->Nombre_de_pièces_dans_le_logement;
        $Type_de_radiateur = $request->Type_de_radiateur;
        $Nombre_de_radiateurs_électrique = $request->Nombre_de_radiateurs_électrique;
        $Nombre_de_radiateurs_combustible = $request->Nombre_de_radiateurs_combustible;
        $Nombre_de_radiateur_total_dans_le_logement = $request->Nombre_de_radiateur_total_dans_le_logement;
        $Thermostat_supplémentaire = $request->Thermostat_supplémentaire;
        $Nombre_thermostat_supplémentaire = $request->Nombre_thermostat_supplémentaire;


        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();

        $project = NewProject::find($request->project_id);
        $barame_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $bareme_data = view('admin.bareme__list', compact('barame_travaux_tags', 'selected_bareme'))->render();
        $travaux_data = view('admin.travaux__list', compact('barame_travaux_tags', 'selected_bareme', 'selected_travaux'))->render();
        $tag_data = view('admin.tag__list', compact('barame_travaux_tags', 'tagList'))->render();
        $product_data = view('admin.project_product__list', compact('barame_travaux_tags', 'tagList', 'project', 'tag_product', 'surface', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'marques', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement','Nombre_de_pièces_dans_le_logement'))->render();
        return response()->json(['travaux' => $travaux_data, 'tag'=> $tag_data, 'product' => $product_data, 'bareme' => $bareme_data]);
    }

    public function projectTravauxChange(Request $request){
        if($request->travaux && $request->id){
            $tagList = array_merge($request->id,$request->travaux);
        }else if($request->id){
            $tagList = $request->id;
        }else{
            $tagList = $request->travaux;
        }

        $tag_product = $request->tag_product;
        $surface = $request->surface;
        $Nombre_de_split = $request->Nombre_de_split;
        $Type_de_comble = $request->Type_de_comble;
        $tag_product_nombre = $request->tag_product_nombre;
        $marque = $request->marque;
        $shab = $request->shab;
        $Nombre_de_pièces_dans_le_logement = $request->Nombre_de_pièces_dans_le_logement;
        $Type_de_radiateur = $request->Type_de_radiateur;
        $Nombre_de_radiateurs_électrique = $request->Nombre_de_radiateurs_électrique;
        $Nombre_de_radiateurs_combustible = $request->Nombre_de_radiateurs_combustible;
        $Nombre_de_radiateur_total_dans_le_logement = $request->Nombre_de_radiateur_total_dans_le_logement;
        $Thermostat_supplémentaire = $request->Thermostat_supplémentaire;
        $Nombre_thermostat_supplémentaire = $request->Nombre_thermostat_supplémentaire;

        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
 
        $project = NewProject::find($request->project_id);
        $barame_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $tag_data = view('admin.tag__list', compact('barame_travaux_tags', 'tagList'))->render();
        $product_data = view('admin.project_product__list', compact('barame_travaux_tags', 'tagList', 'project', 'tag_product', 'surface', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'marques', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement', 'Nombre_de_pièces_dans_le_logement'))->render();
        return response()->json(['tag'=> $tag_data, 'product' => $product_data]);
    }

    public function projectBaremeValidate(Request $request){
        $project = NewProject::find($request->project_id);
        // dd($request->value);
        return response()->json(['maprime' =>MaPrimeRenovEstimatedAmount($project->Mode_de_chauffage, $project->precariousness, $request->value), 'cee' => CEEEstimatedAmount($project->Mode_de_chauffage, $project->precariousness, $request->value)]);
    }

    public function projectDocumentControlUpdate(Request $request){
        $project = NewProject::find($request->project_id);
        $project->update([
            'Pièces_manquante' => $request->Pièces_manquante,
            'Contrôles_des_pièces_observation' => $request->Contrôles_des_pièces_observation,
        ]);

        $input_key = [];
        $input_item = [];
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){
                $input_key[] = $key;
                $input_item[] = $item;
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $project->controle_des_custom_field_data = $json;
            $project->save();
        }


        foreach($request->document_id as $key => $value){
            $p_docuemnt = ProjectDocumentControl::where('project_id', $request->project_id)->where('document_id', $key)->first();
            if($value == 'yes'){
                if($p_docuemnt){
                    $p_docuemnt->update([
                        'Réceptionné_le' => $request->Réceptionné_le[$key],
                        'Réceptionné_par' => $request->Réceptionné_par[$key],
                    ]);
                }else{
                    ProjectDocumentControl::create([
                        'project_id' => $request->project_id,
                        'document_id' => $key,
                        'Réceptionné_le' => $request->Réceptionné_le[$key],
                        'Réceptionné_par' => $request->Réceptionné_par[$key],
                    ]);
                }
            }else{
                if($p_docuemnt){
                    $p_docuemnt->delete();
                }
            }
        }

        return response('success');
    }

    public function projectInterventionDelete(Request $request){
        $data = ProjectIntervention::find($request->id);
        if($data){
            $data->delete();
        }

        return back()->with('success', __("Deleted Succesfully"))->with('intervention_active', 1);
    }

    public function interventionTravauxChange(Request $request){
        $travaux_id = $request->travaux;
        $travaux_number = $request->travaux_number;
        $project_control_photos = ProjectControlPhoto::all();
        $view = view('admin.project_control', compact('travaux_id', 'travaux_number', 'project_control_photos'))->render();
        return response($view);
    }

    public function projectRapportFileUpload(Request $request){
        $request->validate([
            'file' => 'file|mimes:pdf,mp4'
        ], [
            'file.mimes' => 'Seules les vidéos pdf et mp4 sont acceptées'
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $extension = $file->extension();
            $orignalName = $file->getClientOriginalName();
            $fileName = $request->project_id.time().'.'.$extension;
            $file->move(public_path('uploads/files'), $fileName);

            ProjectFile::create([
                'project_id' => $request->project_id,
                'name' => $fileName,
                'file_name' => $orignalName,
                'file_type' => $extension,
                'user_id' => Auth::id(),
            ]);
        }
        return back()->with('success', 'Fichier téléchargé')->with('rapport_active', 1);
    }

    public function projectRapportFileDelete(Request $request){

        $file = ProjectFile::find($request->id);
        if($file){
            $file->delete();
        }
        return back()->with('success', __('Deleted Successfully'))->with('rapport_active', 1);
    }

    public function projectRapportFileNameEdit(Request $request){

        $file = ProjectFile::find($request->id);
        if($file){
            $file->update([
                'file_name' => $request->name
            ]);
        }
        return back()->with('success', __('Updated Successfully'))->with('rapport_active', 1);
    }

    public function projectInterventionPdf($id){
        // dd($id);
        $intervention = ProjectIntervention::find($id);
        $project = NewProject::find($intervention->project_id);
        $baremes = BaremeTravauxTag::orderBy('order')->get();
        $products = Product::latest()->get();
        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
        if($project){
            return view('admin.intervention_pdf', compact('intervention', 'project', 'baremes', 'products', 'marques'));
        }else{
            return back();
        }
        // $pdf = Pdf::loadView('admin.intervention_pdf');
        // return $pdf->download('invoice.pdf');
            // $pdf = App::make('dompdf.wrapper');
            //     $pdf->loadHTML('<h1>Test</h1>');
            //     return $pdf->stream();
    }

    public function projectFiscalInfoUpdate(Request $request){
        ProjectTax::find($request->tax_id)->update([
            'Existe_déclarant_number' => $request->value,
        ]);

        return response('Mise à jour réussie');
    }

    public function projectCustomField(Request $request){
        $inputs = ProjectCustomField::where('collapse_name', $request->collapse)->get();
        $view = view('admin.lead_custom_field_input_list', compact('inputs'))->render();
        return response($view);
    }
    public function projectCustomFieldStore(Request $request){
        ProjectCustomField::create([
            'collapse_name' => $request->collapse_name,
            'title' => $request->title,
            'name' => Str::snake($request->title, '_'),
            'input_type' => $request->input_type,
            'required' => 'no',
            'options' => $request->options,
        ]);
        return back()->with('success', __('Added Succesfully'))->with($request->callapse_active, '1');
    }
    public function projectCustomFieldDelete(Request $request){
        $field = ProjectCustomField::find($request->input_id);
        if($field){
            $field->delete();
        }
        return back()->with('success',  __('Delete Succesfully'))->with($request->callapse_active, '1');
    }

    public function projectFacturationCreate(Request $request){
        // dd($request->all());
        $request->validate([
            'project_id' => 'required',
            'type' => 'required',
        ]);
        $facturation = ProjectFacturation::create([
            'project_id' => $request->project_id,
            'type'       => $request->type
        ]);

        return back()->with('success', __('Added Succesfully'))->with('facturation_active', '1');
    }
    public function projectFacturationDelete(Request $request){
        if(!checkAction(Auth::id(), 'collapse_suivi_facturation', 'delete') && role() != 's_admin'){
            return back();
        } 
        $facturation = ProjectFacturation::find($request->id);
        if($facturation){
            $facturation->delete();
        }

        return back()->with('success', __('Deleted Succesfully'))->with('facturation_active', '1');
    }

    public function projectGestionCreate(Request $request){
        // dd($request->all());
        $request->validate([
            'project_id' => 'required',
            'type' => 'required',
        ]);
        if($request->type == 'Facture dépense'){
            $project = NewProject::find($request->project_id);
            if($project){
                ProjectGestion::create([
                    'project_id' => $request->project_id,
                    'type'       => 'Facture dépense '. ($project->getGestion()->where('status', 0)->count() + 1),
                    'status'     => 0
                ]);
            }
        }else{
            ProjectGestion::create([
                'project_id' => $request->project_id,
                'type'       => $request->type,
                'status'     => 1
            ]);
        }

        return back()->with('success', __('Added Succesfully'))->with('facturation_active', '1');
    }

    public function projectGestionUpdate(Request $request){
        // dd($request->all());
        $gestion = ProjectGestion::find($request->id);

        $gestion->update($request->except(['_token', 'id', 'project_id', 'products']));

        foreach($gestion->getChanges() as $key =>$value)
        {
             if($key != 'updated_at')
             {
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Facturation',
                    'block_name'    => 'Contrôle de gestion',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->project_id,
                    'feature_type'  => 'project',
                    'user_id'       => Auth::id(),
                ]);
                event(new PannelLog($pannel_activity->id));
             }
        }
        if($gestion->type == 'Facture Matériel'){
            $gestion->products()->sync($request->products);
        }

        $input_key = [];
        $input_item = [];
        if($request->custom_field_name){
            foreach($request->only($request->custom_field_name) as $key => $item){
                $data = explode('_', $key);
                if($data[0] == 'checkboxinput'){
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;
                }
            }
            $costom_field_data = array_combine($input_key, $input_item);
            $json = json_encode($costom_field_data);
            $gestion->custom_field_data = $json;
        }
        $gestion->save();


        return back()->with('success', __('Updated Succesfully'))->with('facturation_active', 1);
    }

    public function projectControlePdf($id){
        $controle_sur_site = ControleSurSite::find($id);
        $project = NewProject::find($controle_sur_site->project_id);
        $baremes = BaremeTravauxTag::orderBy('order')->get();
        if($project && ($controle_sur_site->type == 'COFRAC' || $controle_sur_site->type == 'MISE EN SERVICE')){
            return view('admin.controle_pdf', compact('controle_sur_site', 'project', 'baremes'));
        }else{
            return back();
        }
    }

    public function projectDocumentGeneratorChange(Request $request){
        $document = Document::find($request->document_id);
        $project = NewProject::find($request->project_id);
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
        $products = Product::latest()->get();
        if($document){
            $data = view('admin.documents.document_field', compact('document', 'project', 'bareme_travaux_tags', 'marques', 'products'))->render();
            return response($data);
        }else{
            return response('');
        }
    }


    public function projectTaxDeclarantUpdate(Request $request){
        $client_tax = ProjectTax::find($request->tax_id);
        if($client_tax){
            $client_tax->Nom_et_prénom_déclarant_1 = $request->Nom_et_prénom_déclarant_1;
            $client_tax->Date_de_naissance_déclarant_1 = $request->Date_de_naissance_déclarant_1;
            $client_tax->Nom_et_prénom_déclarant_2 = $request->Nom_et_prénom_déclarant_2;
            $client_tax->Date_de_naissance_déclarant_2 = $request->Date_de_naissance_déclarant_2;
            $client_tax->house_owner_status_déclarant_2 = $request->house_owner_status_déclarant_2 ? 'yes':'no';
            $client_tax->property_tax_status_déclarant_2 = $request->property_tax_status_déclarant_2 ? 'yes':'no';
            $client_tax->house_owner_status = $request->house_owner_status;
            $client_tax->property_tax_status = $request->property_tax_status;
            $client_tax->Existe_déclarant = $request->Existe_déclarant;
            $client_tax->Existe_déclarant_number = $request->Existe_déclarant_number;
            $client_tax->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('client_active', '1');
    }


    public function projectPreImport(Request $request){
        $original_file_name = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        if($extension == 'csv' || $extension == 'xlsx'){
            $heading = (new HeadingRowImport())->toArray($request->file('file'));  

            HeadingRowFormatter::default('none');

            $second_heading = (new HeadingRowImport(2))->toArray($request->file('file'));  

            $headings = $heading[0][0];
            $second_headings = $second_heading[0][0];
            foreach ($headings as $key => $heading){ 
                if($heading && (str_contains($heading, 'date') || str_contains($heading, 'Date'))){
                    try { 
                    $second_headings[$key] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($second_headings[$key]))->format('d/m/Y H:i');
                    } catch (Throwable $e) { 
                        $second_headings[$key] = $second_headings[$key];
                    }
                }
            } 
            $headers = ProjectImportHeader::all();
            $custom_fields = ProjectCustomField::all();
            $labels  = ProjectNewStatus::orderBy('order', 'asc')->get();
            $regies = Regie::all();
            // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
            $view = view('admin.project-csv-header', compact('headings', 'headers', 'custom_fields', 'labels', 'regies', 'original_file_name', 'second_headings'))->render();
            return response()->json(['data' => $view]);
        }else{
            return response()->json(['error' => 'Veuillez entrer un fichier csv ou xlsx valide.']);
        }
    }
    public function projectPreImportManual(Request $request){
        $original_file_name = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        if($extension == 'csv' || $extension == 'xlsx'){
            $heading = (new HeadingRowImport())->toArray($request->file('file'));  

            HeadingRowFormatter::default('none');

            $second_heading = (new HeadingRowImport(2))->toArray($request->file('file'));  

            $headings = $heading[0][0];
            $second_headings = $second_heading[0][0];
            foreach ($headings as $key => $heading){ 
                if($heading && (str_contains($heading, 'date') || str_contains($heading, 'Date'))){
                    try { 
                    $second_headings[$key] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($second_headings[$key]))->format('d/m/Y H:i');
                    } catch (Throwable $e) { 
                        $second_headings[$key] = $second_headings[$key];
                    }
                }
            }  
            $labels  = ProjectNewStatus::orderBy('order', 'asc')->get(); 
            // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
            $view = view('admin.project-csv-header-manual', compact('headings', 'labels', 'original_file_name', 'second_headings'))->render();
            return response()->json(['data' => $view]);
        }else{
            return response()->json(['error' => 'Veuillez entrer un fichier csv ou xlsx valide.']);
        }
    }

    public function projectsImportManual(Request $request){
        $request->validate([
            'file' => 'required|file',
        ]); 
        $data = $request->except('_token', 'file', 'selected_label'); 
         
        // dd($intervention_data);
        $label = $request->selected_label;   
        Excel::import(new ProjectImportManual($data, $label), request()->file('file'));
        return back()->withSuccess('Chantier Importé');
    }

    public function projectsImport(Request $request){
        $request->validate([
            'file' => 'required|file',
        ]);
        $data = $request->except('_token', 'file', 'lead_tracking_custom__field', 'personal_information_custom__field', 'eligibility_custom__field', 'information_logement_custom__field', 'situation_foyer_custom__field', 'project_custom__field', 'selected_label','intervention___previsite', 'intervention___installation', 'intervention___etude', 'selected__telecommercial', 'selected_sub_status', 'import__subvention', 'import__banque', 'import__demande', 'import__audit', 'import__cee', 'import__MaPrimeRénov', 'intervention___installation2', 'import__client', 'import__banque_facturation', 'import__action_logement'); 



        $custom_field_column = [];
        $intervention_data = [];
        $custom_field_column['lead_tracking_custom__field'] = $request->lead_tracking_custom__field;
        $custom_field_column['personal_information_custom__field'] = $request->personal_information_custom__field;
        $custom_field_column['eligibility_custom__field'] = $request->eligibility_custom__field;
        $custom_field_column['information_logement_custom__field'] = $request->information_logement_custom__field;
        $custom_field_column['situation_foyer_custom__field'] = $request->situation_foyer_custom__field;
        $custom_field_column['project_custom__field'] = $request->project_custom__field;
        $intervention_data['intervention___previsite'] = $request->intervention___previsite; 
        $intervention_data['intervention___installation'] = $request->intervention___installation; 
        $intervention_data['intervention___etude'] = $request->intervention___etude; 
        $intervention_data['import__subvention'] = $request->import__subvention; 
        $intervention_data['import__banque'] = $request->import__banque; 
        $intervention_data['import__demande'] = $request->import__demande; 
        $intervention_data['import__audit'] = $request->import__audit; 
        $intervention_data['import__cee'] = $request->import__cee; 
        $intervention_data['import__MaPrimeRénov'] = $request->import__MaPrimeRénov; 
        $intervention_data['intervention___installation2'] = $request->intervention___installation2; 
        $intervention_data['import__client'] = $request->import__client; 
        $intervention_data['import__banque_facturation'] = $request->import__banque_facturation; 
        $intervention_data['import__action_logement'] = $request->import__action_logement; 
        // dd($intervention_data);
        $label = $request->selected_label;
        $telecommercial = $request->selected__telecommercial;
        $sub_status = $request->selected_sub_status;
        Excel::import(new ProjectImport($data, $custom_field_column, $label, $intervention_data, $telecommercial, $sub_status), request()->file('file'));
        return back()->withSuccess('Chantier Importé');
    }

    public function projectImportRegieChange(Request $request){
        $users = User::where('regie_id', $request->regie_id)->where('deleted_status', 'no')->where('status', 'active')->get();
        $telecommercials = '<div class="form-group text-left mt-3" id="importRegieTelecommercial">
        <label class="form-label" for="">Télécommercial <span class="text-danger">*</span></label>
        <select name="selected__telecommercial" class="select2_select_option custom-select shadow-none form-control" required> <option value="" selected>Sélectionnez</option>';

        foreach($users as $user){
            $telecommercials .="<option value='$user->id'>$user->name</option>";
        }

        $telecommercials .= '</select></div>';
        return response($telecommercials);
    }


    public function projectDefaultModalRender(Request $request){

        $headers = ProjectHeader::all();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $filter_status = ProjectHeaderFilter::where('user_id', Auth::id())->orderBy('project_header_id', 'asc')->get();
        $default_filters = ProjectDefaultHeaderFilter::all();
        if(in_array(role(), $administrarif_role)){
            $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        }else{ 
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie;
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else{
                $telecommercials = []; 
            }
        } 
        
        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        $view = view('admin.project_default_modal', compact('suvbention_gestionnaires', 'telecommercials', 'headers', 'filter_status', 'default_filters', 'permission_regies'))->render();
        return response($view); 
    }

    public function projectModalRender(Request $request){
        $project = NewProject::find($request->id); 
        $projectStatus = ProjectNewStatus::find($request->status);
        // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
        $project_sub_status = $projectStatus->getSubStatus;
        if($request->type == 'sub_status'){
            $view = view('admin.project_sub_status_change_modal', compact('project', 'project_sub_status'))->render();
        }else if($request->type == 'status'){
            $view = view('admin.project_status_change_modal', compact('project', 'project_sub_status'))->render();
        }else{
            $view = '';
        }
        return response($view);
    }

    public function projectBulkDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $project_id = explode(',', $request->project_id); 
        foreach($project_id as $id){  
            $project = NewProject::find($id);
            if($project){
                $project->update([
                    'deleted_status'    => 1,
                ]);
            }
            Notifications::where('project_id', $id)->get()->each->delete();         
        } 
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    public function projectStatusChangeList(Request $request){
        $status = $request->status;
        $project_status = ProjectNewStatus::find($status); 
        $project_sub_status = $project_status->getSubStatus;        
        $view = view('admin.project_sub_status', compact('project_sub_status'))->render();
        return response($view);
    }

    public function projectSingleDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        } 
        $project = NewProject::find($request->id);
        if($project){
            $project->update([
                'deleted_status'    => 1,
            ]);
            Notifications::where('project_id', $request->id)->get()->each->delete(); 
        }

        if($request->similar_status){
            return back()->with('success', __('Deleted Successfully'));
        }else{
            return redirect()->route('project.index')->with('success', __('Deleted Successfully'));
        }
    }

    public function projectSimilarCheck(Request $request){
        if(!checkAction(Auth::id(), 'project', 'similar-chantier') && role() != 's_admin'){
            return back();
        } 
        $field = $request->type;
        $projects = NewProject::select($field, DB::raw('COUNT(*) as `count`'))
            ->groupBy($field)
            ->where('deleted_status', 0)
            ->having('count', '>', 1)
            ->get()->pluck($field)->toArray();
        
        $similar_projects = NewProject::whereIn($field, $projects)->where('deleted_status', 0)->orderBy($field)->get();

        $view = view('admin.project-similar-field', compact('similar_projects', 'field'))->render();
        $delete_modal = view('admin.similar-project-delete-modal', compact('similar_projects'))->render();
        return response()->json(['view' => $view, 'delete_modal' => $delete_modal]);
    }

    public function similarProjectBulkDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $checked_project_id = explode(',', $request->similar_project_bulk_id); 
        foreach($checked_project_id as $project_id){
            $project = NewProject::find($project_id);
            if($project){
                $project->update([
                    'deleted_status'    => 1,
                ]);
                Notifications::where('project_id', $project_id)->get()->each->delete(); 
            }
        }

        return back()->with('success', __("Deleted Successfully"));
    }

    public function projectPixelCreate(Request $request){
        if(!checkAction(Auth::id(), 'project', 'pixel-create') && role() != 's_admin'){
            return back()->with('error', 'Pas autorisé');
        } 
        $project = NewProject::find($request->id);
        if(!$project){
            return back();
        }

        if($project->projectSecondTable && $project->projectSecondTable->pixel_status){
            return back()->with('error', 'Importation sur pixel déjà réalisé');
        }
        
        if(!$project->primaryTax){
            return back()->with('error', 'No avis fiscale');
        }
        try{

            if($project->primaryTax->Existe_déclarant == 'Oui'){    
                $Civilite2 = $project->primaryTax->second_title;  
                if($project->primaryTax->second_title == 'Mr'){
                    $Civilite2 = 'M.';
                }
                $Nom2 = $project->primaryTax->second_last_name;   
                $Prenom2 = $project->primaryTax->second_first_name;   
            }else{
                $Civilite2 = null;  
                $Nom2 = null;   
                $Prenom2 = null;   
            }
    
            $Civilite1 = $project->Titre;  
            if($project->Titre == 'Mr'){
                $Civilite1 = 'M.';
            }
            if(!$project->Nom){
                return back()->with('error', 'Un nom est requis');
            }
            $Nom1 = $project->Nom;   

            if(!$project->Prenom){
                return back()->with('error', 'Un prénom est requis');
            }
            $Prenom1 = $project->Prenom;      

            $Mail = $project->Email;   
            if(!$project->Adresse){
                return back()->with('error', "L'adresse est requise");
            }
            $Adresse = $project->Adresse;    
            if(!$project->Code_Postal){
                return back()->with('error', 'Le code postal est requise');
            }
            $CodePostal = $project->Code_Postal;     
            if(!$project->Ville){
                return back()->with('error', 'La ville est requise');
            }
            $Ville = $project->Ville;   
            $TelMobile = $project->phone;  
    
            $AgeBatiment = null;
            if($project->Age_du_bâtiment =='Oui' || $project->Age_du_bâtiment =='Plus de 15 ans'){
                $AgeBatiment = 3;
            }elseif($project->Age_du_bâtiment =='Non' || $project->Age_du_bâtiment =='plus de 2 ans et moins de 15 ans'){
                $AgeBatiment = 2;
            }elseif($project->Age_du_bâtiment =='Moins de 2 ans'){
                $AgeBatiment = 1;
            }
            
            $TypeHabitation = null;
            if($project->Type_habitation =='Propriétaire occupant'){
                $TypeHabitation = 1;
            }elseif($project->Type_habitation =='Locataire'){
                $TypeHabitation = 2;
            }elseif($project->Type_habitation =='Propriétaire bailleur'){
                $TypeHabitation = 3;
            }

            if(!$TypeHabitation){
                return back()->with('error', "Le type d'habitation est requis");
            }
            
            $TypeChauffage = null;
            if($project->Type_de_chauffage =='Combustible'){
                $TypeChauffage = 1;
            }elseif($project->Type_de_chauffage =='Electrique'){
                $TypeChauffage = 2;
            }
            if(!$TypeChauffage){
                return back()->with('error', "Le type de chauffage est requis");
            }
            if($project->ProjectBareme->count() == 0){
                return back()->with('error', "Barème est requis");
            }
    
            $TypeOperationCEE = null;
            if($project->ProjectBareme->where('id',  7)->first()){
                $TypeOperationCEE = 4;
            }elseif($project->ProjectBareme->whereIn('id',  [11,12,13,14])->first()){
                $TypeOperationCEE = 1;
            }elseif($project->ProjectBareme->count() > 0){
                $TypeOperationCEE = 2;
            }
    
            if(!$project->Type_de_logement){
                return back()->with('error', "Le type de logement est requis");
            }
            $TypeLogement = null;
            if($project->Type_de_logement =='Maison individuelle'){
                $TypeLogement = 0;
            }elseif($project->Type_de_logement =='Appartement'){
                $TypeLogement = 1;
            }
    
            
            $taxs = ProjectTax::where('project_id', $request->id)->orderBy('primary', 'asc')->get();        
    
            $NbrFoyer = $project->Nombre_de_foyer ?? $taxs->count();
    
            $NbrPersonneAuFoyer = $taxs->sum('family_person');
            $RevenuFiscal = $taxs->sum('pays'); 
    
            $NumFiscal1 = $project->primaryTax->tax_number;
            $RefFiscal1 = $project->primaryTax->tax_reference;
            $NumFiscal2 = null;
            $RefFiscal2 = null;
    
    
            if($taxs->count() > 1){
                foreach ($taxs as $key => $tax){
                    if($key == 1){
                        $NumFiscal2 = $tax->tax_number;
                        $RefFiscal2 = $tax->tax_reference;
                    }
                }
            } 
    
            $unique_id = 'Test00'.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
            // return $unique_id;
            $client = new GuzzleHttpClient();
            $headers = [
                'Content-Type' => 'application/json',
                'XINTNRGLEAD-TOKEN' => '5c6ecc04-8eec-4dd3-b5a1-10281e4193f8',
              ];
    
            $body = '{
                "TypeOperationCEE" : '.$TypeOperationCEE.',
                "Civilite1": "'.$Civilite1.'",
                "Nom1": "'.$Nom1.'",
                "Prenom1": "'.$Prenom1.'",
                "Civilite2": "'.$Civilite2.'",
                "Nom2": "'.$Nom2.'",
                "Prenom2": "'.$Prenom2.'",
                "Mail": "'.$Mail.'",
                "Adresse": "'.$Adresse.'",
                "CodePostal": "'.$CodePostal.'",
                "Ville": "'.$Ville.'",
                "TelMobile": "'.$TelMobile.'",
                "AgeBatiment": '.$AgeBatiment.',
                "TypeHabitation": '.$TypeHabitation.',
                "TypeChauffage": '.$TypeChauffage.',
                "NbrPersonneAuFoyer": '.$NbrPersonneAuFoyer.',
                "NbrFoyer": '.$NbrFoyer.',
                "RevenuFiscal": '.$RevenuFiscal.',
                "NumFiscal1": "'.$NumFiscal1.'", 
                "RefFiscal1": "'.$RefFiscal1.'", 
                "NumFiscal2": "'.$NumFiscal2.'", 
                "RefFiscal2": "'.$RefFiscal2.'", 
                "TypeLogement": '.$TypeLogement.',
                "PixelDealId": "0eac04e6-6eee-4b33-c421-08da3c9a0ce5",
                "DealId":"'.$unique_id.'",
                "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
                }
            ';
    
              $request = $client->post('https://crm.pixel-crm.com/api/IJLeads', [
                'headers' => $headers,
                'body' => $body
            ]);

            // Deal id was changed at 09-05-2024 old one is "PixelDealId": "ef11a77b-d6ab-487b-8c67-6311c35fef58",
    
            // return $request->getBody()->getContents();
            $response = json_decode($request->getBody()->getContents(), true);
            if($response['statut'] == '200 : Lead created successfully'){
                if($project->projectSecondTable){
                    $project->projectSecondTable->update([
                        'pixel_status' => $response['statut'],
                        'ficheid' => $response['ficheid'],
                    ]);
                }else{
                    NewProject2::create([
                        'project_id' => $project->id,
                        'pixel_status' => $response['statut'],
                        'ficheid' => $response['ficheid'],
                    ]);
                }

                return back()->with('success', 'Importation Pixel réussie');

            }
            return back()->with('error', 'Quelque chose n’a pas fonctionné');
        }catch(Exception $e){
            return back()->with('error', 'Quelque chose n’a pas fonctionné');
        }
    }

    // END
}
