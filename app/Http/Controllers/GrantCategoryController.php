<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\AdviceAndGrants;
use App\Models\AdviceDetail;
use App\Models\AdviceFaq;
use App\Models\GrantCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = GrantCategory::all();

        return view('super_admin.advice_&_grants.category',compact('category'));
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
            'category_name' => 'required|unique:grant_categories',
        ],[
            'category_name.required'  => __('Category name is required'),
            'category_name.unique'    => __('This category name is already exist'),
        ]);
        GrantCategory::create($request->except('_token') + ['created_at'=> Carbon::now()]);

        return back()->with('success', __('Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrantCategory  $grantCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GrantCategory $grantCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrantCategory  $grantCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GrantCategory $grantCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrantCategory  $grantCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:grant_categories',
        ],[
            'category_name.required'  => __('Category name is required'),
            'category_name.unique'    => __('This category name is already exist'),
        ]);
       
        $category = GrantCategory::find($id);
        $category->update($request->except('_token') + ['updated_at'=> Carbon::now()]);

        return back()->with('update', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrantCategory  $grantCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = GrantCategory::find($id);

        $advices = AdviceAndGrants::where('category_id',$id)->get();
        
        if ( $advices != null) 
        {
            foreach ($advices as $advice) 
            {
               $adviceFAQ = AdviceFaq::where('advice_id',$advice->id)->get();

               if ($adviceFAQ != null) {
                 
                   foreach ($adviceFAQ  as $item) 
                   {
                      $item->delete();
                   }
               }

               $advice->delete();
            }
        }
        $category->delete();

        
        return back()->with('delete', __('Deleted Successfully'));
    }
}
