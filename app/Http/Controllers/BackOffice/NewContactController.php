<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\NewContact;
use Illuminate\Http\Request;

class NewContactController extends Controller
{
    public function index(){
        $item = NewContact::first(); 
        return view('backoffice.contact.index', compact('item'));
    }

    public function update(Request $request){
        $request->validate([    
            'title' => 'required',  
            'subtitle' => 'required',  
            'description' => 'required',
            'image' => 'image',    
        ]);
        // dd($request->all());

        $path = public_path('uploads/new/contact');
        $item = NewContact::first();
        $item->update($request->except('_token')); 
        
        if($request->file('image')){
            $image = $request->file('image'); 
            $bannerName = 'image-'.$item->id.rand(0000000000,9999999999).'.'.$image->extension();
            $image->move($path, $bannerName);
            $item->image = $bannerName;
        }
        
        $item->save();
 

        return back()->with('success', 'Mis à jour avec succés');
    }
}
