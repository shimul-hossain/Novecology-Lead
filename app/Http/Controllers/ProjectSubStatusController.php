<?php

namespace App\Http\Controllers;

use App\Models\Automatise;
use App\Models\CRM\ProjectSubStatus;
use Illuminate\Http\Request;

class ProjectSubStatusController extends Controller
{
    public function projectSubStatusCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $sub_status = ProjectSubStatus::create([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
            'order'      => $request->order    
        ]);

        $sub_status->getStatus()->attach($request->status_id);
        
        return back()->with('success', __('Created Successfully'))->with('project_sub_status', '1');
        
    }
    public function projectSubStatusUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = ProjectSubStatus::find($request->id);
        $data->update([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
            'order' => $request->order
        ]);
        $data->getStatus()->sync($request->status_id);
        return back()->with('success', __('Updated Successfully'))->with('project_sub_status', '1');
    }
    
    public function projectSubStatusDelete(Request $request){ 
        $data = ProjectSubStatus::find($request->id);
        Automatise::where('automatisation_for', 'chantier')->where('status', 'sub_'.$request->id)->get()->each->delete();
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('project_sub_status', '1');
    }

}
