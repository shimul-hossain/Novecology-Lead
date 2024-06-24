<?php

namespace App\Http\Controllers;

use App\Models\CRM\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function entrepreisesCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        Entreprise::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('Entreprise_de_travaux', '1');
        
    }
    public function entrepreisesUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = Entreprise::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('Entreprise_de_travaux', '1');
    }
    
    public function entrepreisesDelete(Request $request){ 
        $data = Entreprise::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('Entreprise_de_travaux', '1');
    }
}
