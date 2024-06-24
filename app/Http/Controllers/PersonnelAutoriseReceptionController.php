<?php

namespace App\Http\Controllers;

use App\Models\CRM\PersonnelAutoriseReception;
use Illuminate\Http\Request;

class PersonnelAutoriseReceptionController extends Controller
{
    public function personnelAutoriseReceptionCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        PersonnelAutoriseReception::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function personnelAutoriseReceptionUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = PersonnelAutoriseReception::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function personnelAutoriseReceptionDelete(Request $request){ 
        $data = PersonnelAutoriseReception::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    }  
}
