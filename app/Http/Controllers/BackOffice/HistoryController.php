<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\History;
use App\Models\BackOffice\HistoryThirdBlockInfo;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $history = History::first();  
        $infos = HistoryThirdBlockInfo::all();
        return view('backoffice.history.index', compact('history', 'infos'));
    }

    public function update(Request $request){
        $request->validate([    
            'first_block_title' => 'required',  
            'first_block_description' => 'required',  
            'first_block_image' => 'image',  
            'second_block_title' => 'required',  
            'second_block_description' => 'required',  
            'second_block_image' => 'image',  
            'third_block_title' => 'required',  
            'third_block_description' => 'required',  
            'third_block_image' => 'image',    
        ]);
        // dd($request->all());

        $path = public_path('uploads/new/history');
        $history = History::first();
        $history->update($request->except('_token')); 

        if($request->x_third_block_id){
            HistoryThirdBlockInfo::whereNotIn('id', $request->x_third_block_id)->get()->each->delete();
        }
        foreach($request->icon as $key => $third_value){
            $third_block = HistoryThirdBlockInfo::where('id', $key)->first();
            if($third_block){
                $third_block->update([
                    'icon' => $third_value, 
                    'description' => $request->description[$key] ?? '',
                ]);
            }else{
                $third_block = HistoryThirdBlockInfo::create([ 
                    'icon' => $third_value, 
                    'description' => $request->description[$key] ?? '',
                ]);
            }  
        }
        
        if($request->file('first_block_image')){
            $first_block_image = $request->file('first_block_image'); 
            $first_block_imageName = 'first_block_image-'.$history->id.rand(0000000000,9999999999).'.'.$first_block_image->extension();
            $first_block_image->move($path, $first_block_imageName);
            $history->first_block_image = $first_block_imageName;
        } 
        if($request->file('second_block_image')){
            $second_block_image = $request->file('second_block_image'); 
            $second_block_imageName = 'second_block_image-'.$history->id.rand(0000000000,9999999999).'.'.$second_block_image->extension();
            $second_block_image->move($path, $second_block_imageName);
            $history->second_block_image = $second_block_imageName;
        } 
        if($request->file('third_block_image')){
            $third_block_image = $request->file('third_block_image'); 
            $third_block_imageName = 'third_block_image-'.$history->id.rand(0000000000,9999999999).'.'.$third_block_image->extension();
            $third_block_image->move($path, $third_block_imageName);
            $history->third_block_image = $third_block_imageName;
        }
       
        
        $history->save();
 

        return back()->with('success', 'Mis à jour avec succés');
    }
}
