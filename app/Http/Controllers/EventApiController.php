<?php

namespace App\Http\Controllers;

use App\Models\CRM\Event;
use App\Models\CRM\EventAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventApiController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('checkToken');
    // }
        
    // event list 
    public function index(){
     
      // Return all events in proper json format without the array wrapper
      return response()->json(['data' => Event::all()], 200); 
        
    }

    public function userEvent(){
        $data = EventAssign::where('user_id', Auth::id())->get()->pluck('event_id');
        $events = Event::findMany($data);
        $data = [];
        foreach($events as $key => $event){
          $data[$key] = [ 
            'id'            => $event->id,
            'title'         => $event->title,
            'title_fr'      => $event->title_fr,
            'category_id'   => $event->category_id,
            'all_day'       => $event->all_day,
            'start_date'    => $event->start_date,
            'end_date'      => $event->end_date,
            'client_id'     => $event->client_id,
            'location'      => $event->location,
            'description'   => $event->description,
            'description_fr'=> $event->description_fr,
            'status'        => $event->status,
            'project_id'    => $event->project_id,
            'created_at'    => $event->created_at,
            'updated_at'    => $event->updated_at,
          ];
        }
        return response()->json(['data' => $data], 200);
    }
 
}
