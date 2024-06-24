<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\NewBanner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $banners = NewBanner::all();
        return view('backoffice.banners.index', compact('banners'));
    }

    public function create(){
        return view('backoffice.banners.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'button_text' => 'required',
            'image' => 'required|image',
        ]);


        $banner = NewBanner::create($request->except('_token'));

        $image = $request->file('image');
        $imageName = $banner->id.time().'.'.$image->extension();
        $image->move(public_path('uploads/new/banner'), $imageName);
        $banner->image = $imageName;
        $banner->save();

        return redirect()->route('backoffice.banner.index')->with('success', 'Créé avec succès');
    }
    
    public function delete(Request $request){
        $banner = NewBanner::find($request->id);
        if($banner){
            $banner->delete();
        }
        
        return back()->with('success', 'Supprimé avec succès');

    }

    public function edit($id){
        $banner = NewBanner::find($id);
        if($banner){
            return view('backoffice.banners.edit', compact('banner'));
        }

        return back();
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'button_text' => 'required',
            'image' => 'image',
        ]);


        $banner = NewBanner::find($request->id);
        $banner->update($request->except(['_token', 'id']));

        if($request->file('image')){
            $image = $request->file('image');
            $imageName = $banner->id.time().'.'.$image->extension();
            $image->move(public_path('uploads/new/banner'), $imageName);
            $banner->image = $imageName;
            $banner->save();
        }

        return redirect()->route('backoffice.banner.index')->with('success', 'Mis à jour avec succés');
    }

    public function orderUpdate(Request $request){
        $banner = NewBanner::find($request->banner_id);
        if($banner && $banner->order != $request->order){
            $banner->update([
                'order' => $request->order,
            ]);
            return response('updated');
        }
        return response('not-updated');
    }
}
