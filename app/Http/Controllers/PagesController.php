<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::get();
        return view('super_admin.pages.index',compact('pages'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.pages.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title'            => 'required',
            // 'thumbnail'        => 'required|image',
            'long_description' => 'required',
        ],[
            'title.required'            => __('Title is required'),
            'long_description.required' => __('Description is required'), 
        ]);

        // Slug
        $create_slug = Str::slug($request->title);
        $random      = Str::random(10);
 
        $slug = $create_slug. '-' .$random;

        $link = route('more.pages',$slug);


        $data = Pages::create($request->except('_token') + ['created_at'=> Carbon::now()] + ['link' => $link] + ['slug' => $slug]);

        // $thumbnail = $request->file('thumbnail');
        // $filename = $data->id . '-thumbnail.' . $thumbnail->extension('image');
        // $location = public_path('uploads/extra_page');
        // $thumbnail->move($location,$filename);
        // $data->thumbnail= $filename;
        // $data->update();

        // $image = $request->file('image');
        // if ($image) {
        //     $filename = $data->id . '-image.' . $image->extension('image');
        //     $location = public_path('uploads/extra_page');
        //     $image->move($location,$filename);
        //     $data->image = $filename;
        //     $data->update();
        // }
        

        return redirect()->route('pages.index')->with('success', __('Created Successfully'));

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page= Pages::find($id);

        return view('super_admin.pages.edit',compact('page'));
    }




    
    public function update(Request $request, $id)
    {
        $request->validate([

            'title'            => 'required',
            'long_description' => 'required',
        ],[
            'title.required'            => __('Title is required'),
            'long_description.required' => __('Description is required'), 
        ]);

        //Slug
        $create_slug = Str::slug($request->title);
        $random      = Str::random(10);
 
        $slug = $create_slug. '-' .$random;

        $link = route('more.pages',$slug);

        $data = Pages::find($id);
        $data ->update($request->except('_token','link') + ['updated_at'=> Carbon::now()] + ['link' => $link] + ['slug' => $slug]);

        // $thumbnail = $request->file('thumbnail');
        // if ($thumbnail) 
        // {
            
        //     $filename = $data->id . '-thumbnail.' . $thumbnail->extension('image');
        //     $location = public_path('uploads/extra_page');
        //     $thumbnail->move($location,$filename);
        //     $data->thumbnail = $filename;
        //     $data->save();
        // }

        // $image = $request->file('image');
        // if ($image) {
        //     $filename = $data->id . '-image.' . $image->extension('image');
        //     $location = public_path('uploads/logo');
        //     $image->move($location,$filename);
        //     $data->image = $filename;
        //     $data->save();
        // }
        

        return redirect()->route('pages.index')->with('success', __('Updated Successfully'));
    }





    public function destroy($id)
    {
        Pages::find($id)->delete();
        return redirect()->route('pages.index')->with('delete', __('Deleted Successfully'));
        
    }
}
