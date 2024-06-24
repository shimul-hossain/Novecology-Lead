<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Event;
use App\Models\CRM\EventCategory; 
use Carbon\Carbon; 
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{

    // Event Category Store 
    public function categoryStore(Request $request){
        
        if($request->existing_category_id){

            $category = EventCategory::find($request->existing_category_id);
            $category->name = ['en' => $request->name, 'fr' =>$request->name]; 
            $category->color = $request->color;
            $category->save();
    
            return back()->with('success', __('Event Category Updated Successfully'));

        }
        else {
            $request->validate([
                'name'      => 'required', 
                'color'     => 'required',
            ],[
                'name.required'     => __('Category name is required'),
                'color.required'    => __('Category color is required'),
            ]);
            
            $category = EventCategory::create($request->except('_token','existing_category_id') + ['created_at' => Carbon::now()]);
    
            $category->name = ['en' => $request->name, 'fr' =>$request->name];
            $category->save();
    
            return back()->with('success', __('Event Category Added Successfully'));
        }
       
    }

    // Event Category Delete 
    public function CategoryDelete(Request $request){
        EventCategory::findOrFail($request->event_category_id)->delete();
        $events = Event::where('category_id', $request->event_category_id)->get();

        foreach($events as $event){
            $event->delete();
        } 

        return back()->with('success', __('Event Category Deleted'));
    }
}
