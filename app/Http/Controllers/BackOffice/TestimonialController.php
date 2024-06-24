<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Testimonial;
use App\Models\BackOffice\TestimonialInfo;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::all();
        return view('backoffice.testimonials.index', compact('testimonials'));
    }

    public function create(){
        return view('backoffice.testimonials.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'embed_id' => 'required',
            'description' => 'required',
        ]);
        Testimonial::create($request->except('_token'));
        return redirect()->route('backoffice.testimonial.index')->with('success', 'Créé avec succès');
    }

    public function edit($id){
        $testimonial = Testimonial::find($id);
        return view('backoffice.testimonials.edit', compact('testimonial'));
    }

    
    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'embed_id' => 'required',
            'description' => 'required',
        ]);
        $testimonial = Testimonial::find($request->id);
        $testimonial->update($request->except('_token'));
        return redirect()->route('backoffice.testimonial.index')->with('success', 'Mis à jour avec succés');
    }

    public function delete(Request $request){
        $testimonial = Testimonial::find($request->id);
        if($testimonial){
            $testimonial->delete();
        }
        return back()->with('success', 'Supprimé avec succès');;
    }
    public function info(){
        $info = TestimonialInfo::first();
        return view('backoffice.testimonials.info', compact('info'));
    }
    public function infoUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'right_side_image' => 'image',
            'home_page_title' => 'required',
            'home_page_button_text' => 'required',
        ]);

        $info = TestimonialInfo::first();
        $info->update($request->except('_token'));
        if($request->file('right_side_image')){
            $image = $request->file('right_side_image');
            $imageName = 'info-'.time().'.'.$image->extension();
            $image->move(public_path('uploads/new/testimonial'), $imageName);
            $info->right_side_image = $imageName;
            $info->save();
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
}
