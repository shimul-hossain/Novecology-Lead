<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $item = PrivacyPolicy::first();
        return view('backoffice.privacy-policy.index', compact('item')); 
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = PrivacyPolicy::first();
        $item->update($request->except('_token'));
        
        return back()->with('success', 'Mis à jour avec succés');
    }
}
