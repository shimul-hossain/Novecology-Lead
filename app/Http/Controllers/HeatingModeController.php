<?php

namespace App\Http\Controllers;

use App\Models\CRM\HeatingMode;
use Illuminate\Http\Request;

class HeatingModeController extends Controller
{
    public function heatingModeCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        HeatingMode::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('heating_mode', '1');
        
    }
    public function heatingModeUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = HeatingMode::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('heating_mode', '1');
    }
    
    public function heatingModeDelete(Request $request){ 
        $data = HeatingMode::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('heating_mode', '1');
    }
}
