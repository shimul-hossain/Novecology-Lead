<?php

namespace App\Http\Controllers;

use App\Models\About;
use BaconQrCode\Renderer\Path\Move;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $abouts = About::get();
        return view('super_admin.about.index',compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.about.create');
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
            'title'   => 'required',
            'details' => 'required',
            'image'   => 'required|image',
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Details is required'),
            'image.required'    => __('Image is required'),
            'image.image'       => __('Image must be an image'),
        ]);

        $data = About::create($request->except('_token') + ['created_at' => Carbon::now()]);

        $image = $request->file('image');

        $filename = $data->id . '.' . $image->extension('image');
        $location = public_path('uploads/about_us');
        $image->move($location,$filename);
        $data->image = $filename;

        $data->save();

        return redirect()->route('abouts.index')->with('success', __('Created Successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('super_admin.about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'title'   => 'required',
            'details' => 'required',
           
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Details is required'), 
        ]);

        // $data = About::find($about);
        $about->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $about->id . '.' . $image->extension('image');
            $location = public_path('uploads/about_us');
            $image->move($location,$filename);
            $about->image = $filename;
            $about->update();
        }

     

        return redirect()->route('abouts.index')->with('update', __('Updated Successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('abouts.index')->with('delete', __('Deleted Successfully'));

    }
}
