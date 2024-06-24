<?php

namespace App\Http\Controllers;

use App\Models\CRM\ProjectDeadReason;
use Illuminate\Http\Request;

class ProjectDeadReasonController extends Controller
{
    public function projectKOReasonCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        ProjectDeadReason::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('project_ko_reason', '1');
        
    }
    public function projectKOReasonUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = ProjectDeadReason::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('project_ko_reason', '1');
    }
    
    public function projectKOReasonDelete(Request $request){ 
        $data = ProjectDeadReason::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('project_ko_reason', '1');
    }
}
