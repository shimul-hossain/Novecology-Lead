<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\ServiceFeature;
use Illuminate\Http\Request;

class ServiceFeatureController extends Controller
{
    public function index(){
        $features = ServiceFeature::all();
        return view('backoffice.features.index', compact('features'));
    }

    public function store(Request $request){
        $request->validate([
            'icon_link' => 'required',
            'description' => 'required',
        ]);

        ServiceFeature::create($request->except('_token'));

        return back()->with('success', 'Créé avec succès');
    }

    public function update(Request $request){
        $request->validate([
            'icon_link' => 'required',
            'description' => 'required',
        ]);

        $service = ServiceFeature::find($request->id);
        $service->update($request->except('_token'));

        return back()->with('success', 'Mis à jour avec succés');
    }

    public function delete(Request $request){

        $service = ServiceFeature::find($request->id);
        if($service){
            $service->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }
}
