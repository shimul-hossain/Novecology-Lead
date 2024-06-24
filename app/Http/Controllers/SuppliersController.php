<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $suppliers = Suppliers::latest()->get();
       return view('super_admin.suppliars.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.suppliars.create');
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

            'image' => 'required',
        ],[
            'image.required' => __('Image is required'),
        ]);

        $data = Suppliers::create($request->except('_token') + ['created_at' => Carbon::now()]);
        $image = $request->file('image');
        $filename = $data->id . '.' . $image->extension('image');
        $location = public_path('uploads/suppliers');
        $image->move($location,$filename);
        $data->image = $filename;
        $data->save();

        return redirect()->route('suppliers.index')->with('success', __('Added Succesfully'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $suppliers,$id)
    {
        $suppliers = Suppliers::find($id);
        return view('super_admin.suppliars.edit',compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers,$id)
    {
        $request->validate([

            'image' => 'required',
        ],[
            'image.required' => __('Image is required'),
        ]);

        $data = Suppliers::find($id);
        $image = $request->file('image');
        $filename = $data->id . '.' . $image->extension('image');
        $location = public_path('uploads/suppliers');
        $image->move($location,$filename);
        $data->image = $filename;
        $data->update();

        return redirect()->route('suppliers.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $suppliers,$id)
    {
        Suppliers::find($id)->delete();
        return redirect()->route('suppliers.index')->with('delete', __('Deleted Successfully'));
    }


    
}
