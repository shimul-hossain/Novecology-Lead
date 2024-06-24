<?php

namespace App\Http\Controllers;

use App\Models\WorkWith;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkWithController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = WorkWith::get();
        return view('super_admin.workWith.index',compact('works'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('super_admin.workWith.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'details'       => 'required',
            'image'         => 'required|image',
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Description is required'),
            'image.required'    => __('Image is required'),
            'image.image'       => __('Image must be an image'),
        ]);

        
        $data = WorkWith::create($request->except('_token') + ['created_at' => Carbon::now()]);

        $image = $request->file('image'); 
        $filename = $data->id. '.' .$image->extension('image');
        $location = public_path('uploads/workwith'); 
        $image->move($location, $filename); 
        $data->image = $filename; 
        $data->save();

        return redirect()->route('workingwith.index')->with('success', __('Work with novecology added successfully'));



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkWith  $workWith
     * @return \Illuminate\Http\Response
     */
    public function show(WorkWith $workWith)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkWith  $workWith
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $workWith =WorkWith::find($id);
       return view('super_admin.workWith.edit',compact('workWith'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkWith  $workWith
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        echo "ok";
        $validated = $request->validate([
            'title'         => 'required',
            'details'       => 'required',
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Description is required'), 
        ]);

       $data = WorkWith::find($id);
       $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) 
        {
           $image = $request->file('image'); 
           $filename = $data->id. '.' .$image->extension('image');
           $location = public_path('uploads/workwith'); 
           $image->move($location, $filename); 
           $data->image = $filename; 
           $data->save();
        }

        
        return redirect()->route('workingwith.index')->with('success', __('Updated Successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkWith  $workWith
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = WorkWith::find($id);
        $work->delete();
        return redirect()->route('workingwith.index')->with('success', __('Deleted Successfully'));
    }
}
