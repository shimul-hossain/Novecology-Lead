<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    public function index(){
        $value = Value::first();  
        return view('backoffice.value.index', compact('value'));
    }

    public function update(Request $request){
        $request->validate([    
            'first_block_title' => 'required',  
            'first_block_description' => 'required',  
            'first_block_image' => 'image',  
            'second_block_title' => 'required',  
            'second_block_short_description' => 'required',  
            'second_block_long_description' => 'required',  
            'second_block_image' => 'image',  
            'third_block_title' => 'required',  
            'third_block_short_description' => 'required',  
            'third_block_long_description' => 'required',  
            'third_block_image' => 'image',  
            'fourth_block_title' => 'required',  
            'fourth_block_description' => 'required',  
            'fourth_block_image' => 'image',  
            'fifth_block_title' => 'required',  
            'fifth_block_short_description' => 'required',  
            'fifth_block_long_description' => 'required',    
            'fifth_block_image' => 'image',    
        ]);
        // dd($request->all());

        $path = public_path('uploads/new/value');
        $value = Value::first();
        $value->update($request->except('_token')); 
 
        
        if($request->file('first_block_image')){
            $first_block_image = $request->file('first_block_image'); 
            $first_block_imageName = 'first_block_image-'.$value->id.rand(0000000000,9999999999).'.'.$first_block_image->extension();
            $first_block_image->move($path, $first_block_imageName);
            $value->first_block_image = $first_block_imageName;
        } 
        if($request->file('second_block_image')){
            $second_block_image = $request->file('second_block_image'); 
            $second_block_imageName = 'second_block_image-'.$value->id.rand(0000000000,9999999999).'.'.$second_block_image->extension();
            $second_block_image->move($path, $second_block_imageName);
            $value->second_block_image = $second_block_imageName;
        } 
        if($request->file('third_block_image')){
            $third_block_image = $request->file('third_block_image'); 
            $third_block_imageName = 'third_block_image-'.$value->id.rand(0000000000,9999999999).'.'.$third_block_image->extension();
            $third_block_image->move($path, $third_block_imageName);
            $value->third_block_image = $third_block_imageName;
        }
        if($request->file('fourth_block_image')){
            $fourth_block_image = $request->file('fourth_block_image'); 
            $fourth_block_imageName = 'fourth_block_image-'.$value->id.rand(0000000000,9999999999).'.'.$fourth_block_image->extension();
            $fourth_block_image->move($path, $fourth_block_imageName);
            $value->fourth_block_image = $fourth_block_imageName;
        }
        if($request->file('fifth_block_image')){
            $fifth_block_image = $request->file('fifth_block_image'); 
            $fifth_block_imageName = 'fifth_block_image-'.$value->id.rand(0000000000,9999999999).'.'.$fifth_block_image->extension();
            $fifth_block_image->move($path, $fifth_block_imageName);
            $value->fifth_block_image = $fifth_block_imageName;
        }
       
        
        $value->save();
 

        return back()->with('success', 'Mis à jour avec succés');
    }
}
