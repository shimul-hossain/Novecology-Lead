<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\AuditEnergetique;
use App\Models\BackOffice\AuditEnergetiqueThirdBlockInfo;
use Illuminate\Http\Request;

class AuditEnergetiqueController extends Controller
{
    public function index(){
        $item = AuditEnergetique::first();
        $infos = AuditEnergetiqueThirdBlockInfo::all();
        return view('backoffice.audit-energetique.index', compact('item', 'infos'));
    }

    public function update(Request $request){
        $request->validate([    
            'banner_title' => 'required',  
            'banner_subtitle' => 'required',  
            'banner_description' => 'required',  
            'banner_button_text' => 'required',    
            'banner_image' => 'image',  
            'title' => 'required',  
            'description' => 'required',  
            'first_block_title' => 'required',  
            'first_block_image' => 'image',  
            'first_block_desciption' => 'required',  
            'first_block_button_text' => 'required',   
            'second_block_title' => 'required',  
            'second_block_image' => 'image',  
            'second_block_desciption' => 'required',  
            'second_block_button_text' => 'required',   
            'third_block_title' => 'required',  
        ]);
        // dd($request->all());

        $path = public_path('uploads/new/audit-energetique');
        $item = AuditEnergetique::first();
        $item->update($request->except('_token')); 
        if($request->x_third_block_id){
            AuditEnergetiqueThirdBlockInfo::whereNotIn('id', $request->x_third_block_id)->get()->each->delete();
        }
        foreach($request->third__title as $key => $third_value){
            $third_block = AuditEnergetiqueThirdBlockInfo::where('id', $key)->first();
            if($third_block){
                $third_block->update([
                    'title' => $third_value, 
                    'description' => $request->third__description[$key] ?? '',
                ]);
            }else{
                $third_block = AuditEnergetiqueThirdBlockInfo::create([ 
                    'title' => $third_value,
                    'image' => 'image.jpg',
                    'description' => $request->third__description[$key] ?? '',
                ]);
            } 
            if(isset($request->file('third__image')[$key])){
                $image = $request->file('third__image')[$key]; 
                $thirdImage = 'third__image-'.$item->id.rand(0000000000,9999999999).'.'.$image->extension();
                $image->move($path, $thirdImage);
                $third_block->image = $thirdImage;
                $third_block->save();
            }
        }   
        if($request->file('first_block_image')){
            $first_block_image = $request->file('first_block_image'); 
            $firstBlockName = 'first_block-'.$item->id.rand(0000000000,9999999999).'.'.$first_block_image->extension();
            $first_block_image->move($path, $firstBlockName);
            $item->first_block_image = $firstBlockName;
        }
        if($request->file('second_block_image')){
            $second_block_image = $request->file('second_block_image'); 
            $secondBlockName = 'second_block-'.$item->id.rand(0000000000,9999999999).'.'.$second_block_image->extension();
            $second_block_image->move($path, $secondBlockName);
            $item->second_block_image = $secondBlockName;
        }
        if($request->file('banner_image')){
            $banner_image = $request->file('banner_image'); 
            $bannerName = 'banner-'.$item->id.rand(0000000000,9999999999).'.'.$banner_image->extension();
            $banner_image->move($path, $bannerName);
            $item->banner_image = $bannerName;
        }
        
        $item->save();
 

        return back()->with('success', 'Mis à jour avec succés');
    }
}
