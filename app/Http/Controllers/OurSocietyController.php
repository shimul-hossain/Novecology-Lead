<?php

namespace App\Http\Controllers;

use App\Models\OurSociety;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurSocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $societies = OurSociety::latest()->get();
        return view('super_admin.our_society.index',compact('societies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.our_society.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'details' => 'required',
            'image'   => 'image',
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Description is required'),
            'image.image'       => __('Image must be an image'),
        ]);

        $data = OurSociety::create($request->except('_token') + ['created_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_society');
            $image->move($location,$filename);
            $data->image = $filename;
    
            $data->save();
        }


        $image2 = $request->file('image2');

        if ($image2) {
            $filename = $data->id . '-logo1.' . $image2->extension('image2');
            $location = public_path('uploads/our_society');
            $image2->move($location,$filename);
            $data->image2 = $filename;
    
            $data->save();
        }


        $image3 = $request->file('image3');

        if ($image3) {
            $filename = $data->id . '-logo2.' . $image3->extension('image3');
            $location = public_path('uploads/our_society');
            $image3->move($location,$filename);
            $data->image3 = $filename;
    
            $data->save();
        }



        $image3 = $request->file('image3');

        if ($image3) {
            $filename = $data->id . '-logo3.' . $image3->extension('image3');
            $location = public_path('uploads/our_society');
            $image3->move($location,$filename);
            $data->image3 = $filename;
    
            $data->save();
        }
       

        return redirect()->route('ourSocieties.index')->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurSociety  $ourSociety
     * @return \Illuminate\Http\Response
     */
    public function show(OurSociety $ourSociety)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurSociety  $ourSociety
     * @return \Illuminate\Http\Response
     */
    public function edit(OurSociety $ourSociety)
    {
        return view('super_admin.our_society.edit',compact('ourSociety'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurSociety  $ourSociety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurSociety $ourSociety)
    {
        $request->validate([
            'title'   => 'required',
            'details' => 'required',
           
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Description is required'), 
        ]);

        $ourSociety->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $ourSociety->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_society');
            $image->move($location,$filename);
            $ourSociety->image = $filename;
            $ourSociety->update();
        }

     

        return redirect()->route('ourSocieties.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurSociety  $ourSociety
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurSociety $ourSociety)
    {
        $ourSociety->delete();

        return redirect()->route('ourSocieties.index')->with('delete', __('Deleted Successfully'));
    }
}
