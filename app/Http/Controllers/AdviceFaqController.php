<?php

namespace App\Http\Controllers;

use App\Models\AdviceAndGrants;
use App\Models\AdviceFaq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdviceFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
        ],[
            'question.required'    => __('Question is required'),
            'answer.required'      => __('Answer is required'),
            
        ]);

        $data = new AdviceFaq();

        $data->advice_id = $request->advice_id;
        $data->question  = $request->question;
        $data->answer    = $request->answer;
        $data->save();

        return back()->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdviceFaq  $adviceFaq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $adviceFaq     = AdviceFaq::where('advice_id',$id)->get();
       $adviceDetails = AdviceAndGrants::find($id);
       
       return view('super_admin.advice_&_grants.faq',compact('adviceFaq','adviceDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdviceFaq  $adviceFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(AdviceFaq $adviceFaq)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdviceFaq  $adviceFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
        ],[
            'question.required'    => __('Question is required'),
            'answer.required'      => __('Answer is required'),
            
        ]);

        $data = AdviceFaq::find($id);
        $data->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        return back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdviceFaq  $adviceFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adviceFaq = AdviceFaq::find($id)->delete();

        return back()->with('delete', __('Deleted Successfully'));
    }
}
