<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\FournisseurType;
use Illuminate\Http\Request;

class FournisseurTypeController extends Controller
{
    public function typeFournisseurCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        FournisseurType::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('type_fournisseur', '1');
        
    }
    public function typeFournisseurUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = FournisseurType::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('type_fournisseur', '1');
    }
    
    public function typeFournisseurDelete(Request $request){ 
        $data = FournisseurType::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('type_fournisseur', '1');
    }
}
