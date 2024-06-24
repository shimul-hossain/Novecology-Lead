<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Renovation;
use App\Models\BackOffice\RenovationBlockInfo;
use Illuminate\Http\Request;

class RenovationController extends Controller
{
    public function index(){
        $renovations = Renovation::all();
        $info = RenovationBlockInfo::first();
        return view('backoffice.renovations.index', compact('renovations', 'info'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $renovation = Renovation::create($request->except('_token'));
        
        $image = $request->file('image');
        $imageName = $renovation->id.time().'-image.'.$image->extension();
        $image->move(public_path('uploads/new/renovation'), $imageName);
        $renovation->image = $imageName;
        $renovation->save(); 

        return back()->with('success', 'Créé avec succès');
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);
        $renovation = Renovation::find($request->id);
        $renovation->update($request->except('_token'));
        
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = $renovation->id.time().'-image.'.$image->extension();
            $image->move(public_path('uploads/new/renovation'), $imageName);
            $renovation->image = $imageName;
            $renovation->save(); 
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function infoUpdate(Request $request){
        $request->validate([
            'info_title' => 'required',
            'info_sub_title' => 'required',
            'image' => 'image',
        ]);
        $renovation = RenovationBlockInfo::first();
        $renovation->update([
            'title' => $request->info_title,
            'subtitle' => $request->info_sub_title,
        ]);
        
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = $renovation->id.time().'-image.'.$image->extension();
            $image->move(public_path('uploads/new/renovation'), $imageName);
            $renovation->image = $imageName;
            $renovation->save(); 
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function delete(Request $request){
        
        $renovation = Renovation::find($request->id); 

        if($renovation){
            $renovation->delete();
        }
        
         
        return back()->with('success', 'Supprimé avec succès');
    }
}
