<?php

namespace App\Http\Controllers;

use App\Models\ClintOpinion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ClintOpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clintOpinions = ClintOpinion::latest()->get();
        return view('super_admin.clint_opinion.index',compact('clintOpinions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.clint_opinion.create');
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

            'name'    => 'required',
            'opinion' => 'required',

        ],[
            'name.required'         => __('Name is required'),
            'opinion.required'      => __('Description is required'),
        ]);

        
        ClintOpinion::create($request->except('_token') + ['created_at' => Carbon::now()]);

        return redirect()->route('clintOpinions.index')->with('success', __('Created Successfully'));
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClintOpinion  $clintOpinion
     * @return \Illuminate\Http\Response
     */
    public function show(ClintOpinion $clintOpinion)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClintOpinion  $clintOpinion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $clintOpinions = ClintOpinion::find($id);

       
        return view('super_admin.clint_opinion.edit',compact('clintOpinions'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClintOpinion  $clintOpinion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'name'  => 'required',
            'opinion' => 'required',

        ],[
            'name.required'         => __('Name is required'),
            'opinion.required'      => __('Description is required'),
        ]);

        ClintOpinion::find($id)->update($request->except('_token') + ['updated_at' => Carbon::now()]);

        return redirect()->route('clintOpinions.index')->with('update', __('Updated Successfully'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClintOpinion  $clintOpinion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClintOpinion::find($id)->delete();
        return redirect()->route('clintOpinions.index')->with('delete', __('Deleted Successfully'));
    }

    public function googleReview(Request $request){

        // ClintOpinion::truncate();
        foreach(json_decode($request->getContent(), true) as $data)
        {
            try{
                ClintOpinion::create([
                    'name' => $data['name'],
                    'opinion' => $data['description'],
                    'image' => $data['image'], 
                    'uid'   => $data['uid'],
                    'rating'   => $data['rating'] ?? null,
                    'publish_date'   => $data['publish_date'] ?? null,
                ]);
            }catch(Exception $e){
               return response()->json('error', $e->getMessage());
            }
           }

        return response()->json(['success' => 'Google Reviewed Successfully']);
    }

    public function getUid()
    {
        $uid = ClintOpinion::all()->pluck('uid')->toArray();

        return response()->json($uid);
    }
    
}
