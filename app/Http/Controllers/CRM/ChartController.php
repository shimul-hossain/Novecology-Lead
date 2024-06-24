<?php

namespace App\Http\Controllers\CRM;

use App\Models\User;
use App\Models\CRM\Lead;
use App\Models\CRM\Client;
use App\Models\CRM\Company;
use App\Models\CRM\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CRM\CompanyFilter;
use App\Http\Controllers\Controller;
use App\Models\CRM\CallbackHistory;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\ClientTax;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\LeadTax;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\NewTask;
use App\Models\CRM\Notion;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectSubStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\CRM\ProjectTableStatus;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\Regie;
use App\Models\CRM\Role;
use Carbon\CarbonInterval;

class ChartController extends Controller
{
    public function __construct() {

        ini_set('memory_limit', '1G');
   
   }
    public static function getCompany()
    {
        $filter_company = CompanyFilter::where('user_id', Auth::id())->first();
        if ($filter_company) {
            return $filter_company->company_id;
        } else {
            return false;
        }
    }

    public function newDashboard()
    { 
        $stats_regies = []; 
        $min_30_interval = []; 
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00');  
        $projectList = NewProject::where('deleted_status', 0)->with('projectStatus')->orderBy('created_at')->take(10)->get();


        $projects = [];
        $clients =  [];
        $leads = [];
        $leadsWithConvert = [];
        $days = [];
        $lastThreeMonth = [];
        $lastThreeMonthlead = []; 
        $leadList = []; 
        $lead_percentage = 0;
        $lastThreeMonthleadCount = 0;
        $projectCount = 0;
        $leadCount = 0;
        $clientCount = 0;
        $leadsWithConvertCount = 0;
        $login_user_role = Auth::user()->role;
        
        foreach($schedules30 as $d){
            $min_30_interval[ Carbon::parse($d)->format("G:i:00")] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }
        
        Auth::user()->getTasks()->where('status', 'Terminé')->where('updated_at', '<', Carbon::now()->subDay())->get()->each->delete();
        
        if($login_user_role == 's_admin' || $login_user_role == 'manager_direction'){
            $lead_rapplers = LeadClientProject::where('lead_deleted_status', 0)->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->with('callbackUser')->get();

            for ($i = 0; $i <= 29; $i++) {
                // $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $leadsWithConvert[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            }
            // $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->with('getStatus')->get();
            for ($i = 2; $i >= 0; $i--) {
                $lastThreeMonth[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                // $lastThreeMonthlead[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now()->subMonths($i))->count();
            }

            // $projectCount = array_sum($projects);
            // $leadCount = array_sum($leads);
            // $clientCount = array_sum($clients);
            // $leadsWithConvertCount = array_sum($leadsWithConvert);
            // if ($leadsWithConvertCount != 0) {
            //     $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
            // }
            // $lastThreeMonthleadCount = array_sum($lastThreeMonthlead);
            
        }else{
            $lead_rapplers = LeadClientProject::where('lead_deleted_status', 0)->where('callback_user_id', Auth::id())->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->with('callbackUser')->get();
        }


        $user_stats_regies = Auth::user()->allRegie; 
        $user_ids = User::whereIn('regie_id', $user_stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $project_items = [];
        $lead_items = [];
        // if(in_array(role(), $administrarif_role)){ 
        //     $project_items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
        //     $lead_items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get(); 
        // }else{  
        //     if(role() == 'sales_manager' || role() == 'sales_manager_externe'){ 
        //         $project_items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
        //         $telecommercials = User::whereIn('regie_id', $user_stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        //         $lead_items = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get(); 

        //     }else{
        //         $lead_items = Auth::user()->getLeads()->orderBy('Code_Postal', 'asc')->get(); 
        //         if(role() == 'team_leader'){
        //             $team_users = Auth::user()->getTeamUsers;
        //             $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
        //             $project_items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();                
        //         }else{  
        //             if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
        //                 $project_items = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
        //             }else{
        //                 $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
        //                 $project_items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
        //             } 
        //         }
        //     } 

        // }

        // dd('asi ki');
        return view('admin.new_dashboard', compact('min_30_interval', 'lead_rapplers', 'projectList', 'projects', 'clients', 'leads', 'leadsWithConvert', 'days', 'lastThreeMonth', 'lastThreeMonthlead', 'lead_percentage', 'lastThreeMonthleadCount', 'projectCount', 'leadCount', 'clientCount', 'leadsWithConvertCount', 'leadList', 'project_items', 'lead_items', 'login_user_role'));
    }
    public function topbarStats(){ 
        $totalClients = [];
        $totalLeads = [];
        $totalProjects = [];  
        $roles = Role::where('status', 'active')->with('getUsers')->get();
        $lead_statuses = LeadStatus::all(); 
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();   
   
        if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){ 
            $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->count(); 
            $totalLeads = LeadClientProject::where('lead_deleted_status', 0)->get(); 
            $totalClients = NewClient::where('deleted_status', 0)->get();
            $totalProjects = NewProject::where('deleted_status', 0)->get();  
            
        }else{ 
            $totalUsers = 0; 
            if(Auth::user()->role == 'telecommercial' || Auth::user()->role == 'telecommercial_externe' || Auth::user()->role == 'study_manager'){
                $totalLeads = Auth::user()->getLeads;
                $totalClients = Auth::user()->getClients;
                $totalProjects = Auth::user()->getTelecommiercialProjects;    
            }else if(Auth::user()->role == 'sales_manager' || Auth::user()->role == 'sales_manager_externe'){ 
                $stats_regies = Auth::user()->allRegie;  
                $regie_leads = LeadClientProject::whereIn('import_regie', $stats_regies->pluck('id'))->where('lead_label', 1)->where('lead_deleted_status', 0)->get();
                $stats_telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->get(); 
                $telecommercial_leads = LeadClientProject::whereIn('lead_telecommercial', $stats_telecommercials->pluck('id'))->where('lead_deleted_status', 0)->get();
                $totalLeads = $telecommercial_leads->merge($regie_leads);
                $totalClients = NewClient::whereIn('lead_telecommercial', $stats_telecommercials->pluck('id'))->where('deleted_status', 0)->get(); 
                $totalProjects = NewProject::whereIn('project_telecommercial', $stats_telecommercials->pluck('id'))->where('deleted_status', 0)->get(); 
            }else{
                if(Auth::user()->role == 'Gestionnaire'){
                    $totalProjects = Auth::user()->getProjects;     
                }
                if(Auth::user()->role == 'manager'){
                    $totalProjects = NewProject::whereNotNull('project_gestionnaire')->where('deleted_status', 0)->get();  
                }  
            }
        }

        $view = view("admin.analytic_stats", compact('totalUsers', 'totalProjects', 'totalClients','totalLeads', 'roles', 'lead_statuses', 'project_statuses'))->render();

        return response($view);
    }
    public function dashboardAnalytic()
    {
        $company = Company::latest()->get();
        if ($this->getCompany()) {
            $projects = [];
            $clients =  [];
            $leads = [];
            $leadsWithConvert = [];
            $days = [];
            $daysNumber = [];
            $lastThreeMonth = [];
            $lastThreeMonthlead = [];
            for ($i = 0; $i <= 29; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $leadsWithConvert[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
                $daysNumber[] = Carbon::now()->subDays($i)->format('d');
            }
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->get();
            for ($i = 2; $i >= 0; $i--) {
                $lastThreeMonth[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                $lastThreeMonthlead[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now()->subMonths($i))->count();
            }
            $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->get();
            $totalProjects = NewProject::where('deleted_status', 0)->get();
            $totalClients = NewClient::where('deleted_status', 0)->get();
            $totalLeads = LeadClientProject::where('lead_deleted_status', 0)->get();
            $projectList = NewProject::where('deleted_status', 0)->orderBy('created_at')->take(10)->get();
            $projectCount = array_sum($projects);
            $leadCount = array_sum($leads);
            $clientCount = array_sum($clients);
            $leadsWithConvertCount = array_sum($leadsWithConvert);
            $lead_percentage = 0;
            if ($leadsWithConvertCount != 0) {
                $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
            }
            $lastThreeMonthleadCount = array_sum($lastThreeMonthlead);

            if(role() == 's_admin'){
                $notions = Notion::all();
            }else{
                $notions = Auth::user()->notion;
            }

            $lead_rapplers = LeadClientProject::where('lead_deleted_status', 0)->where('callback_history_type', 0)->where('callback_time', '<', Carbon::now()->addHour())->get();

            $roles = Role::where('status', 'active')->get();
            $lead_statuses = LeadStatus::all();
            $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
            $suppliers = Fournisseur::where('active', 'Oui')->get();
            $new_lead_count = LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 2)->count();
            
            return view('admin.dashboard-updated', compact('totalUsers', 'totalProjects', 'totalClients', 'projects', 'company', 'clients', 'totalLeads', 'leads', 'projectList', 'projectCount', 'clientCount', 'leadCount', 'days', 'daysNumber', 'leadList', 'lastThreeMonth', 'lastThreeMonthlead', 'lastThreeMonthleadCount', 'leadsWithConvert', 'lead_percentage', 'notions', 'lead_rapplers', 'roles', 'lead_statuses','project_statuses', 'suppliers', 'new_lead_count'));
        } else {
            return view('admin.static-dashboard', compact('company'));
        }
    }

    public function dashboardAnalyticUpdated()
    {
        $company = Company::latest()->get();
        if ($this->getCompany()) {
            $projects = [];
            $clients =  [];
            $leads = [];
            $leadsWithConvert = [];
            $days = [];
            $daysNumber = [];
            $lastThreeMonth = [];
            $lastThreeMonthlead = [];
            for ($i = 29; $i >= 0; $i--) {
                $projects[] = Project::where('deleted_status', 'no')->where('company_id', $this->getCompany())->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $projects[] = $i % 2 == 0 ? $i * rand(10,50) : $i * rand(10,50);
                $clients[] = Client::where('deleted_status', 'no')->where('company_id', $this->getCompany())->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $clients[] = $i % 2 == 0 ? $i * rand(10,50) : $i * rand(10,50);
                $leads[] = Lead::where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->where('company_id', $this->getCompany())->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $leads[] = $i % 2 == 0 ? $i * rand(10,50) : $i * rand(10,50);
                $leadsWithConvert[] = Lead::where('deleted_status', 'no')->where('data_status', 'yes')->where('company_id', $this->getCompany())->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                // $leadsWithConvert[] = $i % 2 == 0 ? $i * rand(10,50) : $i * rand(10,50);
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
                $daysNumber[] = Carbon::now()->subDays($i)->format('d');
            }
            // dd($days);
            $leadList = Lead::where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->where('company_id', $this->getCompany())->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->get();
            for ($i = 3; $i >= 1; $i--) {
                $lastThreeMonth[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                $lastThreeMonthlead[] = Lead::where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->where('company_id', $this->getCompany())->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now()->subMonths($i))->count();
                // $lastThreeMonthlead[] = $i * rand(10,800);
            }
            $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->get();
            $totalProjects = Project::where('deleted_status', 'no')->where('company_id', $this->getCompany())->get();
            $totalClients = Client::where('deleted_status', 'no')->where('company_id', $this->getCompany())->get();
            $totalLeads = Lead::where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->where('company_id', $this->getCompany())->get();
            $projectList = Project::where('deleted_status', 'no')->where('company_id', $this->getCompany())->take(10)->get();
            $projectCount = array_sum($projects);
            $leadCount = array_sum($leads);
            $clientCount = array_sum($clients);
            $leadsWithConvertCount = array_sum($leadsWithConvert);
            $lead_percentage = 0;
            if ($leadsWithConvertCount != 0) {
                $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
            }
            $lastThreeMonthleadCount = array_sum($lastThreeMonthlead);

            if(role() == 's_admin'){
                $notions = Notion::all();
            }else{
                $notions = Auth::user()->notion;
            }

            return view('admin.dashboard', compact('totalUsers', 'totalProjects', 'totalClients', 'projects', 'company', 'clients', 'totalLeads', 'leads', 'projectList', 'projectCount', 'clientCount', 'leadCount', 'days', 'daysNumber', 'leadList', 'lastThreeMonth', 'lastThreeMonthlead', 'lastThreeMonthleadCount', 'leadsWithConvert', 'lead_percentage', 'notions'));
        } else {
            return view('admin.static-dashboard', compact('company'));
        }
    }

    public function chartProjectFilter(Request $request)
    {
        $projects = [];
        if ($request->value == '7') {
            for ($i = 0; $i <= 6; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'this') {
            for ($i = 0; $i <= 29; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'last') {
            for ($i = 1; $i < Carbon::now()->subMonth()->daysInMonth; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
            }
        }

        $projectCount = array_sum($projects);
        return response()->json(['data' => $projects, 'count' => $projectCount]);
    }
    public function chartClientFilter(Request $request)
    {

        $clients = [];
        if ($request->value == '7') {
            for ($i = 0; $i <= 6; $i++) {
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'this') {
            for ($i = 0; $i <= 29; $i++) {
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'last') {
            for ($i = 1; $i < Carbon::now()->subMonth()->daysInMonth; $i++) {
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
            }
        }
        $clientCount = array_sum($clients);
        return response()->json(['data' => $clients, 'count' => $clientCount]);
    }
    public function chartLeadFilter(Request $request)
    {

        $leads = [];
        if ($request->value == '7') {
            for ($i = 0; $i <= 6; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'this') {
            for ($i = 0; $i <= 29; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            }
        } elseif ($request->value == 'last') {
            for ($i = 1; $i < Carbon::now()->subMonth()->daysInMonth; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
            }
        }
        $leadCount = array_sum($leads);
        return response()->json(['data' => $leads, 'count' => $leadCount]);
    }
    public function leadClientFilter(Request $request)
    {
        $leads = [];
        $clients = [];
        $label = [];
        if ($request->value == '7') {
            for ($i = 0; $i <= 6; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('l');
            }
        } elseif ($request->value == 'this') {
            for ($i = 0; $i <= 29; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            }
        } elseif ($request->value == 'last') {
            for ($i = 1; $i < Carbon::now()->subMonth()->daysInMonth; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                $label[] = $i . '-' . Carbon::now()->subMonth()->locale(app()->getLocale())->translatedFormat('M');
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                $label[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
            }
        }

        $clientCount = array_sum($clients);
        $leadsWithConvertCount = array_sum($leads);
        $lead_percentage = 0;
        if ($leadsWithConvertCount != 0) {
            $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
        }
        return response()->json(['lead' => $leads, 'client' => $clients, 'label' => $label, 'percentage' => $lead_percentage]);
    }

    public function compnayFilter(Request $request)
    {
        CompanyFilter::create([
            'user_id' => Auth::id(),
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('dashboard.analytic');
    }

    public function filterByCompany($id)
    {
        $filter_company = CompanyFilter::where('user_id', Auth::id())->first();

        $filter_company->update([
            'company_id' => $id,
        ]);

        return redirect()->route('dashboard.analytic');
    }

    public function leadFilterList(Request $request)
    {
        if ($request->value == '7days') {
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->get();
        } elseif ($request->value == 'today') {
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereDay('created_at', Carbon::now())->get();
        } elseif ($request->value == 'yesterday') {
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereDay('created_at', Carbon::now()->subDay())->get();
        } else {
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->get();
        }

        $view = view('admin.lead_list', compact('leadList'))->render();

        return response($view);
    }

    public function dashboardFilter(Request $request)
    {
        $from = $request->from;
        if ($request->to) {
            $to = $request->to;
        } else {
            $to = Carbon::now()->format('Y-m-d');
        }

        $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->whereBetween('created_at', [$from, $to])->count();
        $totalProjects = NewProject::where('deleted_status', 0)->whereBetween('created_at', [$from, $to])->get();
        $totalClients = NewClient::where('deleted_status', 0)->whereBetween('created_at', [$from, $to])->get();
        $totalLeads = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [$from, $to])->get();
        $roles = Role::where('status', 'active')->get();
        $lead_statuses = LeadStatus::all();
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
        $view = view("admin.analytic_stats", compact('totalUsers', 'totalProjects', 'totalClients','totalLeads', 'roles', 'lead_statuses', 'project_statuses'))->render();

        return response($view);
    }

    public function dashboardFilterClear(Request $request)
    {
        $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $totalProjects = NewProject::where('deleted_status', 0)->get();
        $totalClients = NewClient::where('deleted_status', 0)->get();
        $totalLeads = LeadClientProject::where('lead_deleted_status', 0)->get();
        $roles = Role::where('status', 'active')->get();
        $lead_statuses = LeadStatus::all();
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();

        $view = view("admin.analytic_stats", compact('totalUsers', 'totalProjects', 'totalClients','totalLeads', 'roles', 'lead_statuses', 'project_statuses'))->render();

        return response($view);
    }

    public function rapplerFilterList(Request $request){
        if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){
            if($request->value == 'lead'){
                $rapplers = LeadClientProject::where('lead_deleted_status', 0)->where('callback_history_type', 0)->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'lead';
            }else if($request->value == 'client'){
                $rapplers = NewClient::where('deleted_status', 0)->where('callback_history_type', 0)->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'client';
            }else{
                $rapplers = NewProject::where('deleted_status', 0)->where('callback_history_type', 0)->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'project';
            }
        }else{
            if($request->value == 'lead'){
                $rapplers = LeadClientProject::where('lead_deleted_status', 0)->where('callback_history_type', 0)->where('callback_user_id', Auth::id())->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'lead';
            }else if($request->value == 'client'){
                $rapplers = NewClient::where('deleted_status', 0)->where('callback_history_type', 0)->where('callback_user_id', Auth::id())->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'client';
            }else{
                $rapplers = NewProject::where('deleted_status', 0)->where('callback_history_type', 0)->where('callback_user_id', Auth::id())->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->get();
                $feature_type = 'project';
            }
        }

        $veiw = view('admin.rappler_list', compact('rapplers', 'feature_type'))->render();
        $modal = view('admin.rappler_list_modal', compact('rapplers', 'feature_type'))->render();
        return response()->json(['data' => $veiw, 'modal' => $modal]);
    }

    public function rapplerTypeChange(Request $request){
        CallbackHistory::create([
            'type' => $request->type,
            'feature_id' => $request->feature_id,
            'expired_date' => $request->expired_date,
            'callback_user_id' => $request->callback_user_id,
            'user_id' => Auth::id(),
            'status' => $request->status,
        ]);

        if($request->type == 'lead'){
            $lead = LeadClientProject::find($request->feature_id);
            $lead->callback_history_type = 1;
            $lead->save();
        }

        return back()->with('success', "Historique des rappels ajouté");
    }


    public function dashboardStatsTypeChange(Request $request){

        if($request->value == 'Fournisseur de lead'){    
            $fournisseur_de_leads = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
            $lead_view = view('admin.lead_stats_table', compact('fournisseur_de_leads'))->render();
            $chantier_view = view('admin.chantier_stats_table', compact('fournisseur_de_leads'))->render();
        }else if($request->value == 'Type de campagne'){
            $type_de_campagnes = Campagnetype::all();
            $lead_view = view('admin.lead_stats_campaign_type_table', compact('type_de_campagnes'))->render();
            $chantier_view = view('admin.chantier_stats_campaign_type_table', compact('type_de_campagnes'))->render();
        }else{
            // return false;
            $lead_nom_campagnes = LeadClientProject::where('lead_deleted_status', 0)->whereNotNull('__tracking__Nom_campagne')->pluck('__tracking__Nom_campagne')->toArray();
            $project_nom_campagnes = NewProject::where('deleted_status', 0)->whereNotNull('__tracking__Nom_campagne')->pluck('__tracking__Nom_campagne')->toArray();
            
            $lead_nom_campagnes = array_unique($lead_nom_campagnes);
            $project_nom_campagnes = array_unique($project_nom_campagnes);

            $projects = NewProject::where('deleted_status', 0)->whereNotNull('__tracking__Nom_campagne')->get();
            $leads = LeadClientProject::where('lead_deleted_status', 0)->whereNotNull('__tracking__Nom_campagne')->get();
            $lead_view = view('admin.lead_stats_campaign_name_table', compact('lead_nom_campagnes', 'leads'))->render();
            $chantier_view = view('admin.chantier_stats_campaign_name_table', compact('project_nom_campagnes', 'projects'))->render(); 

        }
        return response()->json(['lead_stats' => $lead_view, 'chantier_stats' => $chantier_view]);
    }

    public function chartTabStats(Request $request){
        $data = $request->value;
        $totalClients = [];
        $totalLeads = []; 
        $stats_telecommercials = [];
        $stats_gestionnaires = [];
        $stats_regies = [];
        if($data == 'individual'){
            if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){ 
                $stats_telecommercials = User::whereIn('role', ['telecommercial', 'telecommercial_externe'])->where('deleted_status', 'no')->where('status', 'active')->with('getLeads', 'getTelecommiercialProjects')->get();  
                $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get();  
            }else{ 
                if(Auth::user()->role == 'telecommercial' || Auth::user()->role == 'telecommercial_externe' || Auth::user()->role == 'study_manager'){ 
                    $stats_telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->get();     
                }else if(Auth::user()->role == 'sales_manager' || Auth::user()->role == 'sales_manager_externe'){ 
                    $stats_regies = Auth::user()->allRegie;  
                    $stats_telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->get();   
    
                }else{
                    if(Auth::user()->role == 'Gestionnaire'){ 
                        $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->with('getProjects')->get();  
                    }
                    if(Auth::user()->role == 'manager'){ 
                        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                        $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get(); 
                    }  
                }
            }  

            $view = view('admin.tab-stats.individual', compact('stats_telecommercials', 'stats_gestionnaires'))->render();
        }else if($data == 'regie'){
            if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){ 
                $stats_regies = Regie::with('getNonAttribueLead')->get();  
            }else{ 
                if(Auth::user()->role == 'sales_manager' || Auth::user()->role == 'sales_manager_externe'){ 
                    $stats_regies = Auth::user()->allRegie;    
                }else{
                    if(Auth::user()->role == 'Gestionnaire'){ 
                        $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->with('getProjects')->get();  
                    }
                    if(Auth::user()->role == 'manager'){ 
                        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                        $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get(); 
                    }  
                }
            }
            $view = view('admin.tab-stats.regie', compact('stats_regies'))->render();            
        }else if($data == 'gestionnaire'){ 
            if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){  
                $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get();  
            }else{ 
                if(Auth::user()->role == 'Gestionnaire'){ 
                    $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->with('getProjects')->get();  
                }
                if(Auth::user()->role == 'manager'){ 
                    $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                    $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get(); 
                }  
            }  

            $view = view('admin.tab-stats.gestionnaire', compact('stats_gestionnaires'))->render();            
        }else if($data == 'lead-stats'){   
            $fournisseur_de_leads = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->with('getLead', 'getProjects')->get();
            $view = view('admin.tab-stats.lead-stats', compact('fournisseur_de_leads'))->render();            
        }else if($data == 'statut'){   
            $lead_sub_statuses = LeadSubStatus::orderBy('order', 'asc')->with('getLeads')->get();
            $project_sub_statuses = ProjectSubStatus::orderBy('order','asc')->with('getProjects')->get();
            $view = view('admin.tab-stats.statuts', compact('lead_sub_statuses', 'project_sub_statuses'))->render();            
        }
        return response($view); 
    }

    public function chartStats(){
        $projects = [];
        $clients =  [];
        $leads = [];
        $leadsWithConvert = [];
        $days = [];
        $lastThreeMonth = [];
        $lastThreeMonthlead = []; 
        $clientCount = 0;
        $leadsWithConvertCount = 0;
        $lead_percentage = 0;
        $leadList = [];

        if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){ 
            for ($i = 0; $i <= 29; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $leadsWithConvert[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            }
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->with('getStatus')->get();
            for ($i = 2; $i >= 0; $i--) {
                $lastThreeMonth[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                $lastThreeMonthlead[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now()->subMonths($i))->count();
            }

            $projectCount = array_sum($projects);
            $leadCount = array_sum($leads);
            $clientCount = array_sum($clients);
            $leadsWithConvertCount = array_sum($leadsWithConvert);
            if ($leadsWithConvertCount != 0) {
                $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
            }
            $lastThreeMonthleadCount = array_sum($lastThreeMonthlead);   
        }

        $lead_list_view = view('admin.lead_list', compact('leadList'))->render();

        return response()->json(['projects' => $projects, 'clients' => $clients, 'leads' => $leads, 'leadsWithConvert' => $leadsWithConvert, 'days' => $days, 'leadList' => $lead_list_view, 'lastThreeMonth' => $lastThreeMonth, 'lastThreeMonthlead' => $lastThreeMonthlead, 'projectCount' => $projectCount, 'leadCount' => $leadCount, 'clientCount' => $clientCount, 'lead_percentage' => $lead_percentage, 'lastThreeMonthleadCount' => $lastThreeMonthleadCount]);
    }

    public function ringoverHistory(){
        return response(view('admin.home-page-ringover')->render());
    }

    public function taskEditModal (Request $request){
        
        $user_stats_regies = Auth::user()->allRegie; 
        $user_ids = User::whereIn('regie_id', $user_stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){ 
            $project_items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
            $lead_items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get(); 
        }else{  
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){ 
                $project_items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                $telecommercials = User::whereIn('regie_id', $user_stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                $lead_items = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get(); 

            }else{
                $lead_items = Auth::user()->getLeads()->orderBy('Code_Postal', 'asc')->get(); 
                if(role() == 'team_leader'){
                    $team_users = Auth::user()->getTeamUsers;
                    $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                    $project_items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();                
                }else{  
                    if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                        $project_items = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                    }else{
                        $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                        $project_items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                    } 
                }
            } 
        }
        $task = NewTask::find($request->id);
        $view = view('admin.home_page_task_edit', compact('task' ,'project_items', 'lead_items'))->render();
        return response($view);
    }


    public function initialRender(Request $request){

        // tab stats
        $stats_telecommercials = [];
        $stats_gestionnaires = [];

        // Topbar stats
        $totalClients = [];
        $totalLeads = [];
        $totalProjects = [];  
        $roles = Role::where('status', 'active')->get();
        $lead_statuses = LeadStatus::with('getLeads')->get(); 
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();  

        // chart stats
        $projects = [];
        $clients =  [];
        $leads = []; 
        $days = [];
        $lastThreeMonth = [];
        $lastThreeMonthlead = []; 
        $clientCount = 0;
        $leadsWithConvertCount = 0;
        $lead_percentage = 0;
        $leadList = [];
    
    
        $lastThreeMonthleadCount = 0;
        $projectCount = 0;
        $leadCount = 0;
        $clientCount = 0;
        $leadsWithConvertCount = 0; 


        if(Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction'){ 
            // tab stats
            $stats_telecommercials = User::whereIn('role', ['telecommercial', 'telecommercial_externe'])->where('deleted_status', 'no')->where('status', 'active')->with('getLeads', 'getTelecommiercialProjects')->get();  
            $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
            $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get();  

            // // Topbar stats
            // $totalUsers = User::where('deleted_status', 'no')->where('status', 'active')->count(); 
            // $totalLeads = LeadClientProject::where('lead_deleted_status', 0)->get(); 
            // $totalClients = NewClient::where('deleted_status', 0)->with('getProject')->get();
            // $totalProjects = NewProject::where('deleted_status', 0)->get();

            // chart stats
            for ($i = 0; $i <= 29; $i++) {
                $projects[] = NewProject::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $clients[] = NewClient::where('deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $leads[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            }
            $leadList = LeadClientProject::where('lead_deleted_status', 0)->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])->with('getStatus')->get();
            for ($i = 2; $i >= 0; $i--) {
                $lastThreeMonth[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                $lastThreeMonthlead[] = LeadClientProject::where('lead_deleted_status', 0)->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now()->subMonths($i))->count();
            }

            $projectCount = array_sum($projects);
            $leadCount = array_sum($leads);
            $clientCount = array_sum($clients);
            $leadsWithConvertCount = array_sum($leads);
            if ($leadsWithConvertCount != 0) {
                $lead_percentage = round(($clientCount * 100) / $leadsWithConvertCount);
            }
            $lastThreeMonthleadCount = array_sum($lastThreeMonthlead); 
        }else{ 

            // $totalUsers = 0; 
            if(Auth::user()->role == 'telecommercial' || Auth::user()->role == 'telecommercial_externe' || Auth::user()->role == 'study_manager'){ 
                // tab stats
                $stats_telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->get();     

                // // Topbar stats
                // $totalLeads = Auth::user()->getLeads;
                // $totalClients = Auth::user()->getClients;
                // $totalProjects = Auth::user()->getTelecommiercialProjects;    
            }else if(Auth::user()->role == 'sales_manager' || Auth::user()->role == 'sales_manager_externe'){ 
                // tab stats
                $stats_regies = Auth::user()->allRegie;  
                $stats_telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->get();   
                 
                // Topbar stats
                // $regie_leads = LeadClientProject::whereIn('import_regie', $stats_regies->pluck('id'))->where('lead_label', 1)->where('lead_deleted_status', 0)->get(); 
                // $telecommercial_leads = LeadClientProject::whereIn('lead_telecommercial', $stats_telecommercials->pluck('id'))->where('lead_deleted_status', 0)->get();
                // $totalLeads = $telecommercial_leads->merge($regie_leads);
                // $totalClients = NewClient::whereIn('lead_telecommercial', $stats_telecommercials->pluck('id'))->where('deleted_status', 0)->get(); 
                // $totalProjects = NewProject::whereIn('project_telecommercial', $stats_telecommercials->pluck('id'))->where('deleted_status', 0)->get(); 

            }else{
                if(Auth::user()->role == 'Gestionnaire'){ 
                    // tab stats
                    $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id', [Auth::id()])->with('getProjects')->get();  

                    // Topbar stats
                    // $totalProjects = Auth::user()->getProjects; 
                }
                if(Auth::user()->role == 'manager'){ 
                    // tab stats
                    $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
                    $stats_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->with('getProjects')->get(); 

                    // Topbar stats
                    // $totalProjects = NewProject::whereNotNull('project_gestionnaire')->where('deleted_status', 0)->get(); 
                }  
            }
        }  

        $tab_stats_view = view('admin.tab-stats.individual', compact('stats_telecommercials', 'stats_gestionnaires'))->render();
        // $top_bar_stats_view = view("admin.analytic_stats", compact('totalUsers', 'totalProjects', 'totalClients','totalLeads', 'roles', 'lead_statuses', 'project_statuses'))->render();
        $ring_over_view = view('admin.home-page-ringover')->render();
        $lead_list_view = view('admin.lead_list', compact('leadList'))->render();

        return response()->json(['projects' => $projects, 'clients' => $clients, 'leads' => $leads, 'days' => $days, 'leadList' => $lead_list_view, 'lastThreeMonth' => $lastThreeMonth, 'lastThreeMonthlead' => $lastThreeMonthlead, 'projectCount' => $projectCount, 'leadCount' => $leadCount, 'clientCount' => $clientCount, 'lead_percentage' => $lead_percentage, 'lastThreeMonthleadCount' => $lastThreeMonthleadCount, 'tab_stats_view' => $tab_stats_view, 'ring_over_view' => $ring_over_view]);       
    }
    // END
}
