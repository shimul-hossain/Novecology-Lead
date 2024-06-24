<?php

namespace App\Http\Controllers;

use Str;
use App\Models\User;
use App\Models\CRM\Role;
use App\Models\Subscribe;
use App\Models\CRM\Company;
use App\Mail\CRM\AssignMail;
use Illuminate\Http\Request;
use App\Models\CRM\Permission;
use App\Models\SimulateProject;
use App\Mail\CRM\UserRegisterMail;
use App\Models\CRM\UserPermission;
use App\Models\CRM\ActionPermission;
use App\Models\CRM\CommentCategoryAssign;
use App\Models\CRM\Regie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\CRM\RoleActionPermission;
use App\Models\RoleCategory;
use App\Models\StoreEmail;
use Artisan;
use Carbon\Carbon;
// use Webklex\IMAP\Facades\Client;

class SuperAdminController extends Controller
{
    public function landing(){

        $company = Company::latest()->paginate(10);
        $totalCompany = Company::all();
        $user = User::where('id', Auth::id())->first();
        return view('admin.home', compact('user', 'company', 'totalCompany'));
    }
    public function index(){
        return redirect()->route('backoffice.dashboard');
        $subscribe  = [];
        $simulation = [];
        for ($i=1; $i <= 12 ; $i++) { 
 
            $subscribe[]  = Subscribe::whereMonth('created_at', $i)->count();
            $simulation[] = SimulateProject::whereMonth('created_at', $i)->count();
         //    $months[] = date('F', mktime(0,0,0, $i, 1, date('Y'))); 
         //    $payment = PaymentModule::whereMonth('date', $i)->sum('price_ttc');
         //    $receipt = ExtraReceipt::whereMonth('date', $i)->sum('price_ttc');
         //    $expence[] = round(($payment +  $receipt) * -1);  
        }

        $subs = Subscribe::get();

        return view('super_admin.index',compact('subs','subscribe','simulation'));
    }

    // New User Register 
    public function registerIndex(){

        $roles = Role::where('status', 'active')->get();
        $categories = RoleCategory::all();
        $regies = Regie::all();
        $team_leader = User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
        return view('admin.register', compact('roles', 'regies', 'team_leader', 'categories'));
    }

