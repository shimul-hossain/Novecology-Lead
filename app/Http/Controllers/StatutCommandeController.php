<?php

namespace App\Http\Controllers;

use App\Models\CRM\StatutCommande;
use Illuminate\Http\Request;

class StatutCommandeController extends Controller
{
    public function statutCommandeCreate(Request $request){
        $request->validate([
            'name' => "required",
            'background_color' => "required",
            'text_color' => "required",
        ]);
        
        StatutCommande::create([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function statutCommandeUpdate(Request $request){
        $request->validate([
            'name' => "required",
            'background_color' => "required",
            'text_color' => "required",
        ]);
        
        $data = StatutCommande::find($request->id);
        $data->update([
            'name' => $request->name, 
            'background_color' => $request->background_color, 
            'text_color' => $request->text_color, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function statutCommandeDelete(Request $request){ 
        $data = StatutCommande::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    }  
}
