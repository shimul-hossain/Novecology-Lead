<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\EventAssign;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewEvent;
use App\Models\CRM\NewProject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewEventController extends Controller
{
    public function eventProjectChange(Request $request){
        // $project = NewProject::find($request->id);
        // $view = view('admin.event-project-change', compact('project'))->render();
        // return response($view);

        $type = $request->type;
        if($type == 'Prospect'){
           $item  = LeadClientProject::find($request->id);
           $travaux = $item->LeadTravax; 
         }else if($type == 'Chantier'){
            $item  = NewProject::find($request->id);
            $travaux = $item->ProjectTravaux; 
         }

         $department = getDepartment2($item->Code_Postal);

        $view = view('admin.event-project-change', compact('item', 'travaux', 'department'))->render();
        return response($view);
    }

    public function store(Request $request){ 
        $request->validate([ 
            'date' => 'required',
        ],[ 
            'date.required' => 'La date est requise',
        ]);

        if($request->event_id){

            $event = NewEvent::find($request->event_id);
            if($event){
                $event->update([  
                    'title' => $request->title,
                    'project_id' => $request->project_id,
                    'date' => Carbon::parse($request->date)->format('Y-m-d').' '.$request->time,
                    'time' => $request->time,
                    'description' => $request->description,
                    'guest' => $request->guest,
                    'location' => $request->location,
                ]); 
            }
            return back()->with('success', 'Nouvel événement mis à jour avec succès');
        }else{
            $event = NewEvent::create([  
                'type' => $request->event_type,
                'title' => $request->title,
                'project_id' => $request->project_id,
                'date' => Carbon::parse($request->date)->format('Y-m-d').' '.$request->time,
                'time' => $request->time,
                'description' => $request->description,
                'guest' => $request->guest,
                'location' => $request->location,
                'created_by' => Auth::id(),
            ]);
    
            EventAssign::create([
                'event_id' => $event->id,
                'user_id'  => Auth::id(),
            ]);
            return back()->with('success', 'Nouvel événement créé avec succès');
        }


    }
}
