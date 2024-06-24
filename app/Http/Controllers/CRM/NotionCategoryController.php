<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\NotionCategory;
use Illuminate\Http\Request;

class NotionCategoryController extends Controller
{
    public function notionCategoryCreate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        NotionCategory::create([
            'name' => $request->name, 
            'order' => $request->order, 
        ]);
        
        return back()->with('success', __('Created Successfully'))->with('notion_category', '1');
        
    }
    public function notionCategoryUpdate(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        
        $data = NotionCategory::find($request->id);
        $data->update([
            'name' => $request->name, 
            'order' => $request->order, 
        ]);
        return back()->with('success', __('Updated Successfully'))->with('notion_category', '1');
    }
    
    public function notionCategoryDelete(Request $request){ 
        $data = NotionCategory::find($request->id);
        $data->delete();
        return back()->with('success', __('Deleted Successfully'))->with('notion_category', '1');
    }
}
