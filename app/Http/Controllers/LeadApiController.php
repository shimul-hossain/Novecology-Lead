<?php

namespace App\Http\Controllers;

use App\Models\CRM\Lead;
use Illuminate\Http\Request;

class LeadApiController extends Controller
{


    public function index(){
        $lead = Lead::all();
        return response()->json(['data' => $lead], 200);
    }
}