    public function RegisterStore(Request $request){
        // $token = Str::random(60); 
        
        $request->validate([

            'name'                  => 'required',
            'regie_id'              => 'required_with:regie',
            'team_leader'           => 'required_with:teamLeader',
            'email'                 => 'required|email|unique:users', 
            // 'username'           => 'required|unique:users',
            'password'              => 'required|regex:$\S*(?=\S{8,})(?=\S*[A-Z])(?=\S*[\W])\S*$',
            'confirm_password'      => 'required|same:password', 
            // 'email_professional'    => 'required',
            // 'phone_professional'    => 'required',
            // 'prenom_professional'   => 'required',
            'photo'                 => 'image'
        ],[
            'name.required'                 => __('Name is required'),
            'regie_id.required_with'        => __('Regie is required'),
            'team_leader.required_with'     => __('CHEF D’EQUIPE is required'),
            'email.required'                => __('Email is required'),
            'email.unique'                  => __('This email is already exist'),
            // 'username.required'          => __('User name is required'),
            // 'username.unique'            => __('This user name is already exist'),
            'password.required'             => __('Password is required'),
            'password.regex'                => 'Au moins 8 caractères, une lettre majuscule et un caractère spécial sont requis.',
            'confirm_password.required'     => __('Confirm password is required'),
            'confirm_password.same'         => __('Confirm password must be same as password'),
            'role_id.required'              => __('Role is required'),
            // 'email_professional.required'   =>  'Le champ Email professionnel est requis' ,
            // 'phone_professional.required'   =>  'Le champ Téléphone professionnel est requis',
            // 'prenom_professional.required'  =>  'Le champ Prénom professionnel est requis',
        ]); 

        $user = new User();
        $role = Role::find($request->role_id);
        $user->name = $request->name ;
        $user->first_name = $request->first_name;
        $user->regie_id = $request->regie_id;
        $user->team_leader = $request->team_leader;
        $user->status = $request->status ? 'active':"deactive";
        // $user->username =$request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->email_professional = $request->email_professional;
        $user->phone_professional = $request->phone_professional;
        $user->prenom_professional = $request->prenom_professional;
        $user->role = $role->value;
        // $user->api_token = $token;
        $user->save();
        if($request->team_leader_himself){
            $user->team_leader = $user->id;
            $user->save();
        }

        if($request->file('photo')){
            $image = $request->file('photo');
            $path = public_path('uploads/crm/profiles'); 
            $fileName = $user->id.rand(00000,99999).'.'.$image->extension();
            $image->move($path, $fileName);
            $user->profile_photo = $fileName;
            $user->save();
        }
  
        foreach($role->commentCategory as $comment_category){
            CommentCategoryAssign::create([
                'comment_category_id' => $comment_category->id,
                'user_id' => $user->id
            ]);
        }  
    
        $permissions = RoleActionPermission::where('role_id', $request->role_id)->get();
        foreach($permissions as $permission){
            ActionPermission::create([
                'user_id' => $user->id,
                'module_name' => $permission->module_name,
                'action_name' => $permission->action_name,
            ]);
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
 
             
            $name = Auth::user()->name;
            $email = $user->email;
            $password = $request->password;
            $subject = 'New Account';
            $body = $user->name.', You have a new account for Novecology';

            if($user->email_professional){
                Mail::to($user->email_professional)->send(new UserRegisterMail($subject, $body, $email, $password)); 
            }
            
            if (checkAction(Auth::id(), 'user', 'view') || role() == 's_admin'){
                return redirect()->route('user.all')->with('success', __('New User Create Successfully'));
            }else{
                return back()->with('success', __('New User Create Successfully'));
            }
 
    }

    public function tokenGenerate($id){
       $user = User::find($id); 
        $user->api_token = Str::random(60);
        $user->save(); 
        return redirect()->back()->with('success', __('Token Generated'));
    }


    // public function storeEmails()
    // {
    //         ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
        
    //         Artisan::call("config:clear");
    //         $client = Client::account('gmail');
    //         $client->connect();
       
    //         $folders = $client->getFolder('INBOX');




    //         $time = Carbon::now()->subDays(1)->format('d.m.Y');
    //         $messages = $folders->query()->since($time)->get();

           

    //     foreach($messages as $key => $message)
    //     {
    //        if(StoreEmail::where('uid', $message->uid)->doesntExist())
    //        {
    //            StoreEmail::create([
    //                'from'      =>  $message->getFrom()[0]->mail,
    //                'date'      =>  $message->getDate(),
    //                'subject'   =>  $message->getSubject(),
    //                'body'      =>  utf8_encode($message->getHTMLBody()),
    //                'email_id'  =>  'subvention@novecology.fr',
    //                'uid'       =>  $message->uid,
    //            ]);
    //        }
    //     }
    //         ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
        
    //         Artisan::call("config:clear");
    //         $client = Client::account('gmail_two');
    //         $client->connect();
       
    //         $folders = $client->getFolder('INBOX');




    //         $time = Carbon::now()->subDays(1)->format('d.m.Y');
    //         $messages = $folders->query()->since($time)->get();

           

    //     foreach($messages as $key => $message)
    //     {
    //        if(StoreEmail::where('uid', $message->uid)->doesntExist())
    //        {
    //            StoreEmail::create([
    //                'from'      =>  $message->getFrom()[0]->mail,
    //                'date'      =>  $message->getDate(),
    //                'subject'   =>  $message->getSubject(),
    //                'body'      =>  utf8_encode($message->getHTMLBody()),
    //                'email_id'  =>  'mandat@novecology.fr',
    //                'uid'       =>  $message->uid,
    //            ]);
    //        }
    //     }
    //         ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
        
    //         Artisan::call("config:clear");
    //         $client = Client::account('gmail_three');
    //         $client->connect();
       
    //         $folders = $client->getFolder('INBOX');




    //         $time = Carbon::now()->subDays(1)->format('d.m.Y');
    //         $messages = $folders->query()->since($time)->get();

           

    //     foreach($messages as $key => $message)
    //     {
    //        if(StoreEmail::where('uid', $message->uid)->doesntExist())
    //        {
    //            StoreEmail::create([
    //                'from'      =>  $message->getFrom()[0]->mail,
    //                'date'      =>  $message->getDate(),
    //                'subject'   =>  $message->getSubject(),
    //                'body'      =>  utf8_encode($message->getHTMLBody()),
    //                'email_id'  =>  'supportmpr@novecology.fr',
    //                'uid'       =>  $message->uid,
    //            ]);
    //        }
    //     }
    // }


    
}
