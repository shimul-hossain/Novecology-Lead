<?php

namespace App\Http\Controllers\CRM;

use App\Events\PannelLog;
use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Tax;
use App\Models\CRM\Lead;
use App\Models\CRM\Work;
use App\Models\CRM\Client;
use App\Models\CRM\Company;
use App\Models\CRM\Project;
use App\Models\CRM\Rapport;
use App\Mail\CRM\AssignMail;
use App\Models\CRM\Children;
use App\Models\CRM\Question;
use Illuminate\Http\Request;
use App\Exports\ClientExport;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\Information;
use App\Models\CRM\LeadTracker;
use App\Models\CRM\ClientAssign;
use App\Models\CRM\ClientHeader;
use App\Models\CRM\Intervention;
use App\Models\CRM\ProjectTrait;
use App\Models\CRM\SecondClient;
use App\Models\CRM\SecondReport;
use App\Models\CRM\ClientComment;
use App\Models\CRM\Notifications;
use App\Models\CRM\SecondProject;
use App\Models\CRM\CommentCategory;
use App\Models\CRM\PreInstallation;
use App\Http\Controllers\Controller;
use App\Mail\CRM\CommentMentionMail;
use App\Mail\CRM\NotificationMail;
use App\Models\Brand;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\CallbackHistory;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\PostInstallation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CRM\ClientActivityLog;
use App\Models\CRM\ClientCommentFile;
use App\Models\CRM\ClientCustomField;
use App\Models\CRM\ClientTableStatus;
use App\Models\CRM\SecondInformation;
use App\Models\CRM\ClientHeaderFilter;
use App\Models\CRM\ClientSubStatus;
use App\Models\CRM\ClientTax;
use App\Models\CRM\ClientTaxDeclarant;
use App\Models\CRM\ClientTracker;
use App\Models\CRM\DefaultHeaderFilter;
use App\Models\CRM\HeatingMode;
use Illuminate\Support\Facades\Session;
use App\Models\CRM\InterventionInstallation;
use App\Models\CRM\LeadTax;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\PannelLogActivity;
use App\Models\CRM\ProjectCustomField;
use App\Models\CRM\ProjectProductNombre;
use App\Models\CRM\ProjectTag;
use App\Models\CRM\ProjectTagProduct;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\Role;
use App\Models\CRM\ZoneInfo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ClientController extends Controller
{

    
    // My Client Page 
    public function myClient(){ 
        $headers = ClientHeader::all();
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        
        if(in_array(role(), $administrarif_role)){
            $clients = NewClient::where('deleted_status', 0)->with('getProject', 'clientTelecommercial', 'prospectTelecommercial')->orderBy('Code_Postal', 'asc')->paginate(paginationNumber('client'));
            $filter_telecommercial_status = true;
            $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            
        }else{
            $filter_telecommercial_status = false;
            $client = NewClient::query();
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $client_telecommercial = NewClient::whereIn('client_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $prospect_telecommercial = NewClient::whereIn('lead_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $final_telecomemrcial = $client_telecommercial->merge($prospect_telecommercial);
                $client->whereIn('id', $final_telecomemrcial);
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else{
                $telecommercials = [];
                $client->where('lead_telecommercial', Auth::id())->orWhere('client_telecommercial', Auth::id());
            }

            $clients = $client->where('deleted_status', 0)->with('getProject', 'clientTelecommercial', 'prospectTelecommercial')->orderBy('Code_Postal', 'asc')->paginate(paginationNumber('client'));
            // $clients =  Auth::user()->getClients()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->paginate(paginationNumber('client'));
        }
        $default_filters = DefaultHeaderFilter::with('getClientHeader')->get();
        $users = User::all();
        $client_id = 0;
        $client_status = ClientSubStatus::all(); 
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $campagne_types = Campagnetype::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $departments = ZoneInfo::all();
        $filter_status = ClientHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('client_header_id', 'asc')->get();
 
        return view('admin.my-clients', compact('clients', 'headers', 'users','client_id', 'client_status', 'default_filters', 'telecommercials', 'suppliers','campagne_types', 'bareme_travaux_tags', 'heatings', 'departments', 'filter_telecommercial_status', 'filter_status'));
    }

    public function clientFilter(){
        if(!checkAction(Auth::id(), 'client', 'filter_blue_button') && role() != 's_admin'){
            return back();
        }

        $headers = ClientHeader::all(); 
        $default_filters = DefaultHeaderFilter::with('getClientHeader')->get();
        $users = User::all();
        $client_id = 0;
        $client_status = ClientSubStatus::all();
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $campagne_types = Campagnetype::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $departments = ZoneInfo::all();
        $client = NewClient::query(); 
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        $filter_telecommercial_status = true;

        if(!in_array(role(), $administrarif_role)){ 
            $filter_telecommercial_status = false;
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $client_telecommercial = NewClient::whereIn('client_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $prospect_telecommercial = NewClient::whereIn('lead_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $final_telecomemrcial = $client_telecommercial->merge($prospect_telecommercial);
                $client->whereIn('id', $final_telecomemrcial);
                // $client->whereIn('client_telecommercial', $user_ids);
                $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            }else{
                $client->where('lead_telecommercial', Auth::id())->orWhere('client_telecommercial', Auth::id());
                $telecommercials = [];
            } 
        } 

        if(request()->__tracking__Fournisseur_de_lead){
            if(request()->__tracking__Fournisseur_de_lead == 'no-data'){
                $client->whereNull('__tracking__Fournisseur_de_lead');
            }else{
                $client->where('__tracking__Fournisseur_de_lead', request()->__tracking__Fournisseur_de_lead);
            }
        }
        if(request()->__tracking__Type_de_campagne){
            if(request()->__tracking__Type_de_campagne == 'no-data'){
                $client->whereNull('__tracking__Type_de_campagne');
            }else{
                $client->where('__tracking__Type_de_campagne', request()->__tracking__Type_de_campagne);
            }
        }
        if(request()->__tracking__Nom_campagne){
            $client->where('__tracking__Nom_campagne','LIKE', '%'.request()->__tracking__Nom_campagne.'%');
        }
        if(request()->__tracking__Date_demande_lead_from || request()->__tracking__Date_demande_lead_to){
            $from = request()->__tracking__Date_demande_lead_from ?? Carbon::now();
            $to = request()->__tracking__Date_demande_lead_to ?? Carbon::now();
            $client->whereBetween('__tracking__Date_demande_lead', [$from, $to]);
        } 
        if(request()->__tracking__Date_attribution_télécommercial){
            $client->where('__tracking__Date_attribution_télécommercial','LIKE', '%'.request()->__tracking__Date_attribution_télécommercial.'%');
        } 
        if(request()->Prenom){
            $client->where('Prenom','LIKE', '%'.request()->Prenom.'%');
        }
        if(request()->Nom){
            $client->where('Nom','LIKE', '%'.request()->Nom.'%');
        } 
        if(request()->Email){
            $client->where('Email','LIKE', '%'.request()->Email.'%');
        } 
        if(request()->Type_occupation){
            if(request()->Type_occupation == 'no-data'){
                $client->whereNull('Type_occupation');
            }else{
                $client->where('Type_occupation','LIKE', '%'.request()->Type_occupation.'%');
            }
        } 
        if(request()->Zone){
            if(request()->Zone == 'no-data'){
                $client->whereNull('Zone');
            }else{
                $client->where('Zone','LIKE', '%'.request()->Zone.'%');
            }
        }
        if(request()->precariousness){
            if(request()->precariousness == 'no-data'){
                $client->whereNull('precariousness');
            }else{
                $client->where('precariousness','LIKE', '%'.request()->precariousness.'%');
            }
        }
        if(request()->Mode_de_chauffage){
            if(request()->Mode_de_chauffage == 'no-data'){
                $client->whereNull('Mode_de_chauffage');
            }else{
                $client->where('Mode_de_chauffage','LIKE', '%'.request()->Mode_de_chauffage.'%');
            }
        }
        if(request()->Surface_habitable){
            $client->where('Surface_habitable','LIKE', '%'.request()->Surface_habitable.'%');
        }
        if(request()->Situation_familiale){
            if(request()->Situation_familiale == 'no-data'){
                $client->whereNull('Situation_familiale');
            }else{
                $client->where('Situation_familiale','LIKE', '%'.request()->Situation_familiale.'%');
            }
        } 
        if(($filter_telecommercial_status || role() == 'sales_manager' || role() == 'sales_manager_externe') && request()->telecommercial_id){
            if(request()->telecommercial_id == 'no-data'){
                $client->whereNull('lead_telecommercial');
            }else{
                $client->where('lead_telecommercial', request()->telecommercial_id);
            }
        } 

        $clients = $client->where('deleted_status', 0)->with('getProject', 'clientTelecommercial', 'prospectTelecommercial')->orderBy('Code_Postal', 'asc')->paginate(paginationNumber('client')); 
        $filter_status = ClientHeaderFilter::where('user_id', Auth::id())->with('getHeader')->orderBy('client_header_id', 'asc')->get();

        return view('admin.my-clients', compact('clients', 'headers', 'users','client_id', 'client_status', 'default_filters', 'telecommercials', 'suppliers','campagne_types', 'bareme_travaux_tags', 'heatings', 'departments', 'filter_telecommercial_status', 'filter_status'));
    }

    // client export 
    public function clientExport($id){
        $array = explode(',', $id);
        return back();
        // dd($request->all);
        return Excel::download(new ClientExport($array), 'clients.xlsx');
    }

    public function clientCommentUpdate(Request $request){

        $data = Client::find($request->client_id);
        $data->comment = $request->comment;
        $data->save();

        return response()->json(['comment' => $data->comment, 'alert' => __('Comment Updated')]);
    }


    // Client Header Filter 
    public function clientHeaderFilter(Request $request){

        if(!checkAction(Auth::id(), 'client', 'add_filter') && role() != 's_admin'){
            return back();
        }

        $existing_filter = ClientHeaderFilter::where('user_id', Auth::id())->get();
        
        foreach($existing_filter as $item){
            $item->delete();
        } 
            
        if($request->header_id){
            foreach($request->header_id as $id){
                ClientHeaderFilter::create([
                    'client_header_id'  => $id,
                    'user_id'           => Auth::id(),
                    'status'            =>'show',
                ]);
            }
        }

        return back()->with('success', __('Filter Added'));
    }

    // Client Update 
    public function clientLeadUpdate($id){
        $permission = false;
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $permission = true;
        }else{
            $client = NewClient::query();
            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $stats_regies = Auth::user()->allRegie; 
                $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                $client_telecommercial = NewClient::whereIn('client_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $prospect_telecommercial = NewClient::whereIn('lead_telecommercial', $user_ids)->where('deleted_status', 0)->pluck('id');
                $final_telecomemrcial = $client_telecommercial->merge($prospect_telecommercial);
                $client->whereIn('id', $final_telecomemrcial);
                // $client->whereIn('lead_telecommercial', $user_ids);
            }else{
                $client->where('lead_telecommercial', Auth::id())->orWhere('client_telecommercial', Auth::id());
            } 

            $clients = $client->where('deleted_status', 0)->pluck('id')->toArray();

            if(in_array($id, $clients)){
                $permission = true;
            }
        }   

        if(!$permission){
            return back();
        }
    

        if (checkAction(Auth::id(), 'client', 'edit') || in_array(role(), $administrarif_role)){
        $client = NewClient::find($id);

        if($client->deleted_status == 1){
            return redirect()->route('clients.index')->with('error', 'Ce client est supprimé');
        }
        
        if($client && $client->callback_time && $client->callback_history_type == 0 && $client->callback_time < Carbon::now()){
            CallbackHistory::create([
                'type' => 'client',
                'feature_id' => $client->id,
                'expired_date' => $client->callback_time,
                'callback_user_id' => $client->callback_user_id,
                'user_id' => Auth::id(),
                'status' => '',
            ]);
            $client->callback_history_type = 1;
            $client->save();
        }

        $tax = ClientTax::where('client_id', $id)->get();
        $primary_tax = ClientTax::where('client_id', $id)->where('primary', 'yes')->first();
        $childrens = Children::where('client_id', $id)->get();
        $suppliers = Fournisseur::where('active', 'Oui')->where('type', 'Lead')->get();
        $campagne_types = Campagnetype::all(); 
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        // $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 16)->get();
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        $activities = $client->getActivity;
        // $all_inputs = ClientCustomField::all();
        $all_inputs = ProjectCustomField::all();
        if(role() == 's_admin'){
            $comments = $client->getComments;
            $categories = CommentCategory::all();
        }else{
            $comments = ClientComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('client_id', $id)->orderBy('id', 'desc')->get();
            $categories = Auth::user()->commentCategory;
        } 
        $tag_users_id = []; 
        if($client->prospectTelecommercial){
            $tag_users_id[] = $client->lead_telecommercial;
            if($client->prospectTelecommercial->getRegie &&  $client->prospectTelecommercial->getRegie->getUser){
                $tag_users_id[] = $client->prospectTelecommercial->getRegie->getUser->id; 
            }
        }

        if($client->clientTelecommercial){
            $tag_users_id[] = $client->client_telecommercial;
            if($client->clientTelecommercial->getRegie &&  $client->clientTelecommercial->getRegie->getUser){
                $tag_users_id[] = $client->clientTelecommercial->getRegie->getUser->id;
            }
        }
        $assign_users = User::whereIn('id', $tag_users_id)->where('deleted_status', 'no')->where('status', 'active')->get();
        $admin_tag_role = Role::whereIn('category_id', [3,4])->where('value', '<>', 'Logistique')->pluck('value')->toArray();
        $admin_users = User::whereIn('role', $admin_tag_role)->where('deleted_status', 'no')->where('status', 'active')->get();

        $tag_users = $admin_users->merge($assign_users);

        $address = '';
        if($client->primaryTax){
            if($client->primaryTax->google_address){
                $address = $client->primaryTax->google_address;
            }else{
                $address = $client->Adresse .' '. $client->Code_Postal .' '. $client->Ville;
            }
        }
        $location = self::location($address);

        $lat  = $location['status'] == 'success' ? $location['lat'] ?? 48.066709713351116 : 48.066709713351116;
        $lng  = $location['status'] == 'success' ? $location['lng'] ?? -2.965925932451392 : -2.965925932451392;


        return view('admin.new-client', compact('tax', 'client', 'childrens', 'suppliers', 'comments', 'activities', 'categories', 'primary_tax', 'campagne_types', 'bareme_travaux_tags', 'heatings', 'telecommercials', 'gestionnaires', 'all_inputs', 'tag_users', 'lat', 'lng'));
        }else{
            return back()->with('error', __('You are not authorized to make this action'));
        }
    }

    // Client Status Update 
    public function clientStatusUpdate(Request $request){

        $client = Client::find($request->client_id);
         
        if($client->status == $request->status){

            return response()->json(['alert' => __('Status Already').' ']);
        } 
        else{
            $client->status = $request->status;
            $client->save();
            $notification = Notifications::create([
                'title'  => ['en' => 'Client Status Change', 'fr' =>'Changement de statut du client'],
                'body'   => ['en' => 'You Changed '.$client->first_name. ' ' .$client->last_name.'\'s Lead Status to '.$request->status, 'fr' =>'Tu as changé '. $client->first_name. ' '.$client->last_name.'\'s Statut du prospect à '.$request->status ],
                'user_id' => Auth::id(),
                'lead_id' => $client->lead_id
            ]);
            
            $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
            $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();

            $view = view('includes.crm.view-notification', compact('notification')); 
            $response = $view->render();  

            return response()->json(['response' => $response,'count'=>$count, 'success' => __('Status Updated'), 'data' => $client->status]);
        }

        // return response($client->email);
    }

    // Client Search 
    public function clientSearch(Request $request){

        $headers = ClientHeader::all();
        $filter_status =ClientHeaderFilter::where('user_id', Auth::id())->orderBy('client_header_id', 'asc')->get();
        $column = $request->column;
        $search = $request->search;
        if($search != ''){
            $clients = Client::where($column, 'LIKE', '%'.$search.'%')->where('deleted_status', 0)->orderBy('id', 'desc')->get();
        }
        else{
            $clients = Client::where('deleted_status', 0)->orderBy('id', 'desc')->get();
        }
        

        $view = view('includes.crm.clients', compact('clients', 'filter_status'));
        $response = $view->render();
        return response()->json(['response' => $response]);
    } 

    // Update Client Image  
    public function updateClientImage(Request $request){
        
        $data = Client::findOrFail($request->client_id);

        if($request->file('image')){
            
            $image = $request->file('image'); 
            $filename = $data->id . 'client.' . $image->extension('image');
            $location = public_path('uploads/crm/leads');
            $image->move($location, $filename);
            $data->image = $filename;
            $data->save(); 
        }
        
        return back()->with('success', __('Image Updated Successfully'));   
    }

    // Client info update 
    public function clientInfoUpdate(Request $request){
        $client = Client::findOrFail($request->client_id);
        $client->update($request->except('_token','client_id'));

        return back()->with('success', __('Updated Successfully'));
    }

    public function clientProjetUpdate(Request $request){ 
        $client = Client::findOrFail($request->client_id);
        $client->project_id = $request->project_id;
        $client->save();
        return response()->json(['project_id' => $client->project_id, 'alert' => __('Project Updated')] );
    }

        // update personal info 
        public function clientPersonalInfoUpdate(Request $request){
            
            $client = Client::findOrFail($request->client_id);
            $client->first_name   = $request->first_name;
            $client->last_name    = $request->last_name;
            $client->phone        = $request->phone;
            $client->email        = $request->email;
            $client->pays         = $request->pays;
            $client->postal_code  = $request->postal_code;
            $client->city         = $request->city;
            $client->address      = $request->address;
            $client->save(); 
            
            return response()->json(['first_name' =>$client->first_name, 'last_name' =>$client->last_name, 'phone' => $client->phone, 'email' => $client->email, 'department' =>$client->city, 'zone' => $client->postal_code, 'alert' => __('Personal Info Updated')]);
        }

        // Update Client work 
        public function clientWorkUpdate(Request $request){
            
            $client = NewClient::find($request->client_id);
            $client->Type_occupation                  = $request->Type_occupation;
            $client->Parcelle_cadastrale              = $request->Parcelle_cadastrale;
            $client->Nombre_de_foyer                  = $request->Nombre_de_foyer;
            $client->Age_du_bâtiment                  = $request->Age_du_bâtiment; 
            $client->Type_habitation                  = $request->Type_habitation; 
            // $client->Revenue_Fiscale_de_Référence     = $request->Revenue_Fiscale_de_Référence;
            // $client->Nombre_de_personnes              = $request->Nombre_de_personnes;
            $client->Zone                             = $request->Zone;  
            // $client->precariousness_year              = $request->precariousness_year;  
            // if($request->precariousness_year == '2023'){
            //     $client->precariousness                   = getPrecariousness($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $client->Code_Postal); 
            // }else{
            //     $client->precariousness                   = getPrecariousness2024($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $client->Code_Postal); 
            // }
            $client->save();  

            foreach($client->getChanges() as $key => $value){
                if($key != "updated_at" && $key != 'user_id'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Eligibility',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client', 
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
                $client->eligibility_custom_field_data = $json;
                $client->save(); 
            }
    
            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.client-activity-log', compact('activities'));
            $activity = $activity_log->render();
    
            return response()->json(['alert' => __('Client Eligibility Updated'),  'log' => $activity, 'precariousness' => $client->precariousness]); 
        }

        // Update client present 
        public function clientPresentWorkUpdate(Request $request){
            $client = NewClient::findOrFail($request->client_id);
            $client->Type_de_logement                                                 = $request->Type_de_logement;    
            $client->Type_de_chauffage                                                = $request->Type_de_chauffage;    
            $client->Mode_de_chauffage                                                = $request->Mode_de_chauffage;    
            $client->Date_construction_maison                                         = $request->Date_construction_maison;    
            $client->Surface_habitable                                                = $request->Surface_habitable;    
            $client->Consommation_chauffage_annuel                                    = $request->Consommation_chauffage_annuel;    
            $client->Surface_à_chauffer                                               = $request->Surface_à_chauffer;    
            $client->Mode_de_chauffage__a__                                           = $request->Mode_de_chauffage__a__;    
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__  = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;    
            $client->Consommation_Chauffage_Annuel_2                                  = $request->Consommation_Chauffage_Annuel_2;    
            $client->Depuis_quand_occupez_vous_le_logement                            = $request->Depuis_quand_occupez_vous_le_logement;    
            $client->auxiliary_heating_status                                         = $request->auxiliary_heating_status;    
            $client->second_heating_generator_status                                  = $request->second_heating_generator_status;    
            $client->auxiliary_heating                                                = $request->auxiliary_heating;    
            $client->auxiliary_heating__a__                                           = $request->auxiliary_heating__a__;    
            $client->second_heating_generator                                         = $request->second_heating_generator;    
            $client->second_heating_generator__a__                                    = $request->second_heating_generator__a__;    
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement       = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;    
            $client->Production_dapostropheeau_chaude_sanitaire                       = $request->Production_dapostropheeau_chaude_sanitaire;    
            $client->Instantanné                                                      = $request->Instantanné;    
            $client->Accumulation                                                     = $request->Accumulation;    
            $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude               = $request->Précisez_le_volume_du_ballon_dapostropheeau_chaude;    
            $client->Information_logement_observations                                = $request->Information_logement_observations;    
            $client->Préciser_le_type_de_radiateurs_Aluminium                         = $request->Préciser_le_type_de_radiateurs_Aluminium;    
            $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs    = $request->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;    
            $client->Préciser_le_type_de_radiateurs_Fonte                             = $request->Préciser_le_type_de_radiateurs_Fonte;    
            $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;    
            $client->Préciser_le_type_de_radiateurs_Acier                             = $request->Préciser_le_type_de_radiateurs_Acier;    
            $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;    
            $client->Préciser_le_type_de_radiateurs_Autre                             = $request->Préciser_le_type_de_radiateurs_Autre;    
            $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;    
            $client->Préciser_le_type_de_radiateurs_Autre___a__                       = $request->Préciser_le_type_de_radiateurs_Autre___a__;    
            $client->Type_du_courant_du_logement                                      = $request->Type_du_courant_du_logement;    
            $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude   = $request->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;  
            $client->Instantanné_Merci_de_préciser                                    = $request->Instantanné_Merci_de_préciser;  
            $client->Accumulation_Merci_de_préciser                                   = $request->Accumulation_Merci_de_préciser; 
            $client->Le_logement_possède_un_réseau_hydraulique                        = $request->Le_logement_possède_un_réseau_hydraulique;   
            $client->auxiliary_heating__Insert_à_bois_Nombre                        = $request->auxiliary_heating__Insert_à_bois_Nombre;   
            $client->auxiliary_heating__Poêle_à_bois_Nombre                        = $request->auxiliary_heating__Poêle_à_bois_Nombre;   
            $client->auxiliary_heating__Poêle_à_gaz_Nombre                        = $request->auxiliary_heating__Poêle_à_gaz_Nombre;   
            $client->auxiliary_heating__Convecteur_électrique_Nombre                        = $request->auxiliary_heating__Convecteur_électrique_Nombre;   
            $client->auxiliary_heating__Sèche_serviette_Nombre                        = $request->auxiliary_heating__Sèche_serviette_Nombre;   
            $client->auxiliary_heating__Panneau_rayonnant_Nombre                        = $request->auxiliary_heating__Panneau_rayonnant_Nombre;   
            $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre                        = $request->auxiliary_heating__Radiateur_bain_dhuile_Nombre;   
            $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                        = $request->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;   
            $client->auxiliary_heating__Autre_Nombre                        = $request->auxiliary_heating__Autre_Nombre;   
            $client->save();

            foreach($client->getChanges() as $key => $value){
                if($key != "updated_at" && $key != 'user_id'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Chantier de travail',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
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
                $client->information_logement_custom_field_data = $json;
                $client->save(); 
            }
 
            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.client-activity-log', compact('activities'));
            $activity = $activity_log->render();

            return response()->json(['alert' => __('Client Work Info Updated'),  'log' => $activity]);  
        }

        // Tax Update 
        public function clientTaxUpdate(Request $request){

            $all_taxess = ClientTax::where('client_id', $request->client_id)->get(); 
               
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
                    $taxx =  ClientTax::create([
                        'tax_number'        => $request->tax_number, 
                        'tax_reference'     => $request->tax_reference, 
                        'client_id'         => $request->client_id,  
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

                    $client = NewClient::find($request->client_id);

                    if($all_taxess->count() > 0)
                    {
                        $taxx->primary = 'no'; 
                    }
                    else{
                        
                        $taxx->primary = 'yes';
                        $taxx->mark_check = 'yes';
                        $taxx->save();  
                        $client->Prenom                             = $taxx->first_name;
                        $client->Nom                                = $taxx->last_name;
                        $client->Revenue_Fiscale_de_Référence       = $taxx->pays;
                        $client->Nombre_de_personnes                = $person;
                        $client->Ville                              = $taxx->city;
                        $client->Code_Postal                        = $taxx->postal_code;
                        $client->Département                        = getDepartment3($taxx->postal_code);
                        $client->Zone                               = getPrimaryZone($taxx->postal_code);
                        if($client->precariousness_year == '2023'){
                            $client->precariousness                     = getPrecariousness($person, $taxx->pays, $taxx->postal_code);
                        }else{
                            $client->precariousness                     = getPrecariousness2024($person, $taxx->pays, $taxx->postal_code);
                        }
                        $client->Adresse                            = $taxx->address2;
                        $client->Complément_adresse                 = $taxx->address;
                        $client->latitude                           = $taxx->latitude;
                        $client->longitude                          = $taxx->longitude; 

                        $client->save();
                    }

                    $taxx->save();

                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Numéro d'exercice",
                        'value'         => $taxx->tax_number, 
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Avis de référence",
                        'value'         => $taxx->tax_reference, 
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
    
                        $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
                        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
                        $activity = $activity_log->render(); 


                        $tax = ClientTax::where('client_id', $request->client_id)->orderBy('primary', 'asc')->get();
                        $primary_tax = ClientTax::where('client_id', $request->client_id)->where('primary', 'yes')->first();
                        $type = 'client_collapse_personal_information';
                        $data = NewClient::find($request->client_id);
                        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
                        $tax_all = $all_taxes->render();
                        // $tax = Tax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
                        $all_taxes_data = view('includes.crm.client-tax', compact('tax'));
                        $tax_all_data = $all_taxes_data->render();
                        $all_taxes_data2 = view('includes.crm.client-tax-info', compact('tax'));
                        $tax_all_data2 = $all_taxes_data2->render();
                        return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'),'address' => $taxx->address,'address2' => $taxx->address2, 'fiscal_amount' => $taxx->pays,'family_person' => $person, 'zone' => getPrimaryZone($taxx->postal_code),'precariousness' => $client->precariousness, 'city' =>getDepartment($taxx->postal_code), 'name' => $taxx->first_name.' '.$taxx->last_name, 'email' => $taxx->email, 'phone' => $taxx->phone, 'primary'=> $taxx->primary, 'log' => $activity]);  
                        // return response('tax added successfully');
                }
                else{
                    return response()->json(['error' => __('Wrong fiscal number and reference notice')]);
                }
            // } 
        }

        // Tax primary change 
        public function taxClientPrimaryChange(Request $request){ 

                $all_tax = ClientTax::where('client_id', $request->client_id)->get();
                foreach($all_tax as $tax){
                    $tax->primary = 'no';
                    $tax->save();
                }
                
                $taxe = ClientTax::find($request->tax_id);
                // if($taxe->second_first_name){
                //     $person = 2 + $taxe->kids;
                // }
                // else{
                //     $person = 1 + $taxe->kids;
                // } 
        
                $taxe->primary = 'yes';
                $taxe->save();
                $client = NewClient::find($request->client_id); 
                $client->Prenom   = $taxe->first_name;
                $client->Nom        = $taxe->last_name;
                // $client->fiscal_amount= $taxe->pays;
                $client->Ville         = $taxe->city;
                if($taxe->same_as_work_address == 'no'){ 
                    if (!$taxe->google_address) {
                        $location = self::location($taxe->Adresse_Travaux); 
                        $client->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                        $client->longitude  = $location['status'] == 'success' ? $location['lng']:'';  
                    }
                    $client->Code_Postal      = $taxe->Code_postal_Travaux; 
                    $client->Zone             = getPrimaryZone($taxe->Code_postal_Travaux);
                    $client->Adresse           = $taxe->Adresse_Travaux;
                    $client->Complément_adresse= $taxe->Complément_adresse_Travaux;
                    $client->Département       = getDepartment3($taxe->Code_postal_Travaux);
                    if($client->precariousness_year == '2023'){
                        $client->precariousness   = getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
                    }else{
                        $client->precariousness   = getPrecariousness2024($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
                    }
                }else{
                    if (!$taxe->google_address) {
                        $location = self::location($taxe->address2); 
                        $client->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                        $client->longitude  = $location['status'] == 'success' ? $location['lng']:''; 
                    }
                    $client->Code_Postal            = $taxe->postal_code; 
                    $client->Zone                = getPrimaryZone($taxe->postal_code);
                    $client->Adresse           = $taxe->address2;
                    $client->Complément_adresse= $taxe->address;
                    $client->Département       = getDepartment3($taxe->postal_code);
                    if($client->precariousness_year == '2023'){
                        $client->precariousness   = getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->postal_code);
                    }else{
                        $client->precariousness   = getPrecariousness2024($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->postal_code);
                    }
                };   
                if($taxe->google_address){
                    $location = self::location($taxe->google_address); 
                    $client->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $client->longitude  = $location['status'] == 'success' ? $location['lng']:''; 
                }
                $client->Email        = $taxe->email;
                $client->phone        = $taxe->phone;
                $client->save();
        
        
                $tax = ClientTax::where('client_id', $request->client_id)->orderBy('primary', 'asc')->get();
                $primary_tax = ClientTax::where('client_id', $request->client_id)->where('primary', 'yes')->first();
                $type = 'client_collapse_personal_information';
                $data = NewClient::find($request->client_id);
                $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
                $tax_all = $all_taxes->render(); 
                 
                return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => $client->Zone ,'precariousness' => $client->precariousness, 'city' =>getDepartment($client->Code_Postal), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]); 

                // if($taxe->same_as_work_address == 'no'){
                //     return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => getPrimaryZone($taxe->Code_postal_Travaux),'precariousness' => getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux), 'city' =>getDepartment($taxe->Code_postal_Travaux), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]); 
                // }else{
                //     return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => getPrimaryZone($taxe->postal_code),'precariousness' => getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $taxe->postal_code), 'city' =>getDepartment($taxe->postal_code), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]); 
                // }

        }
        
        // Tax info update
        public function taxCleintInfoUpdate(Request $request){
            
            $tax = ClientTax::find($request->tax_id);
            $client = NewClient::find($request->client_id);
            // $tax->update($request->except('_token','tax_id','lead_id', 'client_id' ,'company_id', 'custom_field_data')); 

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

            // }else{
            //     if($tax->address2  != $request->address2){
            //         $location3 = self::location($request->address2); 
            //         $tax->latitude  = $location3['status'] == 'success' ? $location3['lat']:'';
            //         $tax->longitude  = $location3['status'] == 'success' ? $location3['lng']:'';
            //     }
            // }
    
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
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
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
                $client->personal_info_custom_field_data = $json;
                $client->save(); 
            }

                 
    
                $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
                $activity_log = view('includes.crm.client-activity-log', compact('activities'));
                $activity = $activity_log->render();

            $tax = ClientTax::find($request->tax_id);
            if($tax->primary == 'yes'){
                $client = NewClient::find($request->client_id);  
                $client->Titre       = $tax->title;
                $client->Prenom          = $tax->first_name;
                $client->Nom             = $tax->last_name;
                $client->Email           = $tax->email;
                $client->phone           = $tax->phone;
                $client->fixed_number       = $tax->telephone;
                $client->latitude        = $tax->latitude;
                $client->longitude       = $tax->longitude;
                if($tax->same_as_work_address == 'no'){
                    $client->Ville             = $tax->Ville_Travaux;
                    $client->Code_Postal       = $tax->Code_postal_Travaux;
                    $client->Zone              = getPrimaryZone($tax->Code_postal_Travaux);
                    $client->Adresse           = $tax->Adresse_Travaux;
                    $client->Complément_adresse= $tax->Complément_adresse_Travaux;
                    $client->Département       = getDepartment3($tax->Code_postal_Travaux);
                    if($client->precariousness_year == '2023'){
                        $client->precariousness    = getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                    }else{
                        $client->precariousness    = getPrecariousness2024($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                    }
                    $client->save();

                    $zone_type = 'Zone_Hors_IDF';
                    if($client->Code_Postal){
                        if(\App\Models\CRM\CheckZone::where('postal_code', substr($client->Code_Postal, 0,2))->exists()){
                            $zone_type = 'Zone_IDF';
                        }
                    }
                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' =>getDepartment($tax->Code_postal_Travaux), 'zone' => $client->Ville, 'precariousness' => $client->precariousness, 'department' =>getDepartment2($tax->Code_postal_Travaux), 'log' => $activity, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
                }else{
                    $client->Ville             = $tax->city;
                    $client->Code_Postal       = $tax->postal_code;
                    $client->Zone              = getPrimaryZone($tax->postal_code);
                    $client->Adresse           = $tax->address2;
                    $client->Complément_adresse= $tax->address;
                    $client->Département       = getDepartment3($tax->postal_code);
                    if($client->precariousness_year == '2023'){
                        $client->precariousness   = getPrecariousness($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $tax->postal_code);
                    }else{
                        $client->precariousness   = getPrecariousness2024($client->Nombre_de_personnes, $client->Revenue_Fiscale_de_Référence, $tax->postal_code);
                    }
                    $client->save(); 

                    $zone_type = 'Zone_Hors_IDF';
                    if($client->Code_Postal){
                        if(\App\Models\CRM\CheckZone::where('postal_code', substr($client->Code_Postal, 0,2))->exists()){
                            $zone_type = 'Zone_IDF';
                        }
                    }
                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' =>getDepartment($tax->postal_code), 'zone' => $client->Ville, 'precariousness' => $client->precariousness, 'department' =>getDepartment2($tax->postal_code), 'log' => $activity, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
                } 
            }else{
                return response()->json(['alert' => __('Info Updated Successfully'), 'log' => $activity, 'loggleAddress' => urlencode($request->google_address)]);
            }
        }

        // New Project Create 
        public function newProjectCreate(Request $request){
            // return response('hello world');
        }

        // client Foyer Update
        public function clientFoyerUpdate(Request $request){
            $client = NewClient::find($request->client_id);
            if($request->birth_name){
                foreach($request->birth_name as $key => $value){
                    if($value){
                        Children::create([
                            'name'          => $value,
                            'birth_date'    => $request->birth_date[$key],
                            'client_id'     => $request->client_id,
                            'lead_id'       => $client->lead_id,
                            'created_by'    => Auth::id(),
                        ]);
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => 'Situation foyer',
                            'key'           => 'Nom',
                            'value'         => $value,
                            'feature_id'    => $request->client_id,
                            'feature_type'  => 'client',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => 'Situation foyer',
                            'key'           => 'Date De Naissance',
                            'value'         => $request->birth_date[$key],
                            'feature_id'    => $request->client_id,
                            'feature_type'  => 'client',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                }
                // Children::create([
                //     'name'          => $request->birth_name,
                //     'birth_date'    => $request->birth_date,
                //     'client_id'     => $request->client_id,
                //     'lead_id'       => $client->lead_id,
                //     'created_by'    => Auth::id(),
                // ]);
                // $pannel_activity = PannelLogActivity::create([
                //     'tab_name'      => 'Client',
                //     'block_name'    => 'Situation foyer',
                //     'key'           => 'Nom',
                //     'value'         => $request->birth_name,
                //     'feature_id'    => $request->client_id,
                //     'feature_type'  => 'client',
                //     'user_id'       => Auth::id(), 
                // ]);
                // event(new PannelLog($pannel_activity->id));
                // $pannel_activity = PannelLogActivity::create([
                //     'tab_name'      => 'Client',
                //     'block_name'    => 'Situation foyer',
                //     'key'           => 'Date De Naissance',
                //     'value'         => $request->birth_date,
                //     'feature_id'    => $request->client_id,
                //     'feature_type'  => 'client',
                //     'user_id'       => Auth::id(), 
                // ]);
                // event(new PannelLog($pannel_activity->id));
               
            } 
            $client->update($request->except(['_token','client_id', 'birth_name', 'birth_date', 'custom_field_data'])); 
        
    
            foreach($client->getChanges() as $key => $value){
                if($key != "updated_at" && $key != 'user_id'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Situation foyer',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
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
                $client->situation_foyer_custom_field_data = $json;
                $client->save(); 
            }

            $childrens = Children::where('lead_id', $client->lead_id)->get();
    
            $child = view('includes.crm.children', compact('childrens'));
            
            $child_rander = $child->render();

            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.client-activity-log', compact('activities'));
            $activity = $activity_log->render();
    
            return response()->json(['alert' => __('Updated Successfully'), 'children' => $child_rander, 'log' => $activity]);
        }

        // Client Project Create 
        public function clientprojectCreate(Request $request){
            
            $client = Client::find($request->client_id);
            $project = new Project();
            $project->project_name              = $request->name;
            $project->first_name                = $client->first_name;
            $project->last_name                 = $client->last_name;
            $project->phone                     = $client->phone;
            $project->email                     = $client->email;
            $project->pays                      = $client->pays;
            $project->image                     = $client->image;
            $project->precariousness            = $client->precariousness;
            $project->department                = $client->department;
            $project->postal_code               = $client->postal_code;
            $project->zone                      = $client->zone;
            $project->city                      = $client->city; 
            $project->heating_type              = $client->heating_type;
            $project->second_heating_type       = $client->second_heating_type;  
            $project->other_second_heating_type = $client->other_second_heating_type;  
            $project->address                   = $client->address;  
            $project->present_address           = $client->present_address;  
            $project->address_lat               = $client->address_lat;  
            $project->address_lng               = $client->address_lng;  
            $project->nature_occupation         = $client->nature_occupation;
            $project->occupation_type           = $client->occupation_type;  
            $project->fiscal_amount             = $client->fiscal_amount;  
            $project->foyer                     = $client->foyer;  
            $project->family_person             = $client->family_person;  
            $project->date_fo_construction      = $client->date_fo_construction;  
            $project->auxiliary_heating         = $client->auxiliary_heating;  
            $project->transmitter_type          = $client->transmitter_type;  
            $project->number_of_radiator        = $client->number_of_radiator;  
            $project->radiator_type             = $client->radiator_type;  
            $project->other_radiator_type       = $client->other_radiator_type;  
            $project->hot_water_production      = $client->hot_water_production;  
            $project->hot_water_feature         = $client->hot_water_feature;  
            $project->volume                    = $client->volume;  
            $project->annual_heating            = $client->annual_heating;  
            $project->adult_occupants           = $client->adult_occupants;  
            $project->child_occupants           = $client->child_occupants;  
            $project->family_situation          = $client->family_situation;   
            $project->mr_activity               = $client->mr_activity;  
            $project->mr_revenue                = $client->mr_revenue;  
            $project->mrs_activity              = $client->mrs_activity;  
            $project->mrs_revenue               = $client->mrs_revenue;  
            $project->monthly_credit            = $client->monthly_credit;  
            $project->with_basement             = $client->with_basement;
            $project->revenue_credit            = $client->revenue_credit;  
            $project->living_space              = $client->living_space;
            $project->cadstrable_plot           = $client->cadstrable_plot;
            $project->house_over_15_years       = $client->house_over_15_years;
            $project->status                    = 'NEW';
            $project->company_id                = $client->company_id;
            $project->client_id                 = $client->id;
            $project->lead_id                   = $client->lead_id; 
            $project->user_id                   = Auth::id();
            $project->save();

            $tracker = LeadTracker::where('client_id',$client->id)->first();
            if($tracker){
                LeadTracker::create([
                    'tracker_name'      => $tracker->tracker_name,
                    'tracker_platform'  => $tracker->tracker_platform,
                    'tracker_email'     => $tracker->tracker_email,
                    'tracker_phone'     => $tracker->tracker_phone,
                    'project_id'        => $project->id,
                ]);
            }

             
            
             
             $work = Work::where('client_id', $client->id)->first();
            if($work){ 
                Work::create([
                    'travaux'       => $work->travaux,
                    'financement'   => $work->financement,
                    'reste_charge'  => $work->reste_charge,
                    'montant'       => $work->montant,
                    'comments'      => $work->comments,
                    'project_id'    => $project->id,
                ]);
            }else{
                Work::create([
                    'project_id' => $project->id,
                ]);
            }
            $trait = ProjectTrait::where('client_id', $client->id)->first();
            if($trait){ 
                $project_trait =new ProjectTrait();
                $project_trait->previsite = $trait->previsite;
                $project_trait->projet_valide = $trait->projet_valide;
                $project_trait->devis_signe = $trait->devis_signe;
                $project_trait->project_charge = $trait->project_charge;
                $project_trait->additional_work = $trait->additional_work;
                $project_trait->additional_work_payable = $trait->additional_work_payable;
                $project_trait->project_id = $project->id;
                $project_trait->user_id  = Auth::id();
                $project_trait->save();
            }else{ 
                ProjectTrait::create([
                    'project_id' => $project->id,
                ]);
            }
            $question = Question::where('client_id', $client->id)->first();
            if($question){ 
                Question::create([
                    'example_project'       => $question->example_project,
                    'question_cag'          => $question->question_cag,
                    'access_door'           => $question->access_door,
                    'boiler_room_size'      => $question->boiler_room_size,
                    'height'                => $question->height,
                    'boiler_location'       => $question->boiler_location,
                    'other'                 => $question->other,
                    'accessibility'         => $question->accessibility,
                    'other_question'        => $question->other_question,
                    'project_id'            => $project->id,
                ]);
            }else{
                Question::create([
                    'project_id' => $project->id,
                ]);
            }
 
            $client2 = SecondClient::where('client_id', $request->client_id)->first();

            if($client2){ 
                SecondProject::create([
                    'specify_heating'   => $client2->specify_heating,
                    'other_heating'     => $client2->other_heating,
                    'project_id'        => $project->id,
                ]);
            } 

            return redirect()->route('files.index' ,$project->id);
        }

        // Client Bulk Assign 
        public function clientBulkAssign(Request $request){
            // dd('asi ki');
            $client_id = explode(',', $request->client_id);
            $user_id = $request->user_id; 
            foreach($client_id as $id){  
                
                // $unassigns = ClientAssign::where('client_id', $id)->get();
                // if($unassigns->count() > 0){
                //      foreach($unassigns as $unassign){
                //         $unassign->delete();
                //      }
                // }  

        
            //    foreach($user_id as $user){
                // ClientAssign::create([
                //     'client_id'      => $id,
                //     'user_id'       => $user_id,
                //     // 'status'        => $status->status,
                //     'created_at'    => Carbon::now(),
                // ]);
 
                    $client = NewClient::find($id);

                    if($client){ 
                        if($client->client_telecommercial != $user_id){
                            $client->client_telecommercial = $user_id;
                            $client->save();

                            $pannel_activity = PannelLogActivity::create([
                                'key'           => 'telecommercial__change',
                                'value'         => $user_id,
                                'feature_id'    => $client->id,
                                'feature_type'  => 'client',
                                'user_id'       => Auth::id(), 
                            ]);
            
                            event(new PannelLog($pannel_activity->id));
    
                            $user = User::find($user_id);
                            $name = Auth::user()->name;
                            $subject = 'New Client Assign';
                            $body = $user->name.', un client vous a été attribué par '.$name;
                            if($user->email_professional){
                                Mail::to($user->email_professional)->send(new AssignMail($subject, $body));
                            }
                            $notification = Notifications::create([
                                'title'  => ['en' => 'Client Assign', 'fr' =>'Affectation des clients'],
                                'body'   => ['en' => ' You have been assigned a client by '.Auth::user()->name, 'fr' =>  ' un client vous a été attribué par '.Auth::user()->name],
                                'user_id' => $user_id, 
                                'client_id' => $id,
                            ]);
                        }
                    }
            }
    
            return back()->with('success', __('Client Assigned')); 
        }

        // Client Bulk Assign 
        public function clientSingleAssigne(Request $request){
 
 
            $client = NewClient::find($request->client_id); 
            if($client){ 
                $client->client_telecommercial = $request->user_id;
                $client->save();

                $user = User::find($request->user_id);
                $name = Auth::user()->name;
                $subject = 'New Client Assign';
                $body = $user->name.', un client vous a été attribué par '.$name;
                if($user->email_professional){
                    Mail::to($user->email_professional)->send(new AssignMail($subject, $body));
                }
                $notification = Notifications::create([
                    'title'  => ['en' => 'Client Assign', 'fr' =>'Affectation des clients'],
                    'body'   => ['en' => ' You have been assigned a client by '.Auth::user()->name, 'fr' =>  ' un client vous a été attribué par '.Auth::user()->name],
                    'user_id' => $request->user_id, 
                    'client_id' => $client->id,
                ]);
            }
    
            return back()->with('success', __('Client Assigned')); 
        }

        // Client Assignee
        public function clientsAssignee(Request $request){
            $client_id = $request->client_id;
            $users = User::all();
    
            $view = view('includes.crm.clientassign', compact('users', 'client_id'));
    
            $response = $view->render();
    
            return response()->json(['response' => $response]);
        }

        // Client Assign 
        public function clientAssign(Request $request){ 

            $client_id = $request->client_id;
            $user_id = $request->user_id;  
    
            $unassigns = clientAssign::where('client_id', $client_id)->get();
            if($unassigns->count() > 0){
                 foreach($unassigns as $unassign){
                    $unassign->delete();
                 }
            }  
    
        //    foreach($user_id as $id){
            clientAssign::create([
                'client_id'     => $client_id,
                'user_id'       => $user_id, 
                'created_at'    => Carbon::now(),
            ]);

            // if(checkNotificationStatus('client assign', $user_id)){
                $user = User::find($user_id);
                $name = Auth::user()->name;
                $subject = 'New Client Assign';
                $body = $user->name.', You have been assigned a client by '.$name;
                // Mail::to($user->email)->send(new AssignMail($subject, $body));
            // }

            $notification = Notifications::create([
                'title'  => ['en' => 'Client Assign', 'fr' =>'Affectation des clients'],
                'body'   => ['en' => 'You have been assigned a client by '.Auth::user()->name, 'fr' =>  'Vous avez été assigné à un client par '.Auth::user()->name],
                'user_id' => $user_id, 
                'client_id' => $client_id,
                ]);
        //    }
            return back()->with('success', __('Client Assigned')); 
        }

        // Client Delete 
        public function clientDelete(Request $request){
            NewClient::findOrFail($request->client_id)->update([
                'deleted_status'    => 1,
            ]);

            $notifications = Notifications::where('client_id', $request->client_id)->get();
            if($notifications->count() > 0){
                foreach($notifications as $notification){
                    $notification->delete();
                }
            }

            return redirect()->back()->with('success', __('Client Deleted Successfully'));
        }

        // Client Tracker Update 
        public function clientTrackerUpdate(Request $request){

            $client  = NewClient::find($request->client_id);
             
            $client->__tracking__Fournisseur_de_lead = $request->__tracking__Fournisseur_de_lead ?? null;
            $client->__tracking__Type_de_campagne = $request->__tracking__Type_de_campagne;
            $client->__tracking__Nom_campagne = $request->__tracking__Nom_campagne;
            $client->__tracking__Date_demande_lead = $request->__tracking__Date_demande_lead;
            $client->__tracking__Date_attribution_télécommercial = $request->__tracking__Date_attribution_télécommercial;
            $client->__tracking__Nom_Prénom = $request->__tracking__Nom_Prénom;
            $client->__tracking__Code_postal = $request->__tracking__Code_postal;
            $client->__tracking__Département = getDepartment2($request->__tracking__Code_postal);
            $client->__tracking__téléphone = $request->__tracking__téléphone;
            $client->__tracking__Mode_de_chauffage = $request->__tracking__Mode_de_chauffage;
            $client->__tracking__Propriétaire = $request->__tracking__Propriétaire;
            $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans = $request->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $client->__tracking__Email = $request->__tracking__Email;
            $client->__tracking__Type_de_campagne__a__ = $request->__tracking__Type_de_campagne__a__;
            $client->__tracking__Mode_de_chauffage__a__ = $request->__tracking__Mode_de_chauffage__a__;
            $client->__tracking__Type_de_travaux_souhaité = $request->__tracking__Type_de_travaux_souhaité;
            $client->save();


            foreach($client->getChanges() as $key => $value){
                if($key != 'updated_at'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Lead Tracking',
                        'block_name'    => 'Suivi des prospects (formulaire et réponse)',
                        'key'           => $key,
                        'value'         => $value, 
                        'feature_id'    => $request->client_id,
                        'feature_type'  => 'client',
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
                $client->lead_tracking_custom_field_data = $json;
                $client->save(); 
            }

            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.client-activity-log', compact('activities'));
            $activity = $activity_log->render();
            return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'department' => $client->__tracking__Département]); 
        }

    // client travaux update 
    public function clientTravauxUpdate(Request $request){
        $work = Work::where('client_id', $request->client_id)->first();
        if($work){
            $work->update($request->except('_token', 'client_id','travaux', 'product') + ['user_id' => Auth::id()]);
        }else{
            $work = Work::create($request->except('_token','travaux', 'product')+ ['user_id' => Auth::id()]);
        }
            $selected = '';
            $count = count($request->travaux);
            foreach($request->travaux as $key => $travaux)
            {
                $selected .= $travaux. ($count != $key+1 ? ',':'');
            } 
            $products = '';
            if($request->product){ 
                $count = count($request->product);
                foreach($request->product as $key => $product)
                {
                    $products .= $product. ($count != $key+1 ? ',':'');
                }  
                $work->product = $products;
            }
            $work->travaux = $selected;
            $work->save();  

        // $question = Question::where('client_id', $request->client_id)->first();
        $data = view('includes.crm.client_question', compact('work'));
        $question = $data->render();
        return response()->json(['alert' => __('Updated Successfully'), 'questions' => $question]);
    }

    // client question update 
    public function clientQuestionUpdate(Request $request){
        $data = Question::where('client_id', $request->client_id)->first();
        if($data){
            $data->update($request->except('_token', 'client_id') + ['user_id' => Auth::id()]); 
        }else{
            Question::create($request->except('_token') + ['user_id' => Auth::id()]);
        }

        return response()->json(['alert' => __('Updated Successfully')]); 
    }
    
    // client trait update 
    public function clientTraitUpdate(Request $request){
        $trait = ProjectTrait::where('client_id', $request->client_id)->first();
        if($trait){
            $trait->previsite = $request->previsite;
            $trait->projet_valide = $request->projet_valide;
            $trait->devis_signe = $request->devis_signe;
            $trait->project_charge = $request->project_charge;
            $trait->additional_work = $request->additional_work;
            $trait->additional_work_payable = $request->additional_work_payable;
            $trait->user_id  = Auth::id();
            $trait->save();  
        }else{
            ProjectTrait::create([
                'client_id'               => $request->client_id,
                'previsite'               => $request->previsite,
                'projet_valide'           => $request->projet_valide,
                'devis_signe'             => $request->devis_signe,
                'project_charge'          => $request->project_charge,
                'additional_work'         => $request->additional_work,
                'additional_work_payable' => $request->additional_work_payable,
                'user_id'                 => Auth::id(),
            ]);
        }

        return response()->json(['alert' => __('Updated Successfully')]);
    }

    public function clientTaxCustomUpdate(Request $request){

        $all_taxess = ClientTax::where('client_id', $request->client_id)->get();  
                
        $taxx =  ClientTax::create([
            'tax_number'        => $request->tax_number, 
            'tax_reference'     => $request->tax_reference, 
            'client_id'         => $request->client_id,  
            'type'              => 'manually', 
            'user_id'           => Auth::id(),
        ]);

        $client = NewClient::find($request->client_id);

        if($all_taxess->count() > 0) { 
            $taxx->primary = 'no'; 
                $taxx->save();  
            } 
        else{
            $taxx->primary = 'yes';
            $taxx->pays = $client->Revenue_Fiscale_de_Référence;
            $taxx->family_person = $client->Nombre_de_personnes;
            $taxx->save();   
            $client->user_id          = Auth::id();
            $client->save();
        } 

        $pannel_activity = PannelLogActivity::create([
            'tab_name'      => 'Client',
            'block_name'    => "Avis d'impôt",
            'key'           => "Numéro d'exercice",
            'value'         => $taxx->tax_number,
            'feature_id'    => $request->client_id,
            'feature_type'  => 'client',
            'user_id'       => Auth::id(), 
        ]);
        event(new PannelLog($pannel_activity->id));
        $pannel_activity = PannelLogActivity::create([
            'tab_name'      => 'Client',
            'block_name'    => "Avis d'impôt",
            'key'           => "Avis de référence",
            'value'         => $taxx->tax_reference,
            'feature_id'    => $request->client_id,
            'feature_type'  => 'client',
            'user_id'       => Auth::id(), 
        ]);
        event(new PannelLog($pannel_activity->id));

        $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render(); 

        $tax = ClientTax::where('client_id', $request->client_id)->orderBy('primary', 'asc')->get();
        $primary_tax = ClientTax::where('client_id', $request->client_id)->where('primary', 'yes')->first();
        $type = 'client_collapse_personal_information';
        $data = NewClient::find($request->client_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render(); 
        $all_taxes_data = view('includes.crm.client-tax', compact('tax'));
        $tax_all_data = $all_taxes_data->render();
        $all_taxes_data2 = view('includes.crm.client-tax-info', compact('tax'));
        $tax_all_data2 = $all_taxes_data2->render();
        return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'), 'primary'=> $taxx->primary, 'log' => $activity]);  
        
    }
    public function clientTaxCustomUpdate2(Request $request){

        $taxx = ClientTax::find($request->tax_id);  
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
                        'feature_id'    => $taxx->client_id,
                        'feature_type'  => 'client',
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
                        'feature_id'    => $taxx->client_id,
                        'feature_type'  => 'client',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            } 
            
    
            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $taxx->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
            $activity = $activity_log->render(); 
     
            return response()->json(['alert' => 'mise à jour des taxes avec succès', 'log' => $activity]);  
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        }
        
    }
    public function clientTaxCustomVerify(Request $request){

        $tax_number = $request->tax_number;
        $tax_reference = $request->tax_reference;

        $fiscal_response = Http::get("http://35.180.14.36:3003/api/scrap?numFiscal=$tax_number&reference=$tax_reference");   
  
        $response = json_decode($fiscal_response->getBody()->getContents()); 
        $response_errors = [0 => "Quelque chose s'est mal passé !! Réessayez plus tard.", 2 => "La référence de l’avis ne correspond à celle du dernier avis connu pour cet usager", 3 => "Vous devez vérifier les identifiants saisis. Il peut s'agir d'une erreur de saisie ou ces identifiants ne correspondent pas à un avis."];
        if($response->status != 1){
            return response()->json(['error' => $response_errors[$response->status]]);
        }else{ 
            $all_taxess = ClientTax::where('client_id', $request->client_id)->get();  
                 
            $taxx =  ClientTax::create([
                'tax_number'        => $request->tax_number, 
                'tax_reference'     => $request->tax_reference, 
                'client_id'         => $request->client_id,  
                'type'              => 'manually', 
                'user_id'           => Auth::id(),
            ]);
    
            $client = Client::find($request->client_id);
    
            if($all_taxess->count() > 0) { 
                $taxx->primary = 'no'; 
                    $taxx->save();  
                } 
            else{
                $taxx->primary = 'yes';
                $taxx->pays = $client->Revenue_Fiscale_de_Référence;
                $taxx->family_person = $client->Nombre_de_personnes;
                $taxx->save();   
                $client->user_id          = Auth::id();
                $client->save();
            } 
    
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Numéro d'exercice",
                'value'         => $taxx->tax_number,
                'feature_id'    => $request->client_id,
                'feature_type'  => 'client',
                'user_id'       => Auth::id(), 
            ]);
            event(new PannelLog($pannel_activity->id));
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Avis de référence",
                'value'         => $taxx->tax_reference,
                'feature_id'    => $request->client_id,
                'feature_type'  => 'client',
                'user_id'       => Auth::id(), 
            ]);
            event(new PannelLog($pannel_activity->id));
    
            $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->client_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
            $activity = $activity_log->render(); 
    
            $tax = ClientTax::where('client_id', $request->client_id)->orderBy('primary', 'asc')->get();
            $primary_tax = ClientTax::where('client_id', $request->client_id)->where('primary', 'yes')->first();
            $type = 'client_collapse_personal_information';
            $data = NewClient::find($request->client_id);
            $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
            $tax_all = $all_taxes->render(); 
            $all_taxes_data = view('includes.crm.client-tax', compact('tax'));
            $tax_all_data = $all_taxes_data->render();
            $all_taxes_data2 = view('includes.crm.client-tax-info', compact('tax'));
            $tax_all_data2 = $all_taxes_data2->render();
            return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => "La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné", 'primary'=> $taxx->primary, 'log' => $activity]);  
        }
    }

    public function clientTaxCustomVerify2(Request $request){

        $taxx = ClientTax::find($request->tax_id); 
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
                            'feature_id'    => $taxx->client_id,
                            'feature_type'  => 'client',
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
                            'feature_id'    => $taxx->client_id,
                            'feature_type'  => 'client',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                }  
        
                $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $taxx->client_id)->orderBy('id', 'desc')->get();
                $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
                $activity = $activity_log->render();  

                return response()->json(['alert' => 'La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné', 'log' => $activity]);
            } 
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        } 
    }
    

    public function clientCreateStatus(Request $request){
        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
 
        ClientTableStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Added Successfully'));
    }
        
    public function clientDeleteStatus(Request $request){
        $projects = Client::where('user_status', $request->project_status_id)->get();
        if($projects->count() > 0){
            foreach($projects as $project){
                $project->user_status = '';
                $project->save();
            }
        }
        ClientTableStatus::find($request->project_status_id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    public function clientUserStatusChange(Request $request){
        $project = Client::findOrFail($request->project_id);
        $project->user_status = $request->project_status_id; 
        $project->save();

        return redirect()->back()->with('success', __('Status Updated'));
    }

    public function clientUpdateStatus(Request $request){
        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
        ClientTableStatus::find($request->status_id)->update($request->except('_token', 'status_id'));
        // LeadStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Updated Successfully'));
    }

    public function clientTaxMarkCheck(Request $request){
        
        $taxe = ClientTax::find($request->tax_id); 
        $taxe->update([
            'mark_check' => $request->data,
        ]);
        $client = NewClient::find($request->client_id);
        $tax = ClientTax::where('client_id', $request->client_id)->get(); 
        $primary_tax = ClientTax::where('client_id', $request->client_id)->where('primary', 'yes')->first(); 
        $fiscal_amount = ClientTax::where('client_id', $request->client_id)->where('mark_check', 'yes')->sum('pays'); 
        $family_person = ClientTax::where('client_id', $request->client_id)->where('mark_check', 'yes')->sum('family_person');
        if($client->precariousness_year == '2023'){
            if($primary_tax->same_as_work_address == 'no'){
                $client->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $client->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,  
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }
        }else{
            if($primary_tax->same_as_work_address == 'no'){
                $client->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $client->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,  
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }  
        }
        $type = 'client_collapse_personal_information';
        $data = NewClient::find($request->client_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render();  
	
        return response()->json(['taxes' => $tax_all, 'alert' => __('Updated Successfully'), 'fiscal_amount' => $fiscal_amount, 'family_person' => $family_person, 'precariousness' => $client->precariousness]);
    }

    public function clientCommentStore(Request $request){ 
        $comment = ClientComment::create( [
            'client_id' => $request->client_id,
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
                ClientCommentFile::create(['comment_id' => $comment->id, 'name' => $file_name, 'type' => $file_type]);
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

       $client = NewClient::find($request->client_id);
       $client_id = sprintf('%08d', $client->id);
       $client_nom = $client->Nom ?? '';
       $client_prenom = $client->Prenom ?? '';
       $link = route('client.lead.update', $client->id);

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
                 <p style='text-align: center; font-size:18px margin-top:10px; margin-bottom: 0'>".Auth::user()->name." vous a mentionné dans un client</p>";
       $body = "<tr><td><h3 style='font-weight: 500; margin: 5px 0;'>Informations client:</h3></td></tr>
                <tr><td><p style='margin: 5px 0;'><strong>Id :</strong> BH$client_id </p>
                <p style='margin: 5px 0;'><strong>Nom :</strong> $client_nom </p>
                <p style='margin: 5px 0;'><strong>Prénom :</strong> $client_prenom </p>
                <p style='margin: 5px 0;'><strong>Type :</strong> Client </p>
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
            $comments = ClientComment::where('client_id', $request->client_id)->orderBy('id', 'desc')->get(); 
        }else{
            $comments = ClientComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('client_id', $request->client_id)->orderBy('id', 'desc')->get(); 
        }
        $type = 'client';
        $comment = view('includes.crm.project_comment', compact('comments', 'type', 'client'))->render();
        return response()->json(['comment' => $comment, 'alert' => __('Added Succesfully')]);
    }

    public function clientLockAccess(Request $request){
       
        $pannel_activity = PannelLogActivity::create($request->except(['_token','tab'])+['user_id' => Auth::id()]);
        event(new PannelLog($pannel_activity->id));
        if($request->value == 'open'){
            Session::put($request->tab, 'active');
        }else{
            Session::forget($request->tab);
        }
        $activities = PannelLogActivity::where('feature_type', 'client')->where('feature_id', $request->feature_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.client-activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response($activity);
    }

    public function clientLogDelete(Request $request){
        PannelLogActivity::find($request->id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }
        
    public function clientTaxRemove(Request $request){

        $tax = ClientTax::find($request->tax_id);
        if($tax->primary == 'yes'){
            return redirect()->back()->with('error', __('This is primary Tax, Please another one'))->with('client_active', 'tax tab ko active');
        }else{
            $tax->delete();
            return redirect()->back()->with('success', __('Tax remove successfully'))->with('client_active', 'tax tab ko active');
        }
    }

    public function clientCallbackSetting(Request $request){
        $client = NewClient::find($request->id);
        if($client){
            $client->update([
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
                 'feature_id'    => $client->id,
                 'feature_type'  => 'client',
                 'user_id'       => Auth::id(), 
             ]); 
     
             event(new PannelLog($pannel_activity->id));
     
             return back()->with(__("Updated Succesfully"));
        }else{
            return back();
        } 
    }

    public function clientStatusChange(Request $request){
        $client = NewClient::find($request->id)->update([
            'sub_status' => $request->sub_status,
        ]);
        return back()->with('success', 'Statut mis à jour');
    }

    public function clientFiscalStatusChange(Request $request){
        ClientTax::find($request->tax_id)->update([
            $request->field => $request->status,
        ]);

        return response('Mise à jour réussie');
    
    }

    public function clientSimilarFile($id){
        $client = NewClient::find($id);
        if($client && $client->deleted_status == 0  && ($client->Nom || $client->Adresse || $client->phone)){
            $clients = NewClient::where('deleted_status', 0)->where(function($query) use($client){
                if($client->Nom && $client->Adresse && $client->phone){
                    $query->where('Nom', $client->Nom)->orWhere('Adresse', $client->Adresse)->orWhere('phone', $client->phone);
                }elseif($client->Nom && $client->Adresse){
                    $query->where('Nom', $client->Nom)->orWhere('Adresse', $client->Adresse);
                }elseif($client->Nom && $client->phone){
                    $query->where('Nom', $client->Nom)->orWhere('phone', $client->phone);
                }elseif($client->Adresse && $client->phone){
                    $query->where('Adresse', $client->Adresse)->orWhere('phone', $client->phone);
                }elseif($client->Nom){
                    $query->where('Nom', $client->Nom);
                }elseif($client->Adresse){
                    $query->where('Adresse', $client->Adresse);
                }elseif($client->phone){
                    $query->where('phone', $client->phone);
                }
            })->get(); 
            return view('admin.client-similar-file', compact('clients'));       
        }
        // $primary_tax = ClientTax::find($tax_id);
        // if($primary_tax->getClient && $primary_tax->getClient->deleted_status == 0){
        //     $similar_tax = ClientTax::whereIn('id', checkClientDuplicateEntry($primary_tax))->get();
        //     return view('admin.client-similar-file', compact('primary_tax', 'similar_tax'));       
        // }
        return redirect()->route('clients.index');
    }

    public function clientToProject(Request $request){
        $client = NewClient::find($request->client_id); 
        
        $project = new NewProject();

        $project->user_id                                                           = Auth::id();
        $project->lead_id                                                           = $client->lead_id;
        $project->client_id                                                         = $client->id;
        $project->company_id                                                        = $client->company_id;
        $project->lead_telecommercial                                               = $client->lead_telecommercial;
        $project->project_label                                                     = 1;
        // $project->project_sub_status                                                = 5;
        $project->project_telecommercial                                            = $request->user_id; 
        $project->project_gestionnaire                                              = $request->gestionnaire_id;  
        $project->__tracking__Fournisseur_de_lead                                   = $client->__tracking__Fournisseur_de_lead;
        $project->__tracking__Type_de_campagne                                      = $client->__tracking__Type_de_campagne;
        $project->__tracking__Type_de_campagne__a__                                 = $client->__tracking__Type_de_campagne__a__;
        $project->__tracking__Nom_campagne                                          = $client->__tracking__Nom_campagne;
        $project->__tracking__Date_demande_lead                                     = $client->__tracking__Date_demande_lead;
        $project->__tracking__Date_attribution_télécommercial                       = $client->__tracking__Date_attribution_télécommercial;
        $project->__tracking__Type_de_travaux_souhaité                              = $client->__tracking__Type_de_travaux_souhaité;
        $project->__tracking__Nom_Prénom                                            = $client->__tracking__Nom_Prénom;
        $project->__tracking__Code_postal                                           = $client->__tracking__Code_postal;
        $project->__tracking__Email                                                 = $client->__tracking__Email;
        $project->__tracking__téléphone                                             = $client->__tracking__téléphone;
        $project->__tracking__Département                                           = $client->__tracking__Département;
        $project->__tracking__Mode_de_chauffage                                     = $client->__tracking__Mode_de_chauffage;
        $project->__tracking__Mode_de_chauffage__a__                                = $client->__tracking__Mode_de_chauffage__a__;
        $project->__tracking__Propriétaire                                          = $client->__tracking__Propriétaire;
        $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans        = $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
        $project->Titre                                                             = $client->Titre;
        $project->Prenom                                                            = $client->Prenom;
        $project->Nom                                                               = $client->Nom;
        $project->Adresse                                                           = $client->Adresse;
        $project->Complément_adresse                                                = $client->Complément_adresse;
        $project->Code_Postal                                                       = $client->Code_Postal;
        $project->Ville                                                             = $client->Ville;
        $project->Département                                                       = $client->Département;
        $project->Email                                                             = $client->Email;
        $project->same_as_work_address                                              = $client->same_as_work_address;
        $project->Adresse_Travaux                                                   = $client->Adresse_Travaux;
        $project->Complément_adresse_Travaux                                        = $client->Complément_adresse_Travaux;
        $project->Code_postal_Travaux                                               = $client->Code_postal_Travaux;
        $project->Ville_Travaux                                                     = $client->Ville_Travaux;
        $project->Departement_Travaux                                               = $client->Departement_Travaux;
        $project->phone                                                             = $client->phone;
        $project->fixed_number                                                      = $client->fixed_number;
        $project->Observations                                                      = $client->Observations;
        $project->precariousness                                                    = $client->precariousness;
        $project->Type_occupation                                                   = $client->Type_occupation;
        $project->Parcelle_cadastrale                                               = $client->Parcelle_cadastrale;
        $project->Revenue_Fiscale_de_Référence                                      = $client->Revenue_Fiscale_de_Référence;
        $project->Nombre_de_foyer                                                   = $client->Nombre_de_foyer;
        $project->Nombre_de_personnes                                               = $client->Nombre_de_personnes;
        $project->Age_du_bâtiment                                                   = $client->Age_du_bâtiment;
        $project->Zone                                                              = $client->Zone;
        $project->Éligibilité_MaPrimeRenov                                          = $client->Éligibilité_MaPrimeRenov;
        $project->Mode_de_chauffage                                                 = $client->Mode_de_chauffage;
        $project->Mode_de_chauffage__a__                                            = $client->Mode_de_chauffage__a__;
        $project->Date_construction_maison                                          = $client->Date_construction_maison;
        $project->Surface_habitable                                                 = $client->Surface_habitable;
        $project->Surface_à_chauffer                                                = $client->Surface_à_chauffer;
        $project->Consommation_chauffage_annuel                                     = $client->Consommation_chauffage_annuel;
        $project->Consommation_Chauffage_Annuel_2                                   = $client->Consommation_Chauffage_Annuel_2;
        $project->Depuis_quand_occupez_vous_le_logement                             = $client->Depuis_quand_occupez_vous_le_logement;
        $project->Type_du_courant_du_logement                                       = $client->Type_du_courant_du_logement;
        $project->auxiliary_heating_status                                          = $client->auxiliary_heating_status;
        $project->auxiliary_heating                                                 = $client->auxiliary_heating;
        $project->auxiliary_heating__a__                                            = $client->auxiliary_heating__a__;
        $project->second_heating_generator_status                                   = $client->second_heating_generator_status;
        $project->second_heating_generator                                          = $client->second_heating_generator;
        $project->second_heating_generator__a__                                     = $client->second_heating_generator__a__;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement        = $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__   = $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
        $project->Préciser_le_type_de_radiateurs_Aluminium                          = $client->Préciser_le_type_de_radiateurs_Aluminium;
        $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs     = $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Fonte                              = $client->Préciser_le_type_de_radiateurs_Fonte;
        $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs         = $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Acier                              = $client->Préciser_le_type_de_radiateurs_Acier;
        $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs         = $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre                              = $client->Préciser_le_type_de_radiateurs_Autre;
        $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs         = $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre___a__                        = $client->Préciser_le_type_de_radiateurs_Autre___a__;
        $project->Production_dapostropheeau_chaude_sanitaire                        = $client->Production_dapostropheeau_chaude_sanitaire;
        $project->Instantanné                                                       = $client->Instantanné;
        $project->Accumulation                                                      = $client->Accumulation;
        $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude    = $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
        $project->Instantanné_Merci_de_préciser                                     = $client->Instantanné_Merci_de_préciser;
        $project->Accumulation_Merci_de_préciser                                    = $client->Accumulation_Merci_de_préciser;
        $project->Le_logement_possède_un_réseau_hydraulique                         = $client->Le_logement_possède_un_réseau_hydraulique;
        $project->auxiliary_heating__Insert_à_bois_Nombre                         = $client->auxiliary_heating__Insert_à_bois_Nombre;
        $project->auxiliary_heating__Poêle_à_bois_Nombre                         = $client->auxiliary_heating__Poêle_à_bois_Nombre;
        $project->auxiliary_heating__Poêle_à_gaz_Nombre                         = $client->auxiliary_heating__Poêle_à_gaz_Nombre;
        $project->auxiliary_heating__Convecteur_électrique_Nombre                         = $client->auxiliary_heating__Convecteur_électrique_Nombre;
        $project->auxiliary_heating__Sèche_serviette_Nombre                         = $client->auxiliary_heating__Sèche_serviette_Nombre;
        $project->auxiliary_heating__Panneau_rayonnant_Nombre                         = $client->auxiliary_heating__Panneau_rayonnant_Nombre;
        $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                         = $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
        $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                         = $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
        $project->auxiliary_heating__Autre_Nombre                         = $client->auxiliary_heating__Autre_Nombre;
        $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude                = $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
        $project->Information_logement_observations                                 = $client->Information_logement_observations;
        $project->Situation_familiale                                               = $client->Situation_familiale;
        $project->Situation_familiale___a__                                         = $client->Situation_familiale___a__;
        $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                        = $client->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
        $project->Personne_1                                                        = $client->Personne_1;
        $project->Quel_est_le_contrat_de_travail_de_Personne_1                      = $client->Quel_est_le_contrat_de_travail_de_Personne_1;
        $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__                 = $client->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
        $project->Revenue_Personne_1                                                = $client->Revenue_Personne_1;
        $project->Existehyphenthyphenil_un_conjoint                                 = $client->Existehyphenthyphenil_un_conjoint;
        $project->Personne_2                                                        = $client->Personne_2;
        $project->Quel_est_le_contrat_de_travail_de_Personne_2                      = $client->Quel_est_le_contrat_de_travail_de_Personne_2;
        $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__                 = $client->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
        $project->Revenue_Personne_2                                                = $client->Revenue_Personne_2;
        $project->Crédit_du_foyer_mensuel                                           = $client->Crédit_du_foyer_mensuel;
        $project->Commentaires_revenue_et_crédit_du_foyer                           = $client->Commentaires_revenue_et_crédit_du_foyer;   
        $project->Type_de_contrat                                                   = $request->Type_de_contrat;
        $project->MaPrimeRenov                                                      = $request->MaPrimeRenov ? 'yes':'no';
        $project->Subvention_MaPrimeRénov_déduit_du_devis                           = $request->Subvention_MaPrimeRénov_déduit_du_devis;
        $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $request->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
        $project->Action_Logement                                                   = $request->Action_Logement ? 'yes':'no';
        $project->CEE                                                               = $request->CEE ? 'yes':'no';
        $project->Montant_estimée_de_lapostropheaide                                = $request->Montant_estimée_de_lapostropheaide; 
        $project->Credit                                                            = $request->Credit ? 'yes':'no';
        $project->Montant_Crédit                                                    = $request->Montant_Crédit;
        $project->Report_du_crédit                                                  = $request->Report_du_crédit ? 'yes':'no';
        $project->Nombre_de_jours_report                                            = $request->Nombre_de_jours_report;
        $project->Reste_à_charge                                                    = $request->Reste_à_charge ? 'yes':'no';
        $project->Reste_à_charge_Montant                                            = $request->Reste_à_charge_Montant;
        $project->Survente                                                          = $request->Survente;
        $project->Montant_survente                                                  = $request->Montant_survente;
        $project->Observations_reste_à_charge                                       = $request->Observations_reste_à_charge;
        $project->Mode_de_paiement                                                  = $request->Mode_de_paiement;
        $project->Nombre_de_mensualités                                             = $request->Nombre_de_mensualités;
        $project->advance_visit                                                      = $request->advance_visit; 
        $project->Projet_observations                                               = $request->Projet_observations; 
    
        $project->latitude                                                          = $client->latitude;
        $project->longitude                                                         = $client->longitude;

        $project->lead_tracking_custom_field_data                                    = $client->lead_tracking_custom_field_data;
        $project->personal_info_custom_field_data                                    = $client->personal_info_custom_field_data; 
        $project->eligibility_custom_field_data                                      = $client->eligibility_custom_field_data;
        $project->situation_foyer_custom_field_data                                  = $client->situation_foyer_custom_field_data;
        $project->project_custom_field_data                                          = $client->project_custom_field_data;
        $project->Type_habitation                                                    = $client->Type_habitation;
        $project->Type_de_logement                                                   = $client->Type_de_logement;
        $project->Type_de_chauffage                                                  = $client->Type_de_chauffage;

        $project->save();

        if($request->bareme && $request->travaux){
            $travaux_list = array_merge($request->bareme,$request->travaux);
        }else if($request->travaux){
            $travaux_list = $request->bareme;
        }
        else{
            $travaux_list = $request->bareme;
        }
        // if($request->bareme && in_array(7, $request->bareme)){
            $project->ProjectTravauxTags()->sync($travaux_list);  

        // }else{
        //     $project->ProjectTravauxTags()->sync($request->bareme);
            // if($request->bareme){
            //     foreach($request->bareme as $tag){
            //         $tag_item = ProjectTag::create([
            //             'project_id'    => $project->id,
            //             'tag_id'        => $tag, 
            //             'surface'       => $request->surface[$tag] ?? '', 
            //             'Nombre_de_split'  => $request->Nombre_de_split[$tag] ?? '',
            //             'Type_de_comble'  => $request->Type_de_comble[$tag] ?? '',
            //         ]);
    
            //         if($request->tag_product && isset($request->tag_product[$tag])){
            //             foreach($request->tag_product[$tag] as $product_id){
            //                 ProjectTagProduct::create([
            //                     'project_id'    => $project->id,
            //                     'tag_id'        => $tag_item->id,
            //                     'product_id'    => $product_id,
            //                 ]);
            //             }
            //         }
            //     }
            // }
        // }
        if($travaux_list){
            foreach($travaux_list as $tag){
                $tag_item = ProjectTag::create([
                    'project_id'    => $project->id,
                    'tag_id'        => $tag, 
                    'surface'       => $request->surface[$tag] ?? '',  
                    'Nombre_de_split'  => $request->Nombre_de_split[$tag] ?? '',
                    'Type_de_comble'  => $request->Type_de_comble[$tag] ?? '',
                    'marque'  => $request->marque[$tag] ?? null,
                    'shab'  => $request->shab[$tag] ?? null,
                    'Nombre_de_pièces_dans_le_logement'  => $request->Nombre_de_pièces_dans_le_logement[$tag] ?? null,
                    'Type_de_radiateur'  => $request->Type_de_radiateur[$tag] ?? null,
                    'Nombre_de_radiateurs_électrique'  => $request->Nombre_de_radiateurs_électrique[$tag] ?? null,
                    'Nombre_de_radiateurs_combustible'  => $request->Nombre_de_radiateurs_combustible[$tag] ?? null,
                    'Nombre_de_radiateur_total_dans_le_logement'  => $request->Nombre_de_radiateur_total_dans_le_logement[$tag] ?? null,
                    'Thermostat_supplémentaire'  => $request->Thermostat_supplémentaire[$tag] ?? null,
                    'Nombre_thermostat_supplémentaire'  => $request->Nombre_thermostat_supplémentaire[$tag] ?? null,
                ]);
    
                if($request->tag_product && isset($request->tag_product[$tag])){
                    foreach($request->tag_product[$tag] as $product_id){
                        ProjectTagProduct::create([
                            'project_id'    => $project->id,
                            'tag_id'        => $tag_item->id,
                            'product_id'    => $product_id,
                        ]);
                    }
                }
            }
        }
        $project->ProjectBareme()->sync($request->bareme);
        $project->ProjectTravaux()->sync($travaux_list);

        if($request->tag_product_nombre){
            foreach($request->tag_product_nombre as $key => $value){
                $tag_product = explode('__', $key);
                ProjectProductNombre::create([
                    'project_id' => $project->id,
                    'tag_id' => $tag_product[0] ?? 0,
                    'product_id' => $tag_product[1] ?? 0,
                    'number' => $value,
                ]);
            }
        }


            $taxs = ClientTax::where('client_id', $client->id)->get();
            foreach($taxs as $tax){ 
                ProjectTax::create([
                    'project_id' => $project->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
            }

            $childrens = Children::where('client_id', $client->id)->get(); 
            foreach($childrens as $children){ 
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'project_id'    =>$project->id, 
                ]);
            } 
             
            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Project Create'; 
            $body = 'A new project have been created by '.$name; 
            if($user->email_professional){
                Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

           $notification = Notifications::create([
            'title'  => ['en' => 'Project Create', 'fr' =>'Créer un projet'],
            'body'   => ['en' => 'A new project have been created by '. Auth::user()->name, 'fr' => 'Un nouveau projet a été créé par '. Auth::user()->name],
            'user_id' => 1,
            'project_id' => $project->id,
            ]); 
 
        return redirect()->route('files.index', $project->id)->with('success', 'Nouveau projet créé avec succès');
    }

    public function clientFiscalInfoUpdate(Request $request){
        ClientTax::find($request->tax_id)->update([
            'Existe_déclarant_number' => $request->value,
        ]);

        return response('Mise à jour réussie');
    }

    public function clientCustomField(Request $request){
        $inputs = ClientCustomField::where('collapse_name', $request->collapse)->get();
        $view = view('admin.lead_custom_field_input_list', compact('inputs'))->render();
        return response($view);
    }

    public function clientCustomFieldDelete(Request $request){
        $field = ClientCustomField::find($request->input_id);
        if($field){
            $field->delete();
        }
        return back()->with('success',  __('Delete Succesfully'));
    }

    public function clientCustomFieldStore(Request $request){
        ClientCustomField::create([ 
            'collapse_name' => $request->collapse_name,
            'title' => $request->title,
            'name' => Str::snake($request->title, '_'),
            'input_type' => $request->input_type,
            'required' => 'no',
            'options' => $request->options,
        ]);
        return back()->with('success', __('Added Succesfully'))->with('custom_field_tab_active', '1');
    }

    public function clientBulkDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $client_id = explode(',', $request->client_id); 
        foreach($client_id as $id){  
            NewClient::findOrFail($id)->update([
                'deleted_status'    => 1,
            ]);
            Notifications::where('client_id', $id)->get()->each->delete();         
        } 
        return redirect()->back()->with('success', __('Client Deleted Successfully'));

    }

    

    public function clientTaxDeclarantUpdate(Request $request){ 
        $client_tax = ClientTax::find($request->tax_id);
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

    public function clientBaremeValidate(Request $request){
        $client = NewProject::find($request->client_id); 
                
        return response()->json(['maprime' =>MaPrimeRenovEstimatedAmount($client->Mode_de_chauffage, $client->precariousness, $request->value), 'cee' => CEEEstimatedAmount($client->Mode_de_chauffage, $client->precariousness, $request->value)]);
    }


    public function clientDefaultModalRender(){
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
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
        $headers = ClientHeader::all();
        $filter_status = ClientHeaderFilter::where('user_id', Auth::id())->orderBy('client_header_id', 'asc')->get();
        $default_filters = DefaultHeaderFilter::with('getClientHeader')->get();
        $view = view('admin.client_default_modal', compact('telecommercials', 'headers', 'filter_status', 'default_filters'))->render();
         return response($view);
    }

    public function clientEditDefaultModalRender(Request $request){
        $client = NewClient::find($request->id);
        $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        $administrarif_role_id  = Role::where('category_id', '3')->pluck('id');
        $gestionnaires = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
        $primary_tax = ClientTax::where('client_id', $request->id)->where('primary', 'yes')->first();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();  
        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
        $view = view('admin.client_edit_default_modal', compact('client', 'telecommercials','gestionnaires', 'primary_tax', 'bareme_travaux_tags', 'marques'))->render();
         return response($view); 
    }

    public function clientCommentDelete(Request $request){
        if(role() != 's_admin'){
            return back()->with('error', "Vous n'avez pas accès pour supprimer ceci");
        }
        $comment = ClientComment::find($request->id);
        if($comment){
            $comment->delete();
        }
        return back()->with('success', __('Deleted Succesfully'));
    }
    
    public function clientCommentPin(Request $request){ 

        $client = NewClient::find($request->client_id);

        $client->allCommecnts->each->update([
            'pin_status' => 0,
        ]);

        $comment = ClientComment::find($request->id);
        $comment->update([
            'pin_status' => 1,
        ]);

        $pannel_activity = PannelLogActivity::create([
            'key'           => 'comment_pin_status__change',
            'value'         => $comment->comment,
            'feature_id'    => $client->id,
            'feature_type'  => 'client',
            'user_id'       => Auth::id(), 
        ]);

        event(new PannelLog($pannel_activity->id));

        return back()->with('success', 'Épingle de commentaire mise à jour avec succès');
        
    
    }

    public function clientSingleDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        } 
        $client = NewClient::find($request->id);
        if($client){
            $client->update([
                'deleted_status'    => 1,
            ]);
            Notifications::where('client_id', $request->id)->get()->each->delete();          
        }

        return redirect()->back()->with('success', __('Client Deleted Successfully'));

    }
    //END
}
