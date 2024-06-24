<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\RejectReason;
use Illuminate\Http\Request;

class RejectReasonController extends Controller
{
    public function rejectReasonCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        RejectReason::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('reject_reason', '1');
        
    }
    public function rejectReasonUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = RejectReason::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('reject_reason', '1');
    }
    
    public function rejectReasonDelete(Request $request){ 
        $data = RejectReason::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('reject_reason', '1');
    }
}
