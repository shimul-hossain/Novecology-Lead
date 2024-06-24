<?php

namespace App\Http\Controllers\CRM;

use App\Events\PannelLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CRM\TravauxQuestion;
use App\Http\Controllers\Controller;
use App\Models\CRM\ActivityLog;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\ClientQuestion;
use App\Models\CRM\LeadActivityLog;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\LeadQuestion;
use App\Models\CRM\NewProject;
use App\Models\CRM\PannelLogActivity;
use App\Models\CRM\ProjectQuestion;
use App\Models\PrescriptionChantierNote;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Question Input Field Add 
    public function travauxQuestionAdd(Request $request){
        foreach($request->label_title as $key => $value){
            TravauxQuestion::create([
                'travaux' => $request->travaux,
                'title' => $request->label_title[$key],
                'name' =>   Str::snake($request->label_title[$key], '_'),
                'type' => $request->input_type[$key],
                'required' => $request->required_optional[$key],
                'options' => $request->options[$key],
                'order' => $request->order[$key] ?? 0,
            ]);
        }

        return back()->with('success',__('Added Succesfully'))->with('active_question_tab', 'question tab ko active karo');
    }

    // Question Input Field update 
    public function travauxQuestionUpdate(Request $request){ 
        $data = TravauxQuestion::find($request->input_id);
        $data->update([ 
                'title' => $request->label_title,
                'name' =>   Str::snake($request->label_title, '_'),
                'type' => $request->input_type,
                'required' => $request->required_optional,
                'options' => $request->options,
                'order' => $request->order,
            ]); 

        return back()->with('success',__('Updated Succesfully'))->with('active_question_tab', 'question tab ko active karo');
    }

    // Travaux Change Question Render
    public function questionInput(Request $request){
        $travaux = BaremeTravauxTag::find($request->data);
        if(!$travaux){
            return response('error');
        }

        // $inputs = TravauxQuestion::where('travaux', $request->data)->orderBy('order')->get();
        $inputs = $travaux->travauxQuestion;
        $data = view('includes.crm.questions_input', compact('travaux'))->render();
        $data2 = view('admin.question_update_modal', compact('inputs'))->render();

        return response()->json(['inputs' => $data, 'modal' => $data2]);
    }

    // Question Input Delete
    public function questionInputDelete(Request $request){
        $travaux = BaremeTravauxTag::find($request->data);
        if(!$travaux){
            return response('error');
        }
        TravauxQuestion::find($request->id)->delete();
        // $inputs = TravauxQuestion::where('travaux', $request->data)->orderBy('order')->get();
        $data = view('includes.crm.questions_input', compact('travaux'))->render();

        return response()->json(['data' => $data, 'alert' => __('Deleted Succesfully')]);
    }

    // Project Question Save 
    public function projectTravauxQuestionSave(Request $request){
        // dd($request->all());
        $input_key = [];
        $input_item = []; 
        foreach($request->except(['_token','project_id']) as $key => $item){ 
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
                    if(!PannelLogActivity::where('tab_name',  'Projet')->where('block_name', 'Prescription chantier')->where('key', $data2)->where('value', $checkbox)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
                    {
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Projet',
                            'block_name'    => 'Prescription chantier',
                            'key'           => $data2,
                            'value'         => $checkbox, 
                            'feature_id'    => $request->project_id,
                            'feature_type'  => 'project',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    } 
            }else{
                $input_key[] = $key;
                $input_item[] = $item;  
                if(!PannelLogActivity::where('tab_name',  'Projet')->where('block_name', 'Prescription chantier')->where('key', $key)->where('value', $item)->where('feature_type', 'project')->where('feature_id', $request->project_id)->exists())
                {
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Projet',
                        'block_name'    => 'Prescription chantier',
                        'key'           => $key,
                        'value'         => $item, 
                        'feature_id'    => $request->project_id,
                        'feature_type'  => 'project',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                } 
            } 
        }  

        $costom_field_data = array_combine($input_key, $input_item); 
        $json = json_encode($costom_field_data); 
        $project = NewProject::find($request->project_id);
        if($project){
            $project->update([ 
                'question_data'          => $json,
            ]);
        }
        return back()->with('success', __('Updated Successfully'));

    }
    // Lead Question Save 
    public function leadTravauxQuestionSave(Request $request){
        // dd($request->all());
        $input_key = [];
        $input_item = [];
        foreach($request->except(['_token','data_lead_id']) as $key => $item){ 
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
                        if(!PannelLogActivity::where('tab_name',  'Projet')->where('block_name', 'Prescription chantier')->where('key', $data2)->where('value', $checkbox)->where('feature_type', 'lead')->where('feature_id', $request->data_lead_id)->exists())
                        {
                            $pannel_activity = PannelLogActivity::create([
                                'tab_name'      => 'Projet',
                                'block_name'    => 'Prescription chantier',
                                'key'           => $data2,
                                'value'         => $checkbox, 
                                'feature_id'    => $request->data_lead_id,
                                'feature_type'  => 'lead',
                                'user_id'       => Auth::id(), 
                            ]);
                            event(new PannelLog($pannel_activity->id));
                        } 
                }else{
                    $input_key[] = $key;
                    $input_item[] = $item;  
                    if(!PannelLogActivity::where('tab_name',  'Projet')->where('block_name', 'Prescription chantier')->where('key', $key)->where('value', $item)->where('feature_type', 'lead')->where('feature_id', $request->data_lead_id)->exists())
                    {
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Projet',
                            'block_name'    => 'Prescription chantier',
                            'key'           => $key,
                            'value'         => $item, 
                            'feature_id'    => $request->data_lead_id,
                            'feature_type'  => 'lead',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    } 
                }

        }  
        $costom_field_data = array_combine($input_key, $input_item); 
        $json = json_encode($costom_field_data);
        $lead = LeadClientProject::find($request->data_lead_id);
        if($lead){
            $lead->update([ 
                'question_data'          => $json,
            ]);
        }  
        return back()->with('success', __('Updated Successfully'))->with('question_save', 'active koro');

    }

    // Client Question Save 
    public function clientTravauxQuestionSave(Request $request){
        $input_key = [];
        $input_item = [];
        foreach($request->except(['_token','data_client_id', 'data_travaux']) as $key => $item){ 
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
        $existing = ClientQuestion::where('travaux',$request->data_travaux)->where('client_id', $request->data_client_id)->first();
        if($existing){
            $existing->update([ 
                'data'          => $json,
            ]);
        }else{
            ClientQuestion::create([
                'travaux'       => $request->data_travaux,
                'data'          => $json,
                'client_id'     => $request->data_client_id,
            ]);
        } 
        return back()->with('success', __('Updated Successfully'));

    }

    public function prescriptionChantierNote(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $request->validate([
            'travaux_id' => 'required',
            'note' => 'required',
        ]);

        if($request->id == '0'){
            PrescriptionChantierNote::create([
                'travaux_id' => $request->travaux_id,
                'note' => $request->note,
            ]);
            return back()->with('success', 'Note ajoutée avec succès');
        }else{
            $item = PrescriptionChantierNote::find($request->id);
            if($item){
                $item->update([
                    'note' => $request->note,
                ]);
                return back()->with('success', 'Note mise à jour avec succès');
            }else{
                return back()->with('error', 'Quelque chose a mal tourné');
            }
        }
    }

    public function prescriptionChantierNoteDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        if($request->travaux_id){
            PrescriptionChantierNote::where('travaux_id', $request->travaux_id)->get()->each->delete();
        }

        return back()->with('success', 'Note supprimée avec succès');
    }

}
