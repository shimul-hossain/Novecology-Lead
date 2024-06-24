<?php

namespace App\Http\Controllers;

use App\Models\CRM\TravauxTag;
use Illuminate\Http\Request;

class TravauxTagController extends Controller
{
    public function tagCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        TravauxTag::create([
            'name' => $request->name,
            'travaux_id' => $request->travaux_id,
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('tag_tab_active', '1');
        
    }
    public function tagUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        $data = TravauxTag::find($request->id);
        $data->update([
            'name' => $request->name,
            'travaux_id' => $request->travaux_id,
        ]);
        return back()->with('success', __('Updated Successfully'))->with('tag_tab_active', '1');
    }
    
    public function tagDelete(Request $request){ 
        $data = TravauxTag::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('tag_tab_active', '1');
    }
    
}
