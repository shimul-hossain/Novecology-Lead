<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\DocumentControl;
use Illuminate\Http\Request;

class DocumentControlController extends Controller
{
    public function controlCreate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        DocumentControl::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return back()->with('success', __('Created Successfully'))->with('control_active', 1);
    }
    
    public function controlDelete(Request $request){
        DocumentControl::find($request->id)->delete();
        return back()->with('success', __('Deleted Successfully'))->with('control_active', 1);
    }
    
    public function controlUpdate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        
        $control = DocumentControl::find($request->id)->update([
            'name' => $request->name,
            'order' => $request->order,
        ]);
        return back()->with('success', __('Updated Successfully'))->with('control_active', 1);
    }
    


    //End
}
