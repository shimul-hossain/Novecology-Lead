<?php

namespace App\Http\Controllers;

use App\Models\CRM\NatureMouvement;
use Illuminate\Http\Request;

class NatureMouvementController extends Controller
{
    public function natureMouvementCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        NatureMouvement::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function natureMouvementUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = NatureMouvement::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function natureMouvementDelete(Request $request){ 
        $data = NatureMouvement::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    }   
}
