<?php

namespace App\Http\Controllers;

use App\Models\OurSolution;
use App\Models\OurSolutionDetails;
use App\Models\SolutionResons;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SolutionReasonController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'our_solutions_id' => 'required',
            'title'            => 'required',
            'details'          => 'required',
            'image'            => 'required|image',
           
        ],[
            'our_solutions_id.required' => __('Our solution is required'),
            'title.required'            => __('title is required'), 
            'details.required'          => __('Description is required'), 
            'image.required'            => __('Image is required'), 
            'image.image'               => __('Image must be an image'), 
        ]);

        $data = SolutionResons::create($request->except('_token') + ['created_at'=> Carbon::now()]);

        $image = $request->file('image');

        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_solutionReasons');
            $image->move($location,$filename);
            $data->image = $filename;
            $data->update();
        }
        

        return back()->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdviceDetail  $adviceDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solutionReasons = SolutionResons::where('our_solutions_id',$id)->latest()->get();
        $ourSolution = OurSolution::find($id);

        return view('super_admin.solutions_reasons.index',compact('solutionReasons','ourSolution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdviceDetail  $adviceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdviceDetail  $adviceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'our_solutions_id' => 'required',
            'title'            => 'required',
            'details'          => 'required',
           
        ],[
            'our_solutions_id.required' => __('Our solution is required'),
            'title.required'            => __('title is required'), 
            'details.required'          => __('Description is required'), 
        ]);

        $data = SolutionResons::find($id);
        $data->update($request->except('_token') + ['updated_at'=> Carbon::now()]);

        $image = $request->file('image');
        if ($image) {
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/our_solutionReasons');
            $image->move($location,$filename);
            $data->image = $filename;
            $data->update();
        }

        return back()->with('update', __('Updated Successfully'));
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdviceDetail  $adviceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SolutionResons::find($id)->delete();
        return back()->with('delete', __('Deleted Successfully'));
        
    }
}
