<?php

namespace App\Http\Controllers;

use App\Models\Favicon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaviconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favicons = Favicon::first();
        return view('super_admin.favicon.index', compact('favicons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function show(Favicon $favicon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function edit(Favicon $favicon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favicon $favicon)
    {
        $request->validate([

            'image' => 'required|image'
        ],[
            'image.required'    => __('Image is required'),
            'image.image'       => __('Image must be an image'),
        ]);

        
        $image = $request->file('image');

        if ($image) {
            $filename = $favicon->id . '.' . $image->extension('image');
            $location = public_path('uploads/favicon');
            $image->move($location,$filename);
            $favicon->image = $filename;
            $favicon->save();
        }

        return redirect()->back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favicon $favicon)
    {
        //
    }
}
