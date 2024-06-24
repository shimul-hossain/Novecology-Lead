<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CRM\CustomTab;
use App\Models\CRM\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\CRM\ProjectStaticTab;
use Illuminate\Support\Facades\Auth;
use App\Models\CRM\CustomTabDataField;
use App\Models\CRM\CustomTabFieldData;

class TabController extends Controller
{

    // Create custom tab
    public function customTabCreate(Request $request){
        if($request->tab_id){
            $tab = CustomTab::find($request->tab_id);
            $tab->update([
                'name' => $request->name, 
                'item_name' => $request->item_name,
            ]);
        }else{
            $tab = CustomTab::create([
                'name' => $request->name,
                'project_id' => $request->project_id,
                'item_name' => $request->item_name,
            ]);
        }
        return back()->with('success', __('Added Succesfully'))->with('custom_tab_active', $tab->id);
    }

    // Tab Delete 
    public function customTabDelete(Request $request){
        CustomTab::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'));
    }

    public function customTabFieldStore(Request $request){
        foreach($request->title as $key => $value){
            CustomTabDataField::create([
                'tab_id'  => $request->tab_id,
                'title' => $request->title[$key],
                'name' => Str::snake($request->title[$key], '_'),
                'input_type' => $request->input_type[$key],
                'options' => $request->options[$key],
            ]);
        } 
        // CustomTabDataField::create($request->except(['_token']) + ['name' => Str::snake($request->title, '_')]);
        return back()->with('success', __('Added Succesfully'))->with('custom_tab_active', $request->tab_id);
    }

    public function projectCustomTabFieldDataStore(Request $request){
        $input_key = [];
        $input_item = [];
        foreach($request->except(['_token','tab_id', 'project_id']) as $key => $item){ 
            $data = explode('_', $key); 
            if($data[0] == 'checkboxinput'){ 
                        $checkbox = '';
                        array_shift($data);
                        $data2 = implode('_', $data);
                        foreach($item as $i){
                            $checkbox .=$i.',';
                        }
                        $input_key[] = $data2;
                        $input_item[] = $checkbox;  
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;  
                }
        }  
        $costom_field_data = array_combine($input_key, $input_item); 
        $json = json_encode($costom_field_data);
        $existing = CustomTabFieldData::where('tab_id',$request->tab_id)->first();
        if($existing){
            $existing->update([ 
                'data'          => $json,
            ]);
            $msg = __("Updated Successfully");
        }else{
            CustomTabFieldData::create([  
                'tab_id'      => $request->tab_id,
                'data'        => $json, 
            ]);
            $msg = __('Added Succesfully');
        }
        $tab = CustomTab::find($request->tab_id);
        $data = $request->except(['_token','tab_id', 'project_id']);

        return back()->with('success', $msg)->with('custom_tab_active', $request->tab_id);  
    }
    
    public function projectTabField(Request $request){
        $inputs =CustomTabDataField::where('tab_id', $request->tab_id)->get();
        $data = view('includes.crm.tab_input', compact('inputs'))->render();
        return response($data);
    }
    
    public function customTabFieldDelete(Request $request){
        CustomTabDataField::find($request->input_id)->delete();
        return back()->with('custom_tab_active', $request->tab_id);  
    }

    public function projectStaticTabUpdate(Request $request){
        if(role() == 's_admin'){
            if($request->tab_name){
                ProjectStaticTab::find($request->id)->update([
                    'name' => $request->tab_name,
                ]);
            }
        }
        return back()->with('success', __('Updated Successfully'));
    }

}
