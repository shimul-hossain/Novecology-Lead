<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Event;
use App\Models\CRM\EventAssign;
use App\Models\CRM\NewProject;
use App\Models\CRM\Notifications;
use App\Models\CRM\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToArray;

class EventController extends Controller
{

    // Event Store 
    public function eventStore(Request $request){ 

        if($request->event_id){ 
            $event_assigne = EventAssign::where('event_id', $request->event_id)->get();
            foreach($event_assigne as $item){
                $item->delete();
            }

            foreach($request->user_id as $assignee){
                EventAssign::create([
                    'event_id' => $request->event_id,
                    'user_id'  => $assignee,
                ]);
            }
        $event =  Event::findOrFail($request->event_id);
        $event->update($request->except('_token', 'event_id', 'user_id') + ['updated_at' => Carbon::now()]);

        $event->title = ['en' => $request->title, 'fr' => $request->title];
        $event->description = ['en' => $request->description, 'fr' => $request->description];
        $event->save(); 

        return back()->with('success', __('Event Updated Successfully'));
            
             
        }else{ 
            $event = Event::create($request->except('_token', 'event_id', 'user_id') + ['created_at' => Carbon::now()]);

            foreach($request->user_id as $assignee){
                EventAssign::create([
                    'event_id' => $event->id,
                    'user_id'  => $assignee,
                ]);
            }
            $event->title = ['en' => $request->title, 'fr' => $request->title];
            $event->description = ['en' => $request->description, 'fr' => $request->description];
            $event->save();  
            return back()->with('success', __('Event Added Successfully'));
             
        }  
    }

    public function eventClientProject(Request $request){
        $projects =  NewProject::where('client_id', $request->client_id)->where('deleted_status', 0)->orderBy('id', 'desc')->get();
        $data = view('includes.crm.event-project', compact('projects'));
        $porject_data = $data->render();
        return response($porject_data);
    }


    public function eventAssignee(Request $request){
         $id = $request->event_id;
         $data = EventAssign::where('event_id', $id)->get()->pluck('user_id');         
         $array = $data->toArray(); 
         $users= User::all();
         $selected = '';
         foreach($data as $item){
             foreach($users as $user){
                 if($user->id == $item){
                     $selected .= "<option selected value='".$user->id."'>".$user->name."</option>";
                 }
             }
         }
         foreach($users as $user){ 
            if(in_array($user->id, $array)){
                continue;
            } else{
                $selected .= "<option value='".$user->id."'>".$user->name."</option>";
            }
         }
         return response($selected);
    }

    public function eventProject(Request $request){
       $data = Project::where('client_id', $request->client_id)->where('deleted_status', 'no')->orderBy('id', 'desc')->get();
       $selected = '';
       foreach($data as $item){
           if($item->id == $request->project_id){
                $selected .= "<option selected value='".$item->id."'>".$item->project_name."</option>";
           }else{
                $selected .= "<option value='".$item->id."'>".$item->project_name."</option>";
           }
       }

       return response($selected);
    }


    // event drag 
    public function eventDrag(Request $request){
        $event = Event::find($request->event_id); 
        $movement = (int)$request->movement;  
        if($movement > 0){
            $event->start_date = Carbon::parse($event->start_date)->addDays($movement);
            if($event->end_date){
                $event->end_date = Carbon::parse($event->end_date)->addDays($movement);
            } 
        }else{ 
            $event->start_date = Carbon::parse($event->start_date)->subDays($movement * -1);
            if($event->end_date){
                $event->end_date = Carbon::parse($event->end_date)->subDays($movement * -1);
            } 
        }
        $event->save();
        return response('success');
    }
}
