<?php

namespace App\Http\Controllers;

use App\Models\CRM\ClientSubStatus;
use Illuminate\Http\Request;

class ClientSubStatusController extends Controller
{ 
    public function clientSubStatusCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        ClientSubStatus::create([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('client_sub_status', '1');
        
    }
    public function clientSubStatusUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = ClientSubStatus::find($request->id);
        $data->update([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('client_sub_status', '1');
    }
    
    public function clientSubStatusDelete(Request $request){ 
        $data = ClientSubStatus::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('client_sub_status', '1');
    }
}
