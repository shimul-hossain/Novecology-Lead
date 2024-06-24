<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Automatise;
use App\Models\CRM\LeadSubStatus;
use Illuminate\Http\Request;

class LeadSubStatusController extends Controller
{
    public function leadSubStatusCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);

        $sub_status = LeadSubStatus::create([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
            'order' => $request->order, 
        ]);

        $sub_status->getStatus()->attach($request->status_id);
        
        return back()->with('success', __('Created Successfully'))->with('lead_sub_status', '1');
        
    }
    public function leadSubStatusUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = LeadSubStatus::find($request->id);
        $data->update([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
            'order' => $request->order, 
        ]);
        $data->getStatus()->sync($request->status_id);
        return back()->with('success', __('Updated Successfully'))->with('lead_sub_status', '1');
    }
    
    public function leadSubStatusDelete(Request $request){ 
        $data = LeadSubStatus::find($request->id);
        Automatise::where('automatisation_for', 'prospects')->where('status', 'sub_'.$request->id)->get()->each->delete();
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('lead_sub_status', '1');
    }
}
