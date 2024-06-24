<?php

namespace App\Http\Controllers;

use App\Models\CRM\Entrepot;
use Illuminate\Http\Request;

class EntrepotController extends Controller
{
    public function entrepotCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        Entrepot::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function entrepotUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = Entrepot::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function entrepotDelete(Request $request){ 
        $data = Entrepot::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    }  
}
