<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackOffice\BandeauInformation;

class BandeauInformationController extends Controller
{
    public function index(){
        $item = BandeauInformation::first();
        return view('backoffice.bandeau.index', compact('item')); 
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = BandeauInformation::first();
        $item->update($request->except('_token'));
        
        return back()->with('success', 'Mis à jour avec succés');
    }
}
