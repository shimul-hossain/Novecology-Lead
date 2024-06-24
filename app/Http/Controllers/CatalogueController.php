<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CRM\Benefit;
use App\Models\CRM\ClientCompany;
use App\Models\CRM\Fournisseur;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    // brand Create 
    public function brandCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Brand::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/brand');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('brand_tab_active', 'brand_tab');

    }

    // brand update 
    public function brandUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Brand::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/brand');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('brand_tab_active', 'brand_tab');
    }


    // brand Delete 
    public function brandDelete(Request $request)
    {
        Brand::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('brand_tab_active', 'brand_tab');

    }

    // benefit Create 
    public function benefitCreate(Request $request){ 

        $data = Benefit::create($request->except(['_token','operation'])); 
        if($request->operation){
            $selected = '';
            $count = count($request->operation);
            foreach($request->operation as $key => $operation)
            {
                $selected .= $operation. ($count != $key+1 ? ',':'');
            }
            $data->operation = $selected;
        }
        $data->save();
        return back()->with('success', __('Added Succesfully'))->with('benefit_tab_active', 'benefit_tab');

    }

    // benefit update 
    public function benefitUpdate(Request $request)
    { 
        $data = Benefit::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if(!$request->reference_link){
            $data->reference_link = 'off';
        }
        if(!$request->designation_link){
            $data->designation_link = 'off';
        }
        if(!$request->related_price){
            $data->related_price = 'off';
        }
        if(!$request->active){
            $data->active = 'off';
        }
        if(!$request->price_show){
            $data->price_show = 'off';
        }
         
        if(!$request->recall){
            $data->recall = 'off';
        }
        $selected = '';
        if($request->operation){
            $count = count($request->operation);
            foreach($request->operation as $key => $operation)
            {
                $selected .= $operation. ($count != $key+1 ? ',':'');
            }
        }
        $data->operation = $selected;
        $data->save();
         

        return back()->with('success', __('Updated Succesfully'))->with('benefit_tab_active', 'benefit_tab');
    }


    // benefit Delete 
    public function benefitDelete(Request $request)
    {
        Benefit::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('benefit_tab_active', 'benefit_tab');

    }

    // fournesser Create 
    public function fournesserCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Fournisseur::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/fournesser');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('fournesser_tab_active', 'fournesser_tab');

    }

    // fournesser update 
    public function fournesserUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = Fournisseur::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/fournesser');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('fournesser_tab_active', 'fournesser_tab');
    }


    // fournesser Delete 
    public function fournesserDelete(Request $request)
    {
        Fournisseur::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('fournesser_tab_active', 'fournesser_tab');

    }
    // client_company Create 
    public function client_companyCreate(Request $request){ 
        $request->validate([
            'logo' => 'image',
        ]);
        $data = ClientCompany::create($request->except('_token'));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/client_company');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Added Succesfully'))->with('client_company_tab_active', 'client_company_tab');

    }

    // client_company update 
    public function client_companyUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image',
        ]);
        $data = ClientCompany::find($request->id);
        $data->update($request->except(['_token', 'id']));
        if($request->file('logo')){
            $image = $request->file('logo');
            $filename = $data->id. rand(000,999) .'logo.'. $image->extension();
            $path = public_path('uploads/client_company');
            $image->move($path, $filename);
            $data->logo = $filename;
            $data->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('client_company_tab_active', 'client_company_tab');
    }


    // client_company Delete 
    public function client_companyDelete(Request $request)
    {
        ClientCompany::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('client_company_tab_active', 'client_company_tab');

    }
}
