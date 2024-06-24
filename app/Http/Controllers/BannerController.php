<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::get();
        return view('super_admin.banner.index',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_line'     => 'required',
            'second_line'    => 'required',
            'banner_image'   => 'required|image',
        ],[
            'first_line.required'    => __('Title is required'),
            'second_line.required'   => __('Sub title is required'),
            'banner_image.required'  => __('Banner image is required'),
            'banner_image.image'     => __('Banner image must be an image'), 
        ]);
        $data = Banner::create($request->except('_token') + ['created_at' => Carbon::now()]);
        

        $image = $request->file('banner_image'); 
        
        if ($image)
        {
            $filename = $data->id. '.' .$image->extension('image');
            $location = public_path('uploads/banner'); 
            $image->move($location, $filename); 
            $data->banner_image = $filename; 
            $data->update();
        }
       
      
        return redirect()->route('banner.index')->with('create', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);

        return view('super_admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_line'    => 'required',
            'second_line'   => 'required',
        ],[
            'first_line.required'    => __('First line is required'),
            'second_line.required'   => __('Second line is required'),  
        ]);

        $data = Banner::find($id);
        $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);
        

        $image = $request->file('banner_image'); 
        
        if ($image)
        {
            $filename = $data->id. '.' .$image->extension('banner_image');
            $location = public_path('uploads/banner'); 
            $image->move($location, $filename); 
            $data->banner_image = $filename; 
            $data->update();
        }
        return redirect()->route('banner.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Banner::find($id)->delete();
        return redirect()->route('banner.index')->with('delete', __('Deleted Successfully'));

    }
}
