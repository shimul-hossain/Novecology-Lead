<?php

namespace App\Http\Controllers;

use App\Models\OurService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourService = OurService::latest()->get();
        return view('super_admin.our_service.index',compact('ourService'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.our_service.create');
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

        $data = OurService::create($request->except('_token') + ['created_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_service');
            $image->move($location,$filename);
            $data->image = $filename;
    
            $data->save();
        }
       

        return redirect()->route('ourService.index')->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function show(OurService $ourService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ourService = OurService::find($id);
        return view('super_admin.our_service.edit',compact('ourService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required',
            'details' => 'required',
           
        ],[
            'title.required'    => __('Title is required'),
            'details.required'  => __('Description is required'), 
        ]);

        $data = OurService::find($id);
        $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_service');
            $image->move($location,$filename);
            $data->image = $filename;
            $data->update();
        }


        return redirect()->route('ourService.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurService  $ourService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OurService::find($id)->delete();

        return redirect()->back()->with('delete', __('Deleted Successfully'));
    }
}
