<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\DroitOpposition;
use Illuminate\Http\Request;

class DroitOppositionController extends Controller
{
    public function index(){
        $item = DroitOpposition::first();
        return view('backoffice.droit.index', compact('item')); 
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = DroitOpposition::first();
        $item->update($request->except('_token'));
        
        return back()->with('success', 'Mis à jour avec succés');
    }
}
