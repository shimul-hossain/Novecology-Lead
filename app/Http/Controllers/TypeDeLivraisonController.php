<?php

namespace App\Http\Controllers;

use App\Models\CRM\TypeDeLivraison;
use Illuminate\Http\Request;

class TypeDeLivraisonController extends Controller
{
    public function typeDeLivraisonCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        TypeDeLivraison::create([
            'name' => $request->name, 
        ]);
        
        return back()->with('success', __('Created Successfully'));
        
    }
    public function typeDeLivraisonUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = TypeDeLivraison::find($request->id);
        $data->update([
            'name' => $request->name, 
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
    
    public function typeDeLivraisonDelete(Request $request){ 
        $data = TypeDeLivraison::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'));
    } 
}
