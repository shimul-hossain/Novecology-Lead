<?php

namespace App\Http\Controllers;

use App\Models\Mediatheque;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MediathequeCategory;

class MediathequeController extends Controller
{
    public function index(){
        $categories = MediathequeCategory::all();
        return view('frontend.new.new_mediatheque', compact('categories'));
        // return view('frontend.mediatheque', compact('categories'));
    }

    public function adminIndex(){
        $mediatheques = Mediatheque::all();
        return view('super_admin.mediatheque.index', compact('mediatheques'));        
    }
    
    public function categoryIndex(){
        $categories = MediathequeCategory::all();
        return view('super_admin.mediatheque_category.index', compact('categories'));        
    }
    public function create(){
        $categories = MediathequeCategory::all();
        return view('super_admin.mediatheque.create', compact('categories'));        
    }

    public function store(Request $request){
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'logo' => 'required|image',
            'file' => 'required',
        ]);

        $mediatheque = Mediatheque::create([
            'category_id' => $request->category,
            'title' => $request->title,
        ]);
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = $mediatheque->id.time().'.'.$file->extension();
            $file->move(public_path('uploads/mediatheques'), $fileName);
            $mediatheque->file_name = $fileName;
            $mediatheque->file_original_name = $fileName;
        }
        if($request->file('logo')){
            $logo = $request->file('logo');
            $previewImageName = $mediatheque->id.time().'.'.$logo->extension();
            $logo->move(public_path('uploads/mediatheques'), $previewImageName);
            $mediatheque->logo = $previewImageName;
        }
        $mediatheque->save();

        return redirect()->route('admin.mediatheque.index')->with('success', __('Created Successfully'));
    }
    
    public function edit($id){
        $categories = MediathequeCategory::all();
        $mediatheque = Mediatheque::find($id);
        return view('super_admin.mediatheque.edit', compact('categories', 'mediatheque'));
    }

    public function update(Request $request){
        $request->validate([
            'category' => 'required',
            'title' => 'required', 
            'logo' => 'image',
        ]);

        $mediatheque = Mediatheque::find($request->id); 
        if($mediatheque){
            $mediatheque->update([
                'category_id' => $request->category,
                'title' => $request->title,
            ]);
        }
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = $mediatheque->id.time().'.'.$file->extension(); 
            $file->move(public_path('uploads/mediatheques'), $fileName);
            $mediatheque->file_name = $fileName;
            $mediatheque->file_original_name = $fileName;
        }
        if($request->file('logo')){
            $logo = $request->file('logo');
            $previewImageName = $mediatheque->id.time().'.'.$logo->extension();
            $logo->move(public_path('uploads/mediatheques'), $previewImageName);
            $mediatheque->logo = $previewImageName;
        }
        $mediatheque->save();

        return redirect()->route('admin.mediatheque.index')->with('success', __('Updated Successfully'));
    }
    
    public function delete(Request $request){
        Mediatheque::find($request->id)->delete();
        return back()->with('success', __('Deleted Successfully'));
    }
    public function categoryCreate(){
        return view('super_admin.mediatheque_category.create');        
    }

    public function categoryStore(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        MediathequeCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.mediatheque.category.index')->with('success', __('Created Successfully'));
    }
    
    public function categoryEdit($id){
        $category = MediathequeCategory::find($id);
        return view('super_admin.mediatheque_category.edit', compact('category'));
    }

    public function categoryUpdate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $category = MediathequeCategory::find($request->id); 
        if($category){
            $category->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->route('admin.mediatheque.category.index')->with('success', __('Updated Successfully'));
    }


    
    public function categoryDelete(Request $request){
        MediathequeCategory::find($request->id)->delete();
        return back()->with('success', __('Deleted Successfully'));
    }
}
