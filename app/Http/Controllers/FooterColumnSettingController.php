<?php

namespace App\Http\Controllers;

use App\Models\FooterColumnSetting;
use App\Models\FooterSetting;
use App\Models\Pages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterColumnSettingController extends Controller
{



    public function index()
    {
        $footerColumn_name   = FooterSetting::first();
        $cloumnSettingFirst  = FooterColumnSetting::where('column_no','1st')->get();
        $cloumnSettingSecond = FooterColumnSetting::where('column_no','2nd')->get();
        $cloumnSettingThird  = FooterColumnSetting::where('column_no','3rd')->get();
        $pages                = Pages::get();
        $footerSetting       = FooterColumnSetting::get();

        return view('super_admin.footer_setting.footer_column',
        compact('footerColumn_name','cloumnSettingFirst','cloumnSettingSecond','cloumnSettingThird','pages','footerSetting'));
    }




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
            'title' => 'required'
        ],[
            'title.required' => __('Title is required'),
        ]);

        $data = new FooterColumnSetting();
        $data->title = $request->title;
        $data->link = $request->link;
        $data->column_no = $request->column_no;
        $data->save();

        return redirect()->route('columnSettings.index')->with('success', __('Created Successfully'));

    }




    public function show(FooterColumnSetting $footerColumnSetting)
    {
        //
    }




    public function edit(FooterColumnSetting $footerColumnSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterColumnSetting  $footerColumnSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ],[
            'title.required' => __('Title is required'),
        ]);

        $data = FooterColumnSetting::find($id);
        $data->title     = $request->title;
        $data->link     = $request->link;
        $data->column_no = $request->column_no;
        $data->update();

        return redirect()->route('columnSettings.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterColumnSetting  $footerColumnSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FooterColumnSetting::find($id)->delete();
        return redirect()->route('columnSettings.index')->with('delete', __('Deleted Successfully'));
    }



    
}
