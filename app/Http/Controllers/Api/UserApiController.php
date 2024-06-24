<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CRM\Client;
use App\Models\CRM\Event;
use App\Models\CRM\Lead;
use App\Models\CRM\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserApiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('checkToken');
    // }

    public function index()
    {
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        return response()->json(['data' => $users], 200);
    }  

    public function show($id){
        $data = User::find($id);
        return response()->json(['data' => $data], 200);
    } 

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
               $token = $user->api_token;
            return response()->json(['token' => $token], 200);
            }
            else{
                $msg = 'Wrong Credential';
            }
        }
        else{
            $msg = "Invalid Email Address";
        }
        return response()->json(['success' => $msg, 200]);
    }

    // public function location(Request $request){

    //     $lat = $request->lat;
    //     $lon = $request->lon;

    //     $user = User::find(Auth::id());


    //     if($request->lat && $request->lon)
    //     {
    //         $user->lat_address = $request->lat; 
    //         $user->lon_address = $request->lon; 
    //         $user->save();
            
    
    //         return response()->json(['success' => 'Location Received'], 200);
    //     }
    //     else 
    //     {
    //         return response()->json(['error' => 'Location could not retrived'], 422);
    //     }


    // }

    public function allLocation(){
       $id = DB::table('personal_access_tokens')->get()->pluck('tokenable_id');
       if(role() == 's_admin'){
           $data  = User::findMany($id);
        }else{
           $data  = User::findMany([Auth::id()]);
       }

       return response()->json(['success' => $data], 200);
    }
}

