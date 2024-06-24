<?php

namespace App\Http\Controllers;

use App\Models\CRM\ProjectReflectionReason;
use Illuminate\Http\Request;

class ProjectReflectionReasonController extends Controller
{
    public function projectReflectionAReasonCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        ProjectReflectionReason::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('project_reflection_reason', '1');
        
    }
    public function projectReflectionAReasonUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = ProjectReflectionReason::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('project_reflection_reason', '1');
    }
    
    public function projectReflectionAReasonDelete(Request $request){ 
        $data = ProjectReflectionReason::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('project_reflection_reason', '1');
    }
}
