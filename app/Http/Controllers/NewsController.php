<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\News;
use App\Models\BackOffice\NewsCategory;
use App\Models\BackOffice\NewsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(){
        $all_news = News::all();
        return view('backoffice.news.index', compact('all_news'));
    }

    public function create(){
        $categories = NewsCategory::all();
        return view('backoffice.news.create', compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'title' => 'required', 
            'description' => 'required', 
            'feature_image' => 'required|image',
            'thumbnail_image' => 'required|image',
            'banner_image' => 'required|image',
        ]); 
        // dd($request->all());
        $path = public_path('uploads/new/news');
        $news = News::create($request->except(['_token']) + ['created_by' => Auth::id()]); 


        $thumbnail_image = $request->file('thumbnail_image'); 
        $thumbnailName = 'thumbnail-'.$news->id.time().'.'.$thumbnail_image->extension();
        $thumbnail_image->move($path, $thumbnailName);
        $news->thumbnail_image = $thumbnailName;

        $feature_image = $request->file('feature_image'); 
        $featureName = 'feature-'.$news->id.time().'.'.$feature_image->extension();
        $feature_image->move($path, $featureName);
        $news->feature_image = $featureName;

        $banner_image = $request->file('banner_image'); 
        $bannerName = 'banner-'.$news->id.time().'.'.$banner_image->extension();
        $banner_image->move($path, $bannerName);
        $news->banner_image = $bannerName;
        
        $news->save();
 
        return redirect()->route('backoffice.news.index')->with('success', 'Créé avec succès');
    }

    public function edit($id){
        $categories = NewsCategory::all();
        $news = News::find($id);
        if($news){
            return view('backoffice.news.edit', compact('categories', 'news'));
        }else{
            return back();
        }
    }

    public function update(Request $request){
        $request->validate([
            'category_id' => 'required',
            'title' => 'required', 
            'description' => 'required', 
            'feature_image' => 'image',
            'thumbnail_image' => 'image',
            'banner_image' => 'image',
        ]); 
        // dd($request->all());

        $path = public_path('uploads/new/news');
        $news = News::find($request->id);
        $news->update($request->except('_token')); 

        if($request->file('thumbnail_image')){
            $thumbnail_image = $request->file('thumbnail_image'); 
            $thumbnailName = 'thumbnail-'.$news->id.time().'.'.$thumbnail_image->extension();
            $thumbnail_image->move($path, $thumbnailName);
            $news->thumbnail_image = $thumbnailName;
        }

        if($request->file('feature_image')){
            $feature_image = $request->file('feature_image'); 
            $featureName = 'feature-'.$news->id.time().'.'.$feature_image->extension();
            $feature_image->move($path, $featureName);
            $news->feature_image = $featureName;
        }
        if($request->file('banner_image')){
            $banner_image = $request->file('banner_image'); 
            $bannerName = 'banner-'.$news->id.time().'.'.$banner_image->extension();
            $banner_image->move($path, $bannerName);
            $news->banner_image = $bannerName;
        }
        
        $news->save();
 
        return redirect()->route('backoffice.news.index')->with('success', 'Mis à jour avec succés');
    }

    public function delete(Request $request){
        $news = News::find($request->id);
        if($news){ 
            $news->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }


    public function category(){
        $categories = NewsCategory::all();
        return view('backoffice.news.category', compact('categories'));
    }

    public function categoryStore(Request $request){
        $request->validate([
            'title' => 'required', 
        ]);
        NewsCategory::create([
            'name' => $request->title
        ]);
       

        return back()->with('success', 'Créé avec succès');
    }

    public function categoryUpdate(Request $request){
        $request->validate([
            'title' => 'required', 
        ]);
        $category = NewsCategory::find($request->id);
        $category->update([
            'name' => $request->title
        ]); 

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function categoryDelete(Request $request){
        
        $category = NewsCategory::find($request->id); 

        if($category){
            $category->delete();
        }
        
         
        return back()->with('success', 'Supprimé avec succès');
    }

    public function info(){
        $info = NewsInfo::first();
        return view('backoffice.news.info', compact('info'));
    }
    public function infoUpdate(Request $request){
        $request->validate([
            'home_page_title' => 'required',
            'home_page_subtitle' => 'required',
            'main_page_title' => 'required',
            'main_page_subtitle' => 'required',
        ]);

        $info = NewsInfo::first();
        $info->update($request->except('_token')); 

        return back()->with('success', 'Mis à jour avec succés');
    }
}
