<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index(){ 
        $setting = GeneralSetting::first();
        return view('backoffice.setting.index', compact('setting'));
    }

    public function update(Request $request){
        $request->validate([
            'logo' => 'image',
            'favicon' => 'image',
            'dashboard_logo' => 'image',
        ]);

        $path = public_path('uploads/new/setting');
        $setting = GeneralSetting::first();
        $setting->update([
            'phone' => $request->phone,
            'footer_description' => $request->footer_description,
        ]);

        if($request->file('logo')){
            $logo = $request->file('logo'); 
            $logoName = 'logo-'.$setting->id.rand(0000000000,9999999999).'.'.$logo->extension();
            $logo->move($path, $logoName);
            $setting->logo = $logoName;
        } 
        if($request->file('favicon')){
            $favicon = $request->file('favicon'); 
            $faviconName = 'favicon-'.$setting->id.rand(0000000000,9999999999).'.'.$favicon->extension();
            $favicon->move($path, $faviconName);
            $setting->favicon = $faviconName;
        } 
        if($request->file('dashboard_logo')){
            $dashboard_logo = $request->file('dashboard_logo'); 
            $dashboard_logoName = 'dashboard_logo-'.$setting->id.rand(0000000000,9999999999).'.'.$dashboard_logo->extension();
            $dashboard_logo->move($path, $dashboard_logoName);
            $setting->dashboard_logo = $dashboard_logoName;
        }

        $setting->save();
 
        return back()->with('success', 'Mis à jour avec succés');
    }
}