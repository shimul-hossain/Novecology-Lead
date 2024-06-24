<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CRM\Agent;
use App\Models\CRM\Amo;
use App\Models\CRM\Area;
use App\Models\CRM\Auditor;
use App\Models\CRM\AuditStatus;
use App\Models\CRM\Banque;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\BarthPrice;
use App\Models\CRM\Benefit;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\Category;
use App\Models\CRM\ClientCompany;
use App\Models\CRM\ClientSubStatus;
use App\Models\CRM\CommentCategory;
use App\Models\CRM\CommercialTerrain;
use App\Models\CRM\Control;
use App\Models\CRM\Deal;
use App\Models\CRM\Delegate;
use App\Models\CRM\DocumentControl;
use App\Models\CRM\Entreprise;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\FournisseurType;
use App\Models\CRM\HeatingMode;
use App\Models\CRM\Installer;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\MandataireMaprimerenov;
use App\Models\CRM\NotionCategory;
use App\Models\CRM\NotionSubCategory;
use App\Models\CRM\Product;
use App\Models\CRM\ProjectControlPhoto;
use App\Models\CRM\ProjectDeadReason;
use App\Models\CRM\ProjectReflectionReason;
use App\Models\CRM\ProjectSubStatus;
use App\Models\CRM\QualityControlType;
use App\Models\CRM\Regie;
use App\Models\CRM\RejectReason;
use App\Models\CRM\ReportResult;
use App\Models\CRM\Role;
use App\Models\CRM\Scale;
use App\Models\CRM\StatusPlanningIntervention;
use App\Models\CRM\StatusPlanningStudy;
use App\Models\CRM\StatutMaprimerenov;
use App\Models\CRM\StudyOffice;
use App\Models\CRM\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CRM\Tag;
use App\Models\CRM\TechnicalReferee;
use App\Models\CRM\TravauxTag;
use App\Models\CRM\TravauxList;

class ProfileController extends Controller
{

    public function index(){
       
        $benefits = Benefit::all();
            $user = User::where('id', Auth::id())->first();
        
        return view('admin.settings.profile', compact('user', 'benefits'));
    }
    // public function index(){
        
    //     $delegates = Delegate::all();
    //     $scales = Scale::where('deleted_status', 'no')->get();
    //     $deals = Deal::all();
    //     $installers = Installer::all();
    //     $amos = Amo::all();
    //     $agents = Agent::all();
    //     $auditors = Auditor::all();
    //     $areas = Area::all();
    //     $controls = Control::all();
    //     $brands = Brand::all();
    //     $benefits = Benefit::all();
    //     $fournessers = Fournisseur::all();
    //     $client_companies = ClientCompany::all();
    //     $user = User::where('id', Auth::id())->first();
    //     $categories = Category::all();
    //     $subcategories = Subcategory::all(); 
    //     $products = Product::latest()->get();
    //     $regies = Regie::all();
    //     $tags = TravauxTag::all();
    //     $travaux_list = TravauxList::all(); 
    //     $document_controls = DocumentControl::orderBy('order', 'asc')->get();
    //     $banques = Banque::all(); 
    //     $all_audit_status = AuditStatus::all();
    //     $all_report_result = ReportResult::all();
    //     $commercial_terrain = CommercialTerrain::all();
    //     $all_status_planning_study = StatusPlanningStudy::all();
    //     $comment_categories = CommentCategory::all();
    //     $quality_controls = QualityControlType::all();
    //     $responsable_commercials = User::where('deleted_status', 'no')->where('role_id', 7)->get();
    //     $notion_categories = NotionCategory::orderBy('order', 'asc')->get();
    //     $lead_sub_statuses = LeadSubStatus::orderBy('order', 'asc')->get();
        
