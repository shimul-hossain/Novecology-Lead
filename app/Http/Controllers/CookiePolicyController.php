<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\CookiePolicy;
use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function index(){
        $item = CookiePolicy::first();
        return view('backoffice.cookie-policy.index', compact('item')); 
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = CookiePolicy::first();
        $item->update($request->except('_token'));
        
        return back()->with('success', 'Mis à jour avec succés');
    }
}
