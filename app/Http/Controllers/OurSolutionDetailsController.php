<?php

namespace App\Http\Controllers;

use App\Models\OurSolution;
use App\Models\OurSolutionDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurSolutionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = OurSolutionDetails::orderBy('solution_id', 'ASC')->get();
        return view('super_admin.solution_details.index',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solutions = OurSolution::get();
        return view('super_admin.solution_details.create',compact('solutions'));
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
           'solution_id' => 'required',
           'question'    => 'required',
           'answer'      => 'required',
       ],[
           'solution_id.required'   => __('Solution is required'),
           'question.required'      => __('Question is required'),
           'answer.required'        => __('Answer is required'),
       ]);

       OurSolutionDetails::create($request->except('_token') + ['created_at' => Carbon::now()]);

       return redirect()->back()->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurSolutionDetails  $ourSolutionDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurSolutionDetails  $ourSolutionDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $details = OurSolutionDetails::where('solution_id',$id)->get();
        $solution = OurSolution::find($id);
        return view('super_admin.solution_details.edit',compact('details','solution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurSolutionDetails  $ourSolutionDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'solution_id' => 'required',
            'question'    => 'required',
            'answer'      => 'required',
        ],[
            'solution_id.required'   => __('Solution is required'),
            'question.required'      => __('Question is required'),
            'answer.required'        => __('Answer is required'),
        ]);
 
        $data = OurSolutionDetails::find($id);
        $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);
 
        return redirect()->back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurSolutionDetails  $ourSolutionDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OurSolutionDetails::find($id)->delete();
        return redirect()->route('solutionDetails.index')->with('delete', __('Deleted Successfully'));
    }
}
