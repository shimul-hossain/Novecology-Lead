<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('checkToken');
    // }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        $check = User::where('email', $request->email)->first(); 

        if($check->role != 's_admin')
        {
            if(!checkAction($check->id,'app_permission','access'))
            {
                return response()->json(['error' => 'You do not have access to the app'], 401);
            }
        }

        if (!Auth::attempt($attr)) {
            return response()->json(['error' => 'Credentials not match'], 401);
        }


        

        return response()->json([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

     // this method signs out users by removing tokens
     public function logout()
     {
         auth()->user()->tokens()->delete();
 
         return [
             'message' => 'Tokens Revoked'
         ];
     }
}
