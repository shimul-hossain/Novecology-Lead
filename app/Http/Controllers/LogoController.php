<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::first();
        return view('super_admin.logo.index', compact('logos'));
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
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([

            'image'  => 'image',
            'image2' => 'image'
        ],[
            'image.image'  => __('White logo must be an image'),
            'image2.image' => __('Color logo must be an image'),
        ]);

        // $data = Logo::find($logo);
        // $data->update($request->except('_token') + ['created_at' => Carbon::now()]);
        $image = $request->file('image');

        if ($image) {
            $filename = $logo->id . '-white.' . $image->extension('image');
            $location = public_path('uploads/logo');
            $image->move($location,$filename);
            $logo->image = $filename;
            $logo->update();
        }

        $image = $request->file('image2');

        if ($image) {
            $filename = $logo->id . '-color.' . $image->extension('image2');
            $location = public_path('uploads/logo');
            $image->move($location,$filename);
            $logo->image2 = $filename;
            $logo->update();
        }

        return redirect()->back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        //
    }
}