    //     $client_sub_statuses = ClientSubStatus::all();
    //     $heatings = HeatingMode::all();
    //     $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
    //     $campagnes = Campagnetype::all();
    //     $status_interventions = StatusPlanningIntervention::all(); 
    //     $project_ko_reasons = ProjectDeadReason::all();
    //     $project_reflection_reasons = ProjectReflectionReason::all();
    //     $project_control_photos = ProjectControlPhoto::all();
    //     $statut_maprimerenovs = StatutMaprimerenov::orderBy('order', 'asc')->get();
    //     $mandataire_maprimerenovs = MandataireMaprimerenov::all();
    //     $notion_subcategories = NotionSubCategory::orderBy('order', 'asc')->get(); 
    //     $reject_reasons = RejectReason::all(); 
    //     $colored_role = Role::where('category_id', '1')->pluck('id')->toArray();
    //     $color_users = User::whereIn('role_id', $colored_role)->where('deleted_status', 'no')->get();
    //     $type_fournisseurs = FournisseurType::all();
    //     $barth_prices = BarthPrice::all();
    //     $technical_referees = TechnicalReferee::all();
         
        

    //     $users = User::where('deleted_status', 'no')->get();
    //     return view('admin.profile', compact('user', 'scales', 'delegates', 'deals', 'installers', 'amos', 'agents', 'auditors', 'areas','controls', 'brands', 'benefits','fournessers', 'client_companies', 'categories', 'subcategories', 'products', 'regies', 'users', 'tags', 'travaux_list', 'document_controls', 'banques', 'all_audit_status', 'all_report_result', 'commercial_terrain', 'all_status_planning_study', 'comment_categories', 'quality_controls', 'responsable_commercials', 'notion_categories', 'lead_sub_statuses', 'heatings', 'bareme_travaux_tags', 'campagnes', 'project_sub_statuses', 'client_sub_statuses', 'status_interventions', 'project_ko_reasons', 'project_reflection_reasons', 'project_control_photos', 'statut_maprimerenovs', 'mandataire_maprimerenovs', 'notion_subcategories', 'reject_reasons', 'color_users', 'type_fournisseurs', 'barth_prices','technical_referees'));
    // }

    // update profile 
    public function updateProfile(Request $request){
 
        $request->validate([
            'image'     =>'image|mimes:jpg,jpeg,png|max:800',
            // 'userName'  => 'required|unique:users,username,'.$request->id,
            // 'first_name'      => 'required',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->id,
            // 'company'   => 'required',
        ],[
            'image.image'       => __('The image must be an image'),
            'image.mimes'       => __('The image must be a file of type: jpg,jpeg,png'),
            'image.max'         => __('The image must not be greater than 800 kilobytes.'),
            // 'first_name.required' => __('First name is required'),
            // 'userName.unique'   => __('This user name is already exist'),
            'name.required'     => __('Name is required'),
            'email.required'    => __('Email is required'),
            'email.email'       => __('The email must be a valid email address.'),
            'email.unique'      => __('This email is already exist'),
        ]); 

        $user = User::findOrFail($request->id); 

        if($request->file('image')){
            $image = $request->file('image');
            $fileName = $user->id. '.' .$image->extension('image');
            $location = public_path('uploads/crm/profiles');
            $image->move($location, $fileName);
            $user->profile_photo = $fileName;
            $user->save();
        }

        $user->username = $request->userName;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->company  = $request->company;
        $user->save();


        return back()->with('success', __('Updated Successfully'));
    }   


    // Change Password 
    public function changePassword(Request $request){
        $request->validate([
            'old_password'          => 'required', 
            'new_password'          => 'required', 
            'confirm_new_passowrd'  => 'required|same:new_password', 
        ],[
            'old_password.required'     => __('Old password is required'),
            'new_password.required'     => __('New password is required'),
            'confirm_new_passowrd.same' => __('The confirm new passowrd and new password must match.'),
        ]);

        $user = User::findOrFail($request->user_id);
        if(Hash::check($request->old_password, $user->password)){

            $user->password = Hash::make($request->new_password);
            $user->save();
            return response('success');
            
        }
        else{ 
            return response('fail');
        }



    }



}
