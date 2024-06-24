<?php

namespace App\Http\Controllers;

use App\Models\CRM\Campagnetype;
use Illuminate\Http\Request;

class CampagnetypeController extends Controller
{
    public function campagneTypeCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        Campagnetype::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('campagne_type', '1');
        
    }
    public function campagneTypeUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = Campagnetype::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('campagne_type', '1');
    }
    
    public function campagneTypeDelete(Request $request){ 
        $data = Campagnetype::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('campagne_type', '1');
    }
}
