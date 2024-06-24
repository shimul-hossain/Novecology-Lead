<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CRM\PostInstallation;
use App\Models\CRM\PreInstallation;
use Illuminate\Http\Request;

class RapportApiController extends Controller
{
     public function rapportOne(Request $request)
     {
        $data = PreInstallation::where('project_id', $request->project_id)->first(); 

        return response()->json(['data' => $data], 200);

     }
     public function rapportTwo(Request $request)
     {
        $data = PostInstallation::where('project_id', $request->project_id)->first();    
        return response()->json(['data' => $data], 200);
     }
}
