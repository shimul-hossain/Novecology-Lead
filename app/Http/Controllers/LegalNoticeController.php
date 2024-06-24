<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\LegalNotice;
use Illuminate\Http\Request;

class LegalNoticeController extends Controller
{
    public function index(){
        $item = LegalNotice::first();
        return view('backoffice.legal-notice.index', compact('item')); 
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = LegalNotice::first();
        $item->update($request->except('_token'));
        
        return back()->with('success', 'Mis à jour avec succés');
    }
}
