<?php

namespace App\Http\Controllers;

use App\Models\CRM\ProjectControlPhoto;
use Illuminate\Http\Request;

class ProjectControlPhotoController extends Controller
{
    public function projectControlPhotoCreate(Request $request){
        $request->validate([
            'name' => "required",
            'tag_id' => "required",
        ]);
        
        ProjectControlPhoto::create([
            'name' => $request->name, 
            'tag_id' => $request->tag_id, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('project_control_photo', '1');
        
    }
    public function projectControlPhotoUpdate(Request $request){
        $request->validate([
            'name' => "required",
            'tag_id' => "required",
        ]);
        
        $data = ProjectControlPhoto::find($request->id);
        $data->update([
            'name' => $request->name, 
            'tag_id' => $request->tag_id, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('project_control_photo', '1');
    }
    
    public function projectControlPhotoDelete(Request $request){ 
        $data = ProjectControlPhoto::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('project_control_photo', '1');
    }
}
