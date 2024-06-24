<?php

namespace App\Http\Controllers;

use App\Models\CRM\Lead;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LeadCustomField;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LeadCustomFieldController extends Controller
{
    // Custom Field Store
    public function leadCustomFieldStore(Request $request){
            LeadCustomField::create([ 
                'collapse_name' => $request->collapse_name,
                'title' => $request->title,
                'name' => Str::snake($request->title, '_'),
                'input_type' => $request->input_type,
                'required' => 'no',
                'options' => $request->options,
            ]);
        if($request->callapse_active){
            return back()->with('success', __('Added Succesfully'))->with($request->callapse_active, '1');
        }else{
            return back()->with('success', __('Added Succesfully'))->with('custom_field_tab_active', '1');
        }
    }
    
    // Custom Field Delete 
    public function leadCustomFieldDelete(Request $request){
        LeadCustomField::find($request->input_id)->delete();
        if($request->callapse_active){ 
            return back()->with('success', __('Delete Succesfully'))->with($request->callapse_active, '1');
        }else{ 
            return back()->with('success', __('Delete Succesfully'))->with('custom_field_tab_active', 'hello sam');
        }
    }

    public function leadCustomField(Request $request){
        $inputs = LeadCustomField::where('collapse_name', $request->collapse)->get();
        $view = view('admin.lead_custom_field_input_list', compact('inputs'))->render();
        return response($view);
    }

    // // Lead custom data store
    // public function leadCustomFieldDataStore(Request $request){
    //     $input_key = [];
    //     $input_item = [];
    //     foreach($request->except(['_token','lead_id']) as $key => $item){ 
    //         $data = explode('_', $key); 
    //         if($data[0] == 'checkboxinput'){ 
    //                     $checkbox = '';
    //                     array_shift($data);
    //                     $data2 = implode('_', $data);
    //                     foreach($item as $i){
    //                         $checkbox .=$i.',';
    //                     }
    //                     $input_key[] = $data2;
    //                     $input_item[] = $checkbox;  
    //             }else{
    //                 $input_key[] = $key;
    //                 $input_item[] = $item;  
    //             }
    //     }  
    //     $costom_field_data = array_combine($input_key, $input_item); 
    //     $json = json_encode($costom_field_data);
    //     $lead = Lead::find($request->lead_id);
    //     if($lead){
    //         $lead->update([ 
    //             'custom_data' => $json,
    //         ]); 
    //     } 
    //     return back()->with('success', __("Updated Successfully"))->with('custom_field_tab_active', 'hello sam');
    // }

    // // Zapier data store
    // public function zapierLeadStore(Request $request){
    //     $data[] = $request->all(); 
    //     $json = json_encode($data[0]); 
    //     $name = ''; 
    //     $email = '';
    //     $phone = '';
    //     $lead_key = []; 
    //     $lead_item= [];
    //     $existing_custom_Key = []; 

    //     foreach (LeadCustomField::all() as $exc){
    //         $existing_custom_Key[] = strtolower($exc->name);
    //     }

    //     foreach($data[0] as $key => $value) {

    //         if(str_contains($key, 'nom') || str_contains($key, 'name') || str_contains($key, 'full_name') || str_contains($key, 'Nom et Prénom')) {
    //             $name = $value;
    //         }
    //         elseif(str_contains($key, 'telephone') || str_contains($key, 'phone') || str_contains($key, 'Téléphone') || str_contains($key, 'numero telephone') || str_contains($key, 'telefono') || str_contains($key, 'telefono fijo') || str_contains($key, 'nombre')) {
    //             $phone = $value;
    //         }
    //         elseif(str_contains($key, 'email') || str_contains($key, 'Email') || str_contains($key, 'Emali') || str_contains($key, 'E-mail')) {
    //             $email = $value;
    //         }
    //         else 
    //         {
    //            $lead_key[] = $key;
    //            $lead_item[] = $value;   

    //             if(!in_array($key, $existing_custom_Key) && !str_contains($key, 'raw')){
    //                 LeadCustomField::create([ 
    //                     'title' => $key,
    //                     'name' => $key,
    //                     'input_type' => 'text', 
    //                 ]);
    //             } 
    //         }
    //     }

        
    //     $costom_field_data = array_combine($lead_key, $lead_item); 
    //     $json = json_encode($costom_field_data);

    //                 $lead = Lead::create([
    //                     'first_name'    => $name,
    //                     'phone'         => $phone,
    //                     'email'         => $email,
    //                     'custom_data'   => $json,  
    //                     'user_status'   => 1,
    //                     'data_status'   => 'yes',
    //                     'company_id'    => 1,
    //                     'company_name'  => 'Novecology',
    //                     'created_at'    => Carbon::now(),
    //     ]);
    // }
}
