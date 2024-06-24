<?php

namespace App\Http\Controllers;

use App\Models\CRM\MandataireMaprimerenov;
use Illuminate\Http\Request;

class MandataireMaprimerenovController extends Controller
{
    public function mandataireMaprimerenovCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        MandataireMaprimerenov::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('mandataire_maprimerenov', '1');
        
    }
    public function mandataireMaprimerenovUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = MandataireMaprimerenov::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('mandataire_maprimerenov', '1');
    }
    
    public function mandataireMaprimerenovDelete(Request $request){ 
        $data = MandataireMaprimerenov::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('mandataire_maprimerenov', '1');
    }
}
