<?php

namespace App\Http\Controllers;

use App\Models\CRM\Company;
use App\Models\CRM\Event;
use App\Models\CRM\EventCategory;
use App\Models\CRM\Navigation;
use App\Models\CRM\NonNavigation;
use App\Models\CRM\Role;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
   
    public function translation(){
        $path = base_path('resources/lang/fr.json'); // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true); 

        return view('super_admin.translation.index', compact('json'));
    }

    public function modifyFr(Request $request){

        $key = $request->key;
        $path = base_path('resources/lang/fr.json'); // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true); 

        $json[$request->key] = $request->value;

        file_put_contents($path, json_encode($json));
 
        return response('Updated Successfully');

    }

    public function databaseTranslation(){
        
        
        return view('super_admin.translation.db-translate',[

            'companies'         => Company::all(),
            'eventCategories'   => EventCategory::all(),
            'events'            => Event::all(),
            'navigations'       => Navigation::all(),
            'non_navigations'   => NonNavigation::all(),
            'roles'             => Role::where('status', 'active')->get(),
        ]);  
    }

    public function modifyDb(Request $request)
    {  
        if($request->table == 'company'){
            $data = Company::find($request->company_id);  
            $data->company_title = ["en" => $request->company_title_en , "fr" => $request->company_title]; 
            $data->save();
        }
        else if($request->table == 'event_category'){ 
            $data = EventCategory::find($request->category_id);  
            $data->name = ["en" => $request->category_name_en , "fr" => $request->category_name]; 
            $data->save();
        } 
        else if($request->table == 'event_title'){ 
            $data = Event::find($request->event_id);  
            $data->title = ["en" => $request->event_title_en , "fr" => $request->event_title]; 
            $data->save();
        } 

        else if($request->table == 'event_description'){ 
            $data = Event::find($request->event_id);  
            $data->description = ["en" => $request->event_description_en , "fr" => $request->event_description]; 
            $data->save();
        } 
        else if($request->table == 'navigation'){ 
            $data = Navigation::find($request->navigation_id);  
            $data->name = ["en" => $request->navigation_name_en , "fr" => $request->navigation_name]; 
            $data->save();
        } 
        else if($request->table == 'non_navigation'){ 
            $data = NonNavigation::find($request->navigation_id);  
            $data->name = ["en" => $request->navigation_name_en , "fr" => $request->navigation_name]; 
            $data->save();
        }  
        else if($request->table == 'role'){ 
            $data = Role::find($request->role_id);  
            $data->name = ["en" => $request->role_name_en , "fr" => $request->role_name]; 
            $data->save();
        } 

        return back()->with('success', __('Updated Successfully'));
    }

 // END   
}
