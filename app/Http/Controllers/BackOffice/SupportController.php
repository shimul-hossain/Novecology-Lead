<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Support;
use App\Models\BackOffice\SupportBlockInfo;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(){
        $supports = Support::all();
        $info = SupportBlockInfo::first();
        return view('backoffice.supports.index', compact('supports', 'info'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required|image',
        ]);

        $support = Support::create($request->except('_token'));
        
        $icon = $request->file('icon');
        $iconName = $support->id.time().'-icon.'.$icon->extension();
        $icon->move(public_path('uploads/new/support'), $iconName);
        $support->icon = $iconName;
        $support->save(); 

        return back()->with('success', 'Créé avec succès');
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'image',
        ]);
        $support = Support::find($request->id);
        $support->update($request->except('_token'));
        
        if($request->file('icon')){
            $icon = $request->file('icon');
            $iconName = $support->id.time().'-icon.'.$icon->extension();
            $icon->move(public_path('uploads/new/support'), $iconName);
            $support->icon = $iconName;
            $support->save(); 
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function infoUpdate(Request $request){
        $request->validate([
            'info_title' => 'required',
            'info_sub_title' => 'required',
            'image' => 'image',
        ]);
        $support = SupportBlockInfo::first();
        $support->update([
            'title' => $request->info_title,
            'subtitle' => $request->info_sub_title,
        ]);
        
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = $support->id.time().'-image.'.$image->extension();
            $image->move(public_path('uploads/new/support'), $imageName);
            $support->image = $imageName;
            $support->save(); 
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function delete(Request $request){
        
        $support = Support::find($request->id); 

        if($support){
            $support->delete();
        }
        
         
        return back()->with('success', 'Supprimé avec succès');
    }
}
