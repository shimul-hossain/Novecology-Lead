<?php

namespace App\Http\Controllers;


use App\Models\OurSolution;
use App\Models\OurSolutionDetails;
use App\Models\SolutionResons;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OurSolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ourSolution = OurSolution::latest()->get();
      return view('super_admin.our_solution.index',compact('ourSolution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.our_solution.create');
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

            'title'    => 'required',
            'subtitle' => 'required',
            'image'    => 'required|image',
            'category' => 'required',
        ],[
            'title.required'        => __('Title is required'),
            'subtitle.required'     => __('Subtitle is required'),
            'image.required'        => __('Image is required'),
            'image.image'           => __('Image must be an image'),
            'category.required'     => __('Category is required'),
        ]);

   
      

        $data = OurSolution::create($request->except('_token','question','answer','reason_image','reason_details','reason_title') + ['created_at' => Carbon::now()]);

       

           $image = $request->file('image');
          
     
            $filename = $data->id . time().'.' . $image->extension();
            $location = public_path('uploads/our_solution');
            $image->move($location,$filename);
            $data->image = $filename;
            $data->update();
             
            // foreach ($request->question as $key => $value) 
            // {
                
            //     OurSolutionDetails::create([

            //         'question' => $value, 
            //         'answer'   => $request->answer[$key], 
            //         'solution_id' => $data->id, 

            //     ]);

            //  }
            

            // foreach ($request->reason_title as $key => $value) 
            // {
                
            //     $reason_image = $request->file('reason_image')[$key];
                
            //     $filename = hexdec(uniqid()) . '.' . $reason_image->extension();
            //     $location = public_path('uploads/our_solutionReasons');
            //     $reason_image->move($location,$filename);
               
            //     SolutionResons::create([

            //         'title'       => $value, 
            //         'details'     => $request->reason_details[$key], 
            //         'image'       => $filename, 
            //         'our_solutions_id' => $data->id, 

            //     ]);

            //  }



        return redirect()->route('ourSolutions.index')->with('success', __('Created Successfully'));

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurSolution  $ourSolution
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $solution         = OurSolution::find($id);
       $solution_details = OurSolutionDetails::where('solution_id',$solution->id)->get();
       $solution_reasons = SolutionResons::where('our_solutions_id',$solution->id)->get();

       return view('super_admin.our_solution.details',compact('solution','solution_details','solution_reasons'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurSolution  $ourSolution
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ourSolution = OurSolution::find($id);
       return view('super_admin.our_solution.edit',compact('ourSolution'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurSolution  $ourSolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([

            'title'         => 'required',
            'image'         => 'image',
            'category'      => 'required',
            'subtitle'      => 'required',
          
        ],[
            'title.required'        => __('Title is required'),
            'subtitle.required'     => __('Subtitle is required'),
            'category.required'     => __('Category is required'),
            'image.image'           => __('Image must be an image'),
        ]);

        $data = OurSolution::find($id);

        $data->title         = $request->title;
        $data->category      = $request->category;
        $data->subtitle      = $request->subtitle;
        $data->short_details = $request->short_details;

        $image = $request->file('image');
        if ($image) {
            $filename = $data->id .time().'.' . $image->extension();
            $location = public_path('uploads/our_solution');
            $image->move($location,$filename);
            $data->image = $filename;
        }
        
        $data->save();
        return redirect()->route('ourSolutions.index')->with('update', __('Updated Successfully'));
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurSolution  $ourSolution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $details = OurSolutionDetails::where('solution_id',$id)->get();

        if ($details != null) 
        {
            foreach ($details  as $item) 
            {
                $item->delete();
            }
        }

        $reason = SolutionResons::where('our_solutions_id', $id)->get();
        if ($reason != null) 
        {
            foreach ($reason as $item) 
            {
                $item->delete();
            }
        }

        OurSolution::find($id)->delete();
        return redirect()->route('ourSolutions.index')->with('delete', __('Deleted Successfully'));
    }


    
}
