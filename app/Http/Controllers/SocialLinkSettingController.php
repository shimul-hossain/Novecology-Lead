<?php

namespace App\Http\Controllers;

use App\Models\SocialLinkSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialLinkSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SocialLinkSetting::get();

        return view('super_admin.social_link.index',compact('data'));
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
        $request->validate([
            'icon' => 'required',
            'link' => 'required',
        ],[
            'icon.required' => __('Icon is required'),
            'link.required' => __('Link is required'), 
        ]);

        SocialLinkSetting::create($request->except('_token') + ['created_at'=> Carbon::now()]);

        return redirect()->route('socialLinks.index')->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLinkSetting  $socialLinkSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SocialLinkSetting $socialLinkSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLinkSetting  $socialLinkSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialLinkSetting $socialLinkSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLinkSetting  $socialLinkSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required',
            'link' => 'required',
        ],[
            'icon.required' => __('Icon is required'),
            'link.required' => __('Link is required'), 
        ]);

        $data = SocialLinkSetting::find($id);

        $data->update($request->except('_token') + ['updated_at'=> Carbon::now()]);

        return redirect()->route('socialLinks.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLinkSetting  $socialLinkSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SocialLinkSetting::find($id)->delete();

        return redirect()->route('socialLinks.index')->with('delete', __('Deleted Successfully'));
    }
}
