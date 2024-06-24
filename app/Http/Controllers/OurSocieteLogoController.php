<?php

namespace App\Http\Controllers;

use App\Models\OurSocieteLogo;
use Illuminate\Http\Request;

class OurSocieteLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $logo = OurSocieteLogo::first();
       return view('super_admin.our_society.our_societe_logo',compact('logo'));
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
     * @param  \App\Models\OurSocieteLogo  $ourSocieteLogo
     * @return \Illuminate\Http\Response
     */
    public function show(OurSocieteLogo $ourSocieteLogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurSocieteLogo  $ourSocieteLogo
     * @return \Illuminate\Http\Response
     */
    public function edit(OurSocieteLogo $ourSocieteLogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurSocieteLogo  $ourSocieteLogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurSocieteLogo $ourSocieteLogo)
    {
        $request->validate([
            'image1' => 'image',
            'image2' => 'image',
            'image3' => 'image',
        ],[
            'image1.image' => __('Image 1 must be an image'),
            'image2.image' => __('Image 2 must be an image'),
            'image3.image' => __('Image 3 must be an image'),
        ]);
 
        $data = OurSocieteLogo::first();
 
        $image1 = $request->file('image1'); 
         
        if ($image1)
        {
            $filename = $data->id. '-image1.' .$image1->extension('image1');
            $location = public_path('uploads/OurSocieteLogo'); 
            $image1->move($location, $filename); 
            $data->image1 = $filename; 
            $data->update();
        }
        $image2 = $request->file('image2'); 
         
        if ($image2)
        {
            $filename = $data->id. '-image2.' .$image2->extension('image2');
            $location = public_path('uploads/OurSocieteLogo'); 
            $image2->move($location, $filename); 
            $data->image2 = $filename; 
            $data->update();
        }
 
        $image3 = $request->file('image3'); 
         
        if ($image3)
        {
            $filename = $data->id. '-image3.' .$image3->extension('image3');
            $location = public_path('uploads/OurSocieteLogo'); 
            $image3->move($location, $filename); 
            $data->image3 = $filename; 
            $data->update();
        }
 
        return back()->withSuccess(__('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurSocieteLogo  $ourSocieteLogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurSocieteLogo $ourSocieteLogo)
    {
        //
    }
}
