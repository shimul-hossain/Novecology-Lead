<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactUs = ContactUs::first();

        return view('super_admin.contact_us.index',compact('contactUs'));
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
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'title'    => 'required',
            'subtitle' => 'required',
            'details'  => 'required',
        ],[
            'title.required'         => __('Title is required'),
            'subtitle.required'      => __('Subtitle is required'),
            'details.required'       => __('Details is required'),
        ]);

        $data = ContactUs::find($id);
        $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/menu_contactUs');
            $image->move($location,$filename);
            $data->image = $filename;
            $data->update();
        }

     

        return redirect()->route('menueContactus.index')->with('update', __('Updated Successfully'));
    }




    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
