<?php

namespace App\Http\Controllers;

use App\Models\CRM\Agent;
use App\Models\CRM\Amo;
use App\Models\CRM\Area;
use App\Models\CRM\Auditor;
use App\Models\CRM\Control;
use App\Models\CRM\Deal;
use App\Models\CRM\Delegate;
use App\Models\CRM\Installer;
use App\Models\CRM\Scale;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    // create scale 
    public function scaleCreate(Request $request){
        $scale = Scale::create($request->except(['_token','baremes_tab', 'product']));
        $scale->product()->attach($request->product);
        if($request->baremes_tab){
            return back()->with('success', __('Added Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega')->with('baremes_tab_activate', 'Travaux Tab bi active thakega');
        }else{ 
            return back()->with('success', __('Added Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega');
        }
    }
    
    // update scale 
    public function scaleUpdate(Request $request){
       
        if($request->active){
           $scale = Scale::find($request->id);
           $scale->update($request->except(['_token','baremes_tab','product']));
        }else
        {
           $scale = Scale::find($request->id);
           $scale->update($request->except(['_token','baremes_tab','product']) + ['active' => 'no']);
        }
        $scale->product()->sync($request->product);

        if($request->baremes_tab){
            return back()->with('success', __('Updated Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega')->with('baremes_tab_activate', 'Travaux Tab bi active thakega');
        }else{ 
            return back()->with('success', __('Updated Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega');
        }
        
    }
    
    // delete scale 
    public function scaleDelete(Request $request){
        Scale::find($request->id)->update(['deleted_status' => 'yes']);
        if($request->baremes_tab){
            return back()->with('success', __('Deleted Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega')->with('baremes_tab_activate', 'Travaux Tab bi active thakega');    
        }else{
            return back()->with('success', __('Deleted Succesfully'))->with('scale_active', 'hellow sam')->with('travaux_tab_activate', 'Travaux Tab bi active thakega');    

        }
    }

    // delegation create 
    public function delegateCreate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Delegate::create($request->except('token'));
        if($request->file('logo')){
            $logo = $request->file('logo');
            $filename = $data->id . rand(000,999) .'logo.'.$logo->extension();
            $path = ('uploads/delegate');
            $logo->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('delegate_tab_active', 'success');
    }

    

    // delegation update 
    public function delegateUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Delegate::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $logo = $request->file('logo');
            $filename = $data->id . rand(000,999) .'logo.'.$logo->extension();
            $path = ('uploads/delegate');
            $logo->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('delegate_tab_active', 'success');
    }



    // Delegate delete 
    public function delegateDelete(Request $request){
        Delegate::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('delegate_tab_active', 'success');
    }

    // Deal Create 
    public function dealCreate(Request $request)
    {
        Deal::create($request->except('_token'));
        return back()->with('success', __('Added Succesfully'))->with('deal_tab_active', 'mujhebi_active_karo');
    }
    
    // Deal Update 
    public function dealUpdate(Request $request){
        Deal::find($request->id)->update($request->except(['_token', 'id']));
        return back()->with('success', __('Updated Succesfully'))->with('deal_tab_active', 'mujhebi_active_karo');
    }
    
    // Deal Delete
    public  function dealDelete(Request $request)
    {
        Deal::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('deal_tab_active', 'mujhebi_active_karo');
    }

    // Installer Create 
    public function installerCreate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Installer::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/installer');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('installer_tab_active', 'active_karo');
    }

    // Installer update 
    public function installerUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Installer::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/installer');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('installer_tab_active', 'active_karo');
    }
    
    // Installer Delete 
    public function installerDelete(Request $request)
    {
        Installer::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('installer_tab_active', 'active_karo');

    }

    // AMO Create 
    public function amoCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Amo::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/amo');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('amo_tab_active', 'hoo_amio');

    }

      // AMO update 
      public function amoUpdate(Request $request)
      {
          $request->validate([
              'logo' => 'image',
          ]);
          $data = Amo::find($request->id);
          $data->update($request->except(['_token', 'id']));
          if($request->file('logo')){
              $image = $request->file('logo');
              $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
              $path = public_path('uploads/amo');
              $image->move($path, $filename);
              $data->logo = $filename;
              $data->save();
          }
  
          return back()->with('success', __('Updated Succesfully'))->with('amo_tab_active', 'hoo_amio');
      }


    // AMO Delete 
    public function amoDelete(Request $request)
    {
        Amo::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('amo_tab_active', 'hoo_amio');

    }
    // agent Create 
    public function agentCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Agent::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/agent');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('agent_tab_active', 'agent_tab');

    }

    // agent update 
    public function agentUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Agent::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/agent');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('agent_tab_active', 'agent_tab');
    }


    // agent Delete 
    public function agentDelete(Request $request)
    {
        Agent::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('agent_tab_active', 'agent_tab');

    }

    // auditor Create 
    public function auditorCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Auditor::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/auditor');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('auditor_tab_active', 'auditor_tab');

    }

    // auditor update 
    public function auditorUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Auditor::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/auditor');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('auditor_tab_active', 'auditor_tab');
    }


    // auditor Delete 
    public function auditorDelete(Request $request)
    {
        Auditor::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('auditor_tab_active', 'auditor_tab');

    }

    // area Create 
    public function areaCreate(Request $request){ 
        
        $data = Area::create($request->except('_token')); 
        return back()->with('success', __('Added Succesfully'))->with('area_tab_active', 'area_tab');

    }

    // area update 
    public function areaUpdate(Request $request)
    {
     
        $data = Area::find($request->id);
        $data->update($request->except(['_token', 'id'])); 

        return back()->with('success', __('Updated Succesfully'))->with('area_tab_active', 'area_tab');
    }


    // area Delete 
    public function areaDelete(Request $request)
    {
        Area::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('area_tab_active', 'area_tab');

    }

    // Area Color Update 
    public function areaColorUpdate(Request $request)
    {
        Area::find($request->id)->update(['color' => $request->color]);
        return response('success');
    }

    
    // control Create 
    public function controlCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Control::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/control');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('control_tab_active', 'control_tab');

    }

    // control update 
    public function controlUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Control::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/control');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('control_tab_active', 'control_tab');
    }


    // control Delete 
    public function controlDelete(Request $request)
    {
        Control::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('control_tab_active', 'control_tab');

    }
}
