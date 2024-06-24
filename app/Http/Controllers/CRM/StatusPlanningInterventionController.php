<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\StatusPlanningIntervention;
use Illuminate\Http\Request;

class StatusPlanningInterventionController extends Controller
{
    public function statusPlanningInterventionCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        StatusPlanningIntervention::create([
            'name'              => $request->name, 
            'color'             => $request->color, 
            'background_color'  => $request->background_color, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('status_planning_intervention', '1');
        
    }
    public function statusPlanningInterventionUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = StatusPlanningIntervention::find($request->id);
        $data->update([
            'name'              => $request->name, 
            'color'             => $request->color, 
            'background_color'  => $request->background_color, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('status_planning_intervention', '1');
    }
    
    public function statusPlanningInterventionDelete(Request $request){ 
        $data = StatusPlanningIntervention::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('status_planning_intervention', '1');
    }
}
