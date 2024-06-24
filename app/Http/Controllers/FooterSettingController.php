<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerSetting = FooterSetting::first();

        return view('super_admin.footer_setting.index',compact('footerSetting'));
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
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function show(FooterSetting $footerSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterSetting $footerSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'copyright' => 'required',
            'first_column' => 'required',
            'second_column' => 'required',
            'third_column' => 'required'
        ],[
            'address.required'      => __('Address is required'),
            'email.required'        => __('Email is required'),
            'phone.required'        => __('Phone is required'),
            'copyright.required'    => __('Copy right is required'),
            'first_column.required' => __('First column title is required'),
            'second_column.required'=> __('Second column title is required'),
            'third_column.required' => __('Third column title is required'),
        ]);


        $data = FooterSetting::find($id);
        $data->update($request->except('_token') + ['created_at' => Carbon::now()]);

        return redirect()->route('footerSettings.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterSetting $footerSetting)
    {
        //
    }
}
