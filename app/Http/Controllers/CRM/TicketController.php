<?php

namespace App\Http\Controllers\CRM;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Client;
use Illuminate\Http\Request;
use App\Models\CRM\Ticketing;
use App\Models\CRM\TicketFile;
use App\Http\Controllers\Controller;
use App\Mail\CRM\AssignMail;
use App\Mail\CRM\TicketResponseMail;
use App\Mail\TicketAssignMail;
use App\Mail\TicketMentionMail;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\Notifications;
use App\Models\CRM\TicketAssign;
use App\Models\CRM\TicketingMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\CRM\TicketProblemStatus;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{

    public function index(){  

        $clients = NewClient::where('deleted_status', 0)->get();
        $ticket_problems = TicketProblemStatus::all();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        // $days = [];
        // $admnistrative = [];
        // $technique = [];
        // $total_ticket = [];
        // $open_ticket = [];
        // $close_ticket = [];

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        if(in_array(role(), $administrarif_role)){
            $tickets = Ticketing::all();
            $single_ticket = Ticketing::first();
            // for ($i = 29; $i >= 0 ; $i--) {
            //     $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            //     $technique[] = Ticketing::where('ticket_type', 'technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $close_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            // }
        }else{
            $tickets = Auth::user()->ticket;
            $single_ticket = Auth::user()->ticket->first(); 
            // for ($i = 29; $i >= 0 ; $i--) {
            //     $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
            //     $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $close_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
            //     $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            // }
        } 
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });

        return view('admin.ticketing', compact('clients', 'ticket_problems', 'users', 'tickets', 'single_ticket', 'projects'));
    }
    public function dashboard(){  
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if (!in_array(role(), $administrarif_role)){
            return back();
        }
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $days = [];
        $admnistrative = [];
        $technique = [];
        $financier = [];
        $total_ticket = [];
        $open_ticket = [];
        $close_ticket = [];

        $user_assignee = $users->map( function($user, $id) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'photo' => $user->profile_photo,
                'role' => $user->getRoleName->name ?? '',
                'ticket' => $user->ticket()->whereNull('close_at')->count(),
            ];
        })->toArray();
        $keys = array_column($user_assignee, 'ticket');
        array_multisort($keys, SORT_DESC, $user_assignee);  
        // if(role() == 's_admin' || role() == 'manager_direction'){
            $tickets = Ticketing::latest()->get();
            $single_ticket = Ticketing::latest()->first();
            for ($i = 29; $i >= 0 ; $i--) {
                $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                $technique[] = Ticketing::where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $financier[] = Ticketing::where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $close_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
                $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
            }
        // }else{
        //     $tickets = Auth::user()->ticket;
        //     $single_ticket = Auth::user()->ticket->first(); 
        //     for ($i = 29; $i >= 0 ; $i--) {
        //         $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
        //         $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
        //         $financier[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
        //         $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
        //         $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
        //         $close_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count(); 
        //         $days[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
        //     }
        // } 
        $view_count = 0;
        foreach($tickets->whereNull('close_at') as $tick){
            if($tick->message->count() > 0){
                $view_count ++;
            }
        } 

        return view('admin.ticket-dashboard', compact('users', 'tickets', 'single_ticket', 'view_count', 'days', 'admnistrative', 'technique', 'financier', 'total_ticket', 'open_ticket', 'close_ticket', 'user_assignee'));
    }
    
    public function store(Request $request){
        $request->validate([ 
            'project_id' => 'required',
            'ticket_type' => 'required',
            'problem_id' => 'required',
            // 'details' => 'required',
        ]);
        
        $ticket = Ticketing::create([ 
            'project_id' => $request->project_id,
            'ticket_type' => $request->ticket_type,
            'problem_id' => $request->problem_id,
            'deadline' => $request->deadline,
            'details' => $request->details,
            'client_status' => $request->client_status,
            'open_by' => Auth::id()
        ]);

        $user_ids = $request->user_id;
        if($user_ids && !in_array(Auth::id(), $user_ids)){
            $user_ids[] = Auth::id();
        }

        $ticket->assignee()->attach($user_ids);
        if($user_ids){
            $subject = 'Assignation ticket'; 
            $title = $ticket->problem->name ?? ''; 
            $body = Auth::user()->name. " vous a assigné dans un ticket"; 
            $nom = $ticket->project->Nom ?? '';
            $prenom = $ticket->project->Prenom ?? '';
            $url = route('tickets.details', $ticket->id);
            $details = $ticket->details;
            foreach($user_ids as $user){
                Notifications::create([
                    'title'  => ['en' => 'Assignation ticket', 'fr' =>'Assignation ticket'],
                    'body'   => ['en' => Auth::user()->name. ' assigned you in a ticket', 'fr' => Auth::user()->name. " vous a assigné dans un ticket"],
                    'user_id' => $user,
                    'ticket_id' => $ticket->id,
                ]); 
    
                $assigne = User::find($user); 
                if($assigne->email_professional && $assigne->status == 'active'){
                    Mail::to($assigne->email_professional)->send(new TicketAssignMail($subject, $body, $ticket->ticket_number, $title, $nom, $prenom, $url, $details));  
                }
            }
        }
        
        return back()->with('success', __('Created Successfully'));
    }
    
    public function assignUpdate(Request $request){
        $single_ticket = Ticketing::find($request->id);
        if($request->user_id){
            $subject = 'Assignation ticket'; 
            $title = $single_ticket->problem->name ?? ''; 
            $body = Auth::user()->name. " vous a assigné dans un ticket"; 
            $nom = $single_ticket->project->Nom ?? '';
            $prenom = $single_ticket->project->Prenom ?? '';
            $url = route('tickets.details', $single_ticket->id);
            $details = $single_ticket->details;

            foreach($request->user_id as $user){
                if(TicketAssign::where('user_id', $user)->where('ticket_id', $single_ticket->id)->doesntExist()){
                    Notifications::create([
                        'title'  => ['en' => 'Assignation ticket', 'fr' =>'Assignation ticket'],
                        'body'   => ['en' => Auth::user()->name. ' assigned you in a ticket', 'fr' => Auth::user()->name. " vous a assigné dans un ticket"],
                        'user_id' => $user,
                        'ticket_id' => $single_ticket->id,
                    ]); 
        
                    $assigne = User::find($user); 
                    if($assigne->email_professional && $assigne->status == 'active'){
                        Mail::to($assigne->email_professional)->send(new TicketAssignMail($subject, $body, $single_ticket->ticket_number, $title, $nom, $prenom, $url, $details));  
                    }
                }
            }
        }

        $single_ticket->assignee()->sync($request->user_id); 
        $assigned_users = $single_ticket->assignee;
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $view = view('admin.ticket_message_body', compact('single_ticket', 'users'))->render();
        return response()->json(['data'=> $view, 'assigned_users' =>$assigned_users]);
    }
    
    public function messageStore(Request $request){
        $request->validate([
            'message' => 'required',
        ],[
            'message.required' => 'Le message est requis'
        ]);

        $input_string = $request->message;

        // Find JSON-like objects in the input string
        preg_match_all('/\[\[(.*?)\]\]/', $input_string, $matches);
        $taged_users_id = [];
        // Parse the JSON objects and replace the corresponding values in the input string
        foreach ($matches[1] as $json_object) {
            $parsed_object = json_decode($json_object);
            if (isset($parsed_object->value)) {
                $input_string = str_replace("[[$json_object]]", "<span style='text-decoration: underline; color: #4D056E; font-weight: 700;'>@{$parsed_object->value}</span>", $input_string);
            }
            if (isset($parsed_object->id)) {
                $taged_users_id[] = (int) $parsed_object->id;
            }
        }

        $message = TicketingMessage::create([
            'ticket_id' => $request->id,
            'message'   => $input_string, 
            'user_id'   => Auth::id()
        ]);
        $path = public_path('uploads/crm/ticket_file');
        if($request->file('attach_files')){
            foreach($request->file('attach_files') as $file){
                $file_type = $file->extension();
                $file_name = $message->id.rand(000,999).'.'.$file_type;
                $file->move($path, $file_name);
                TicketFile::create(['message_id' => $message->id, 'name' => $file_name, 'type' => $file_type]);
            }
        }
        $ticket = Ticketing::find($request->id);
 
        $title = $ticket->problem->name ?? ''; 
        $tag_body = Auth::user()->name. " vous a mentionné dans un ticket"; 
        $response_body = Auth::user()->name. " vous a répondu dans un ticket";
        $nom = $ticket->project->Nom ?? '';
        $prenom = $ticket->project->Prenom ?? '';
        $url = route('tickets.details', $ticket->id);
        $details = $ticket->details;

        if(Auth::user()->profile_photo){
            $user_profile_link =  asset('uploads/crm/profiles')."/".Auth::user()->profile_photo;
        }
        else{
            $user_profile_link = asset('crm_assets/assets/images/icons/user.png');
        }

        $user_name = Auth::user()->name;
        $created_at = Carbon::parse($message->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. Carbon::parse($message->created_at)->format('H:i');
        $message_text = replace_urls_with_links($message->message);

        $response = "<div style='padding-top: 20px;'>
                        <div style='font-size: 14px;'>
                            <a href='#!' style='display: inline-block; text-decoration: none; color: inherit;'> 
                                <img src='$user_profile_link' alt='image' width='30' height='30' style='width:30px; height:30px; object-fit: cover; border-radius: 50%; border: 1px solid #5E5873; vertical-align: middle;'> 
                                <span style='padding-left: 5px; font-weight: 500;'>$user_name</span>
                            </a> 
                            <div style='display: inline;'>
                                <span style='display: inline-block; font-size: 14px; color: #5E5873; padding-left: 6px; padding-right: 6px;'>a répondu le</span>
                                <span style='display: inline-block; font-size: 14px;'>$created_at</span> 
                            </div>
                        </div>
                        <div style='margin: 10px 0; padding: 10px 15px; font-size: 14px; color: #3E4B5B; background-color: #f3f3f7; border-radius: 6px;'>
                            <p style='font-size: 14px; white-space: pre-line; margin-top: 0; margin-bottom: 0;'>$message_text</p>
                        </div>
                    </div>";

        foreach($taged_users_id as $user){
            if(TicketAssign::where('user_id', $user)->where('ticket_id', $request->id)->doesntExist()){
                TicketAssign::create([
                    'ticket_id' => $request->id,
                    'user_id' => $user,
                ]);
            } 
            $assigne = User::find($user); 
            
            if($assigne->email_professional && $assigne->status == 'active'){
                Mail::to($assigne->email_professional)->send(new TicketMentionMail('TAG ticket', $tag_body, $ticket->ticket_number, $title, $nom, $prenom, $url, $details, $response)); 
            }
            $notification = Notifications::create([
                'title'  => ['en' => 'TAG ticket', 'fr' =>'TAG ticket'],
                'body'   => ['en' => Auth::user()->name. ' mentioned you in a ticket', 'fr' => Auth::user()->name. " vous a mentionné dans un ticket"],
                'user_id' => $user,
                'ticket_id' => $request->id,
            ]); 
        }

        foreach($ticket->assignee as $assign_user){    
            if($assign_user->email_professional && $assign_user->status == 'active'){
                Mail::to($assign_user->email_professional)->send(new TicketResponseMail('Réponse ticket', $response_body, $ticket->ticket_number, $title, $nom, $prenom, $url, $details, $response)); 
            } 
        }
        
        
        $single_ticket = Ticketing::find($request->id);
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $view = view('admin.ticket_message_body', compact('single_ticket', 'users'))->render();
        return response($view);
    }
    
    public function notificationViewTicket($notify_id, $ticket_id){ 
        $notification = Notifications::find($notify_id); 
        $notification->status = '1';
        $notification->save();

        return redirect()->route('tickets.details', $ticket_id);
    }
    public function sidebarChange(Request $request){
        $single_ticket = Ticketing::find($request->id);
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $assigned_users = $single_ticket->assignee;
        $view = view('admin.ticket_message_body', compact('single_ticket', 'users'))->render();
        return response()->json(['data'=> $view, 'assigned_users' =>$assigned_users]);
    }

    public function ticketClosed(Request $request){
        $ticket = Ticketing::find($request->id);
        $ticket->update([
            'close_at' => Carbon::now(),
            'close_by' => Auth::id(),
        ]);

        return back()->with('suceess', 'Billet fermé');
    }

    public function ticketDateFilter(Request $request){
        $from = $request->from;
        if ($request->to) {
            $to = $request->to;
        } else {
            $to = Carbon::now()->format('Y-m-d');
        }
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $tickets = Ticketing::whereBetween('created_at', [$from, $to])->get(); 
        }else{
            $tickets = Auth::user()->ticket->whereBetween('created_at', [$from, $to]); 
        }  
        $view_count = 0;
        foreach($tickets->whereNull('close_at') as $tick){
            if($tick->message->count() > 0){
                $view_count ++;
            }
        }
         $total = $tickets->count();
         $open = $tickets->whereNull('close_at')->count();
         $close = $tickets->whereNotNull('close_at')->count();

         return response()->json(['total' => $total, 'open' => $open, 'close' => $close, 'viewed' => $view_count]);

    }
    public function ticketDateFilterClear(Request $request){ 

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $tickets = Ticketing::all(); 
        }else{
            $tickets = Auth::user()->ticket; 
        }  
        $view_count = 0;
        foreach($tickets->whereNull('close_at') as $tick){
            if($tick->message->count() > 0){
                $view_count ++;
            }
        }
         $total = $tickets->count();
         $open = $tickets->whereNull('close_at')->count();
         $close = $tickets->whereNotNull('close_at')->count();

         return response()->json(['total' => $total, 'open' => $open, 'close' => $close, 'viewed' => $view_count]);

    }

    public function ticketTypeChartFilter(Request $request){
        $admnistrative = [];
        $technique = [];
        $financier = [];
        $label = [];
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        if(in_array(role(), $administrarif_role)){
            if ($request->value == '7') {
                for ($i = 0; $i <= 6; $i++) {
                    $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $technique[] = Ticketing::where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $financier[] = Ticketing::where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('l'); 
                }
            } elseif ($request->value == 'this') {
                for ($i = 29; $i >= 0 ; $i--) {
                    $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $technique[] = Ticketing::where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $financier[] = Ticketing::where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
                }
            } elseif ($request->value == 'last') {
                for ($i = 1; $i <= Carbon::now()->subMonth()->daysInMonth; $i++) {
                    $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $technique[] = Ticketing::where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $financier[] = Ticketing::where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $label[] = $i . '-' . Carbon::now()->subMonth()->locale(app()->getLocale())->translatedFormat('M');
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $admnistrative[] = Ticketing::where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $technique[] = Ticketing::where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $financier[] = Ticketing::where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $label[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                }
            } 
        }else{
            if ($request->value == '7') {
                for ($i = 0; $i <= 6; $i++) {
                    $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $financier[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('l'); 
                }
            } elseif ($request->value == 'this') {
                for ($i = 29; $i >= 0 ; $i--) {
                    $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $financier[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $label[] = Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
                }
            } elseif ($request->value == 'last') {
                for ($i = 1; $i <= Carbon::now()->subMonth()->daysInMonth; $i++) {
                    $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $financier[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $label[] = $i . '-' . Carbon::now()->subMonth()->locale(app()->getLocale())->translatedFormat('M');
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $admnistrative[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Administratif')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $technique[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Technique')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $financier[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->where('ticket_type', 'Financier')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $label[] = Carbon::now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
                }
            } 
        }

        return response()->json(['admnistrative' => $admnistrative, 'technique' => $technique, 'label' => $label, 'financier' => $financier]);
    }

    public function ticketStatusChartFilter(Request $request){
        $total_ticket = [];
        $open_ticket = [];
        $closed_ticket = [];
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            if ($request->value == '7') {
                for ($i = 0; $i <= 6; $i++) {
                    $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $closed_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                }
            } elseif ($request->value == 'this') {
                for ($i = 29; $i >= 0 ; $i--) {
                    $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $closed_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                }
            } elseif ($request->value == 'last') {
                for ($i = 1; $i <= Carbon::now()->subMonth()->daysInMonth; $i++) {
                    $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $closed_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $total_ticket[] = Ticketing::whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $open_ticket[] = Ticketing::whereNull('close_at')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $closed_ticket[] = Ticketing::whereNotNull('close_at')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                }
            } 
        }else{
            if ($request->value == '7') {
                for ($i = 0; $i <= 6; $i++) {
                    $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $closed_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                }
            } elseif ($request->value == 'this') {
                for ($i = 29; $i >= 0 ; $i--) {
                    $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                    $closed_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now())->whereMonth('created_at', Carbon::now())->whereDay('created_at', Carbon::now()->subDays($i))->count();
                }
            } elseif ($request->value == 'last') {
                for ($i = 1; $i <= Carbon::now()->subMonth()->daysInMonth; $i++) {
                    $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                    $closed_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now()->subMonth())->whereMonth('created_at', Carbon::now()->subMonth())->whereDay('created_at', $i)->count();
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $total_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $open_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNull('close_at')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                    $closed_ticket[] = Ticketing::whereIn('id', Auth::user()->ticket->pluck('id'))->whereNotNull('close_at')->whereYear('created_at', Carbon::now()->subYear())->whereMonth('created_at', $i)->count();
                }
            } 
        }

        return response()->json(['total_ticket' => $total_ticket, 'open_ticket' => $open_ticket, 'closed_ticket' => $closed_ticket]);
    }

    public function ticketsDetails($id){

        $clients = NewClient::where('deleted_status', 0)->get();
        $ticket_problems = TicketProblemStatus::all();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();     
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
        if(in_array(role(), $administrarif_role)){
            $single_ticket = Ticketing::find($id); 
        }else{
            $single_ticket = Auth::user()->ticket->where('id', $id)->first();
        }  

        if($single_ticket){
            return view('admin.ticketing_details', compact('clients', 'ticket_problems', 'users', 'single_ticket'));
        }else{
            return back()->with('error', "Vous n'avez pas la permission de voir ce ticket.");
        }
    }

    public function ticketFilter(Request $request){
        $clients = NewClient::where('deleted_status', 0)->get();
        $ticket_problems = TicketProblemStatus::all();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $from = request()->from ?? Carbon::today(); 
        $to = request()->to ?? Carbon::today();  
        $ticket_deadline = request()->ticket_deadline;

        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];

        if(in_array(role(), $administrarif_role)){
            $ticket = Ticketing::query();
            $project = NewProject::query();
            if(request()->client){
                $project->where('id', request()->client);
            }
            if(request()->code_postal){
                $project->where('Code_Postal', request()->code_postal);
            }
            if(request()->commercial_user_id){
                $responsable_user = User::find(request()->commercial_user_id);
                if($responsable_user){ 
                    $stats_regies = $responsable_user->allRegie; 
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $project->whereIn('project_telecommercial', $user_ids);
                }
            }
            $filtered_project = $project->get()->pluck('id');

            if(request()->client || request()->code_postal || request()->commercial_user_id){
                $ticket->whereIn('project_id', $filtered_project);
            }
            if(request()->ticket_type && request()->ticket_type != 'Administratif'){
                $ticket->where('ticket_type', request()->ticket_type);
            }
            if(request()->ticket_problem){
                $ticket->where('problem_id', request()->ticket_problem);
            }
            if(request()->ticket_number){
                $ticket->where('ticket_number', 'LIKE', '%'.request()->ticket_number.'%');
            }
            if(request()->from || request()->to){
                $ticket->whereBetween('created_at', [$from, $to]);
            }
            if($ticket_deadline){
                $filter_tickets = $ticket->get()->map(function ($ticketing) use ($ticket_deadline){
                    $diff = Carbon::parse(Carbon::parse($ticketing->created_at)->format('y-m-d'))->diffInDays(\Carbon\Carbon::today());
                    $deadline = $ticketing->deadline;   
                    if($ticket_deadline == 'expired'){
                        if($diff >= $deadline){
                            return $ticketing->id;
                        }
                    }elseif($diff < $ticketing->deadline && $ticket_deadline == '5'){
                        if(($deadline - $diff) <= 5){
                            return $ticketing->id;
                        }
                    }elseif($diff < $ticketing->deadline && $ticket_deadline == '5-10'){
                        if(($deadline - $diff) >= 5 && ($deadline - $diff) <= 10){
                            return $ticketing->id;
                        }
                    }elseif($diff < $ticketing->deadline && $ticket_deadline == '10-30'){
                        if(($deadline - $diff) >= 10 && ($deadline - $diff) <= 30){
                            return $ticketing->id;
                        }
                    }elseif($diff < $ticketing->deadline && $ticket_deadline == '30-60'){
                        if(($deadline - $diff) >= 30 && ($deadline - $diff) <= 60){
                            return $ticketing->id;
                        }
                    }elseif($diff < $ticketing->deadline && $ticket_deadline == '60'){
                        if(($deadline - $diff) >= 60){
                            return $ticketing->id;
                        }
                    }else{
                        return null;
                    }
                }); 
                
                $ticket->whereIn('id', $filter_tickets);
            }


            $tickets = $ticket->get();
            $single_ticket = $tickets->first();
        }else{

            $ticket = Ticketing::query();
            $project = NewProject::query();
            if(request()->client){
                $project->where('id', request()->client);
            }
            if(request()->code_postal){
                $project->where('Code_Postal', request()->code_postal);
            }
            if(request()->commercial_user_id){
                $responsable_user = User::find(request()->commercial_user_id);
                if($responsable_user){ 
                    $stats_regies = $responsable_user->allRegie; 
                    $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                    $project->whereIn('project_telecommercial', $user_ids);
                }
            }
            $filtered_project = $project->get()->pluck('id');

            if(request()->client || request()->code_postal || request()->commercial_user_id){
                $ticket->whereIn('project_id', $filtered_project);
            }
            if(request()->ticket_problem){
                $ticket->where('problem_id', request()->ticket_problem);
            }
            if(request()->ticket_number){
                $ticket->where('ticket_number', 'LIKE', '%'.request()->ticket_number.'%');
            }
            if(request()->ticket_deadline){
                $ticket->where('deadline', request()->ticket_deadline);
            }
            if(request()->from || request()->to){
                $ticket->whereBetween('created_at', [$from, $to]);
            }

            $assign_tickets = Auth::user()->ticket->pluck('id');
            
            $tickets = $ticket->whereIn('id', $assign_tickets)->get();
            $single_ticket = $tickets->first();
        }  
        $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
            return [
                'id'            => $project->id,
                'Nom'           => $project->Nom,
                'Prenom'        => $project->Prenom, 
                'Code_Postal'   => $project->Code_Postal, 
                'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
            ];
        });



        return view('admin.ticketing', compact('clients', 'ticket_problems', 'users', 'tickets', 'single_ticket', 'projects'));
    }

    public function ticketCreateProjectChange(Request $request){
        $project = NewProject::find($request->project_id);
        $view = view('admin.ticket_project', compact('project'))->render();
        return response($view);
    }
    
    public function ticketCreateTypeChange(Request $request){
        $problems = TicketProblemStatus::where('ticket_type', $request->type)->get();

        $view = view('admin.ticket_problem', compact('problems'))->render();
        return response($view);

    }

    public function ticketStatusUpdate(Request $request){
        $ticket = Ticketing::find($request->ticket_id);
        if($ticket){
            $ticket->update([
                'client_status' => $request->status,
            ]);
        } 
        return back()->with('success', 'Mettre à jour le statut du ticket');
    }

    public function assignListFilter(Request $request){
        $value = $request->value;
        $user_assignee = User::where('deleted_status', 'no')->where('status', 'active')->get()->map( function($user) use ($value) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'photo' => $user->profile_photo,
                'role' => $user->getRoleName->name ?? '',
                'ticket' => $value == 'all' ? $user->ticket()->whereNull('close_at')->count() : $user->ticket()->whereNull('close_at')->where('ticket_type', $value)->count(),
            ];
        })->toArray();
        $keys = array_column($user_assignee, 'ticket');
        array_multisort($keys, SORT_DESC, $user_assignee);  
        $view = view('admin.ticket_assigne_list', compact('user_assignee'))->render();
        return response($view);
    }

    public function ticketDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $ticket = Ticketing::find($request->id);
        if($ticket){
            Notifications::where('ticket_id', $ticket->id)->get()->each->delete();
            $ticket->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }

    public function ticketMessageDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $message = TicketingMessage::find($request->id);
        if($message){
            $message->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }

    // END
}
