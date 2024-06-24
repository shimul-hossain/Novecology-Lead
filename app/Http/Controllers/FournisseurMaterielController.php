<?php

namespace App\Http\Controllers;

use App\Models\CRM\FournisseurMateriel;
use Illuminate\Http\Request;

class FournisseurMaterielController extends Controller
{
    public function fournisseurMaterielCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        FournisseurMateriel::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function fournisseurMaterielUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = FournisseurMateriel::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function fournisseurMaterielDelete(Request $request){ 
        $data = FournisseurMateriel::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    } 
}
