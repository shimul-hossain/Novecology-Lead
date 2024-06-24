<?php

namespace App\Http\Controllers;

use App\Models\CRM\BaremeTravauxTag;
use Illuminate\Http\Request;

class BaremeTravauxTagController extends Controller
{
    public function create(Request $request){
        BaremeTravauxTag::create($request->except('_token'));
        return back()->with('success', __('Created Successfully'))->with('scale_active', '1');
    }
    
    public function update(Request $request){
        BaremeTravauxTag::find($request->id)->update($request->except('_token'));
        return back()->with('success', __('Updated Successfully'))->with('scale_active', '1');
    }

    public function delete(Request $request){
        BaremeTravauxTag::find($request->id)->delete();
        return back()->with('success', __('Deleted Successfully'))->with('scale_active', '1');
    }
}
