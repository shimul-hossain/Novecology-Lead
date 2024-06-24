<?php

namespace App\Http\Controllers;

use App\Models\CRM\NotionSubCategory;
use Illuminate\Http\Request;

class NotionSubCategoryController extends Controller
{
    public function notionSubCategoryCreate(Request $request){
        $request->validate([
            'name' => "required",
            'category' => "required",
        ]);
        
        NotionSubCategory::create([
            'name' => $request->name, 
            'category_id' => $request->category, 
            'order' => $request->order, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('notion_sub_category', '1');
        
    }
    public function notionSubCategoryUpdate(Request $request){
        $request->validate([
            'name' => "required",
            'category' => "required",
        ]);
        
        $data = NotionSubCategory::find($request->id);
        $data->update([
            'name' => $request->name, 
            'category_id' => $request->category, 
            'order' => $request->order,
        ]);
        return back()->with('success', __('Updated Successfully'))->with('notion_sub_category', '1');
    }
    
    public function notionSubCategoryDelete(Request $request){ 
        $data = NotionSubCategory::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('notion_sub_category', '1');
    }
}
