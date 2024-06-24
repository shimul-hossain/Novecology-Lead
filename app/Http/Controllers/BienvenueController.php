<?php

namespace App\Http\Controllers;

use App\Models\Bienvenue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class BienvenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dienvenue = Bienvenue::first();
        return view('super_admin.bienvenue.index',compact('dienvenue'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bienvenue  $bienvenue
     * @return \Illuminate\Http\Response
     */
    public function show(Bienvenue $bienvenue)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bienvenue  $bienvenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Bienvenue $bienvenue)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bienvenue  $bienvenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'bienvenue'    => 'required',
        ],[
            'bienvenue.required'    => __('Bienvenue is required'), 
        ]);

        $bienvenue = Bienvenue::find($id);

        // $video = $request->file('video'); 
        // if ($video) 
        // {
        //     $filename = $bienvenue->id. '-video.' .$video->extension('video');
        //     $location = public_path('uploads/bienvenue'); 
        //     $video->move($location, $filename); 
        //     $bienvenue->video = $filename; 
        // }
  

        $bienvenue->video = $request->bienvenue;
        $bienvenue->bienvenue_text = $request->bienvenue_text;
        $bienvenue->update();

        return back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bienvenue  $bienvenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bienvenue $bienvenue)
    {
        //
    }
}
