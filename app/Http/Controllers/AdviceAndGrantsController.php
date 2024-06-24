<?php

namespace App\Http\Controllers;

use App\Models\AdviceAndGrants;
use App\Models\AdviceFaq;
use App\Models\GrantCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdviceAndGrantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advices = AdviceAndGrants::latest()->get();
        
        return view('super_admin.advice_&_grants.index',compact('advices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = GrantCategory::all();
        return view('super_admin.advice_&_grants.create',compact('categories'));
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

            'title'       => 'required',
            'details'     => 'required',
            'thumbnail'   => 'required|image',
            'image1'      => 'required|image',
            'image2'      => 'required|image',
            'image3'      => 'required|image',
            'image4'      => 'required|image',
            'category_id' => 'required',
            'og_image'    => 'image',
        ],[
            'title.required'        => __('Title is required'),
            'details.required'      => __('Details is required'),
            'thumbnail.required'    => __('Thumbnail is required'),
            'thumbnail.image'       => __('Thumbnail must be an image'),
            'image1.required'       => __('First image is required'),
            'image1.image'          => __('First image must be an image'),
            'image2.required'       => __('Second image is required'),
            'image2.image'          => __('Second image must be an image'),
            'image3.required'       => __('Third image is required'),
            'image3.image'          => __('Third image must be an image'),
            'image4.required'       => __('Forth image is required'),
            'image4.image'          => __('Forth image must be an image'),
            'category_id.required'  => __('Category is required'),
        ]);

        


        $data = AdviceAndGrants::create($request->except('_token','og_image') + ['created_at' => Carbon::now()]);

    

        $thumbnail = $request->file('thumbnail');
            $filenameth = $data->id . '-thumbnail.' . $thumbnail->extension('thumbnail');
            $location = public_path('uploads/our_advice');
            $thumbnail->move($location,$filenameth);
            $data->thumbnail = $filenameth;

        $image1 = $request->file('image1');
            $filename1 = $data->id . '-image1.' . $image1->extension('image1');
            $location = public_path('uploads/our_advice');
            $image1->move($location,$filename1);
            $data->image1 = $filename1;
    
       

        $image2 = $request->file('image2');
            $filename2 = $data->id . '-image2.' . $image2->extension('image2');
            $location = public_path('uploads/our_advice');
            $image2->move($location,$filename2);
            $data->image2 = $filename2;
    
          
      
        
        $image3 = $request->file('image3');
            $filename3 = $data->id . '-image3.' . $image3->extension('image3');
            $location = public_path('uploads/our_advice');
            $image3->move($location,$filename3);
            $data->image3 = $filename3;


        $image4 = $request->file('image4');
            $filename4 = $data->id . '-image4.' . $image4->extension('image4');
            $location = public_path('uploads/our_advice');
            $image4->move($location,$filename4);
            $data->image4 = $filename4;


            if ($request->has('og_image')) {

                $og_image = $request->file('og_image');
                $filename4 = $data->id . '-og_image.' . $og_image->extension('og_image');
                $location = public_path('uploads/our_advice');
                $og_image->move($location,$filename4);
                $data->og_image = $filename4;
            }
    
        
        $data->save();
     
      return redirect()->route('adviceGrants.index')->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdviceAndGrants  $adviceAndGrants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adviceDetails =AdviceAndGrants::find($id);

        return view('super_admin.advice_&_grants.details',compact('adviceDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdviceAndGrants  $adviceAndGrants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advice = AdviceAndGrants::find($id);
        $categories = GrantCategory::all();

        return view('super_admin.advice_&_grants.edit',compact('advice','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdviceAndGrants  $adviceAndGrants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'title'    => 'required',
            'details'  => 'required',
            'thumbnail'=> 'image',
            'image1'   => 'image',
            'image2'   => 'image',
            'image3'   => 'image',
            'image4'   => 'image',
            'og_image' => 'image',
        ],[
            'title.required'        => __('Title is required'),
            'details.required'      => __('Details is required'), 
            'thumbnail.image'       => __('Thumbnail must be an image'), 
            'image1.image'          => __('First image must be an image'), 
            'image2.image'          => __('Second image must be an image'), 
            'image3.image'          => __('Third image must be an image'), 
            'image4.image'          => __('Forth image must be an image'), 
        ]);


        $data = AdviceAndGrants::find($id);
        $data->update($request->except('_token','og_image') + ['updated_at' => Carbon::now()]);

        $thumbnail = $request->file('thumbnail');

        if ($thumbnail) 
        {

            $filenameth = $data->id . '-thumbnail.' . $thumbnail->extension('thumbnail');
            $location = public_path('uploads/our_advice');
            $thumbnail->move($location,$filenameth);
            $data->thumbnail = $filenameth;
            $data->save();
        }


        $image1 = $request->file('image1');

        if ($image1) 
        {
            
            $filename1 = $data->id . '-image1.' .time(). '.' .  $image1->extension('image1');
            $location = public_path('uploads/our_advice');
            $image1->move($location,$filename1);
            $data->image1 = $filename1;
            $data->save();
        }

    
       

        $image2 = $request->file('image2');

        if ($image2) {
            
            $filename2 = $data->id . '-image2.' .time(). '.' . $image2->extension('image2');
            $location = public_path('uploads/our_advice');
            $image2->move($location,$filename2);
            $data->image2 = $filename2;
            $data->save();
        }

    
          
      
        
        $image3 = $request->file('image3');

        if ($image3) {
            
            $filename3 = $data->id . '-image3' .time(). '.' . $image3->extension('image3');
            $location = public_path('uploads/our_advice');
            $image3->move($location,$filename3);
            $data->image3 = $filename3;
            $data->save();
        }



        
        $image4 = $request->file('image4');

        if ($image4) {
            
            $filename4 = $data->id . '-image4.' .time(). '.' .  $image4->extension('image4');
            $location = public_path('uploads/our_advice');
            $image4->move($location,$filename4);
            $data->image4 = $filename4;
            $data->save();
        }


        if ($request->has('og_image')) {

            $og_image = $request->file('og_image');
            $og_image_name = $data->id . '-og_image.' . $og_image->extension('og_image');
            $location = public_path('uploads/our_advice');
            $og_image->move($location,$og_image_name);
            $data->og_image = $og_image_name;
            $data->save();
        }


      return redirect()->route('adviceGrants.index')->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdviceAndGrants  $adviceAndGrants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advice = AdviceAndGrants::find($id);

        $adviceFaq = AdviceFaq::where('advice_id',$id)->get();
        foreach ($adviceFaq as $item) 
        {
            $item->delete();
        }
        $advice->delete();
        
        return back()->with('delete', __('Deleted Successfully'));
    }
}
