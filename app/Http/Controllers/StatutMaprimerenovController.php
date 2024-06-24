<?php

namespace App\Http\Controllers;

use App\Models\CRM\StatutMaprimerenov;
use Illuminate\Http\Request;

class StatutMaprimerenovController extends Controller
{
    public function statutMaprimerenovCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        StatutMaprimerenov::create([
            'name' => $request->name, 
            'order' => $request->order,
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('statut_maprimerenov', '1');
        
    }
    public function statutMaprimerenovUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = StatutMaprimerenov::find($request->id);
        $data->update([
            'name' => $request->name, 
            'order' => $request->order,
        ]);
        return back()->with('success', __('Updated Successfully'))->with('statut_maprimerenov', '1');
    }
    
    public function statutMaprimerenovDelete(Request $request){ 
        $data = StatutMaprimerenov::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('statut_maprimerenov', '1');
    }
}
