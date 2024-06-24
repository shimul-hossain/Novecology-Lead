<?php

namespace App\Http\Controllers;

use App\Models\CRM\Client;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('checkToken');
    // }
    
    // Client list 
    public function index(){
        $clients = Client::where('deleted_status', 'no')->get();
        return response()->json(['data' => $clients], 200);
    }
    
    // single client 
    public function show($id){
        $client = Client::where('id', $id)->where('deleted_status', 'no')->get();
        return response()->json(['data' => $client], 200);
    }
}
