<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\ReferenceGallery;
use App\Models\BackOffice\ReferenceGalleryCategory;
use App\Models\BackOffice\ReferenceInfo;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index(){
        $all_reference = ReferenceGallery::all();
        $categories = ReferenceGalleryCategory::all();
        return view('backoffice.reference.index', compact('all_reference', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_id' => 'required', 
            'image' => 'required|image',
        ]); 
        // dd($request->all());
        $path = public_path('uploads/new/reference');
        $reference = ReferenceGallery::create($request->except(['_token']));  

        $image = $request->file('image'); 
        $imageName = 'banner-'.$reference->id.time().'.'.$image->extension();
        $image->move($path, $imageName);
        $reference->image = $imageName;
        
        $reference->save();
 
        return redirect()->route('backoffice.reference.index')->with('success', 'Créé avec succès');
    }

    public function update(Request $request){
        $request->validate([
            'category_id' => 'required', 
            'image' => 'image',
        ]); 
        // dd($request->all());

        $path = public_path('uploads/new/reference');
        $reference = ReferenceGallery::find($request->id);
        $reference->update($request->except('_token')); 
 
        if($request->file('image')){
            $image = $request->file('image'); 
            $imageName = 'banner-'.$reference->id.time().'.'.$image->extension();
            $image->move($path, $imageName);
            $reference->image = $imageName;
        }
        
        $reference->save();
 
        return redirect()->route('backoffice.reference.index')->with('success', 'Mis à jour avec succés');
    }

    public function delete(Request $request){
        $reference = ReferenceGallery::find($request->id);
        if($reference){ 
            $reference->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }


    public function category(){
        $categories = ReferenceGalleryCategory::all();
        return view('backoffice.reference.category', compact('categories'));
    }

    public function categoryStore(Request $request){
        $request->validate([
            'title' => 'required', 
        ]);
        ReferenceGalleryCategory::create([
            'name' => $request->title
        ]);
       

        return back()->with('success', 'Créé avec succès');
    }

    public function categoryUpdate(Request $request){
        $request->validate([
            'title' => 'required', 
        ]);
        $category = ReferenceGalleryCategory::find($request->id);
        $category->update([
            'name' => $request->title
        ]); 

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function categoryDelete(Request $request){
        
        $category = ReferenceGalleryCategory::find($request->id); 

        if($category){
            $category->delete();
        }
        
         
        return back()->with('success', 'Supprimé avec succès');
    }

    public function info(){
        $info = ReferenceInfo::first();
        return view('backoffice.reference.info', compact('info'));
    }
    public function infoUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
            'gallery_title' => 'required',
        ]);

        $info = ReferenceInfo::first();
        $info->update($request->except('_token')); 
        if($request->file('image')){
            $image = $request->file('image');
            $fileName = rand(000000000,9999999999).'.'.$image->extension();
            $image->move(public_path('uploads/new/reference'), $fileName);
            $info->image = $fileName;
            $info->save();
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
}
