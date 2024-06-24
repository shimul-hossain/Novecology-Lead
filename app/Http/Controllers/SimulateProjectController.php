<?php

namespace App\Http\Controllers;

use App\Exports\DefaultExport;
use App\Models\SimulateProject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SimulateProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SimulateProject::latest()->get();

        return view('super_admin.simulate_project_request.index',compact('data'));
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
     * @param  \App\Models\SimulateProject  $simulateProject
     * @return \Illuminate\Http\Response
     */
    public function show(SimulateProject $simulateProject,$id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimulateProject  $simulateProject
     * @return \Illuminate\Http\Response
     */
    public function edit(SimulateProject $simulateProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimulateProject  $simulateProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SimulateProject $simulateProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimulateProject  $simulateProject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $simulation_request = SimulateProject::find($id);
        $simulation_request->delete();

        return redirect()->route('simulateProjects.index')->with('delete', __('Deleted Successfully'));
    }


    public function projectBulkDownload(Request $request){

        if($request->is_all == '1'){
            $ids = SimulateProject::all()->pluck('id')->toArray() ; 
        }else{
            $ids = explode(',', $request->selected_id); 
        }

        if ($request->first_name != null) {
            $header [] = __('First Name');
        } 
        
        if ($request->email != null) {
            $header [] = __('Email');
        }
        
        if ($request->address != null) {
            $header [] = __('Address');
        }
         

        $data =  SimulateProject::whereIn('id',$ids)->get()->map(function($project) use ($request){
 
            $field = []; 
 
            if ($request->first_name != null) {
                $field ['first_name'] = $project->first_name;
            } 
            if ($request->email != null) {
                $field ['email'] = $project->email;
            } 
            if ($request->address != null) {
                $field ['address'] = $project->address;
            }  

            return $field;
        });

        return Excel::download(new DefaultExport($header,$data), 'download.xlsx');
       
    }

    public function projectBulkDelete(Request $request){
        if($request->selected_id){
            $ids = explode(',', $request->selected_id); 
            SimulateProject::findMany($ids)->each->delete();
        }

        $header = [];

        return back()->with('success', __('Deleted Successfully'));
    }
}
