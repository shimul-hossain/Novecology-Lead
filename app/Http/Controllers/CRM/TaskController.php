<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Mail\CRM\AssignMail;
use App\Mail\CRM\NotificationMail;
use App\Models\CRM\Client;
use App\Models\CRM\Notifications;
use App\Models\CRM\Tag;
use App\Models\CRM\Task;
use App\Models\CRM\TaskAssign;
use App\Models\CRM\TaskTag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    // Add task 
    public function addTask(Request $request){ 

       $task = Task::create([
           'title'          => $request->title,   
           'client_id'      => $request->client_id,
           'due_date'       => $request->due_date,
           'priority'       => $request->priority,
           'description'    => $request->description,
           'created_by'     => Auth::id(),
       ]);  

       foreach($request->tags as $tag){
           TaskTag::create([
            'task_id'       => $task->id,
            'tag_id'        => $tag,
           ]);
       } 

       foreach($request->assignee as $assignee){
           TaskAssign::create([
            'task_id'       => $task->id,
            'assignee_id'   => $assignee,
           ]);
        //    if(checkNotificationStatus('task assign', $assignee)){
            $user = User::find($assignee);
            $name = Auth::user()->name;
            $subject = 'New Task Assign';
            $body = $user->name.', You have been assigned a task by '.$name;
            if($user->email_professional){
                Mail::to($user->email_professional)->send(new AssignMail($subject, $body));
            }
            // }

           $notification = Notifications::create([
            'title'  => ['en' => 'Task Assign', 'fr' =>'Attribution des tâches'],
            'body'   => ['en' => 'You have been assigned a task by '.Auth::user()->name, 'fr' =>  'Vous avez été chargé d\'une tâche par '.Auth::user()->name],
            'user_id' => $assignee, 
            'client_id' => 0,
            ]);
       } 

       $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
       if(role() == 's_admin'){
           $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
           $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
           $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
           $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
           $deleted_tasks = Task::where('is_deleted', 1)->get();   
       }else{
           $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
           $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
           $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
           $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
           $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
       }
       $tags = Tag::all();
       $users =  User::all();
       $clients = Client::where('deleted_status', 'no')->get();
       $my_Task_count = $tasks->count();
       $important_Task_count = $important_tasks->count();
       $completed_Task_count = $complete_tasks->count();
       $pending_Task_count = $pending_tasks->count();
       $deleted_Task_count = $deleted_tasks->count();

       
       $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
       $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();

       $view = view('includes.crm.view-notification', compact('notification')); 
       $response = $view->render(); 

       $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
       $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
       $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
       $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
       $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

       $alltask = $all_task->render();
       $completetask = $completed->render();
       $importanttast = $important->render();
       $pendingtast = $pending->render();
       $deletedtask = $deleted->render();


       return response()->json(['alert' => __('Task Added'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast, 'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count,'response' => $response, 'count'=>$count]);
    }

    // Task Complete 
    public function taskCompleted(Request $request){

        if(role() == 's_admin'){
            $task = Task::find($request->task_id)->update([
                'is_pending' => 0,
                'is_completed' => 1,
            ]);
        $alert = __('Task Completed');
        }
        else{
            $task = Task::find($request->task_id)->update([
                'is_pending' => 1,
            ]);
            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Task Mark as Completed'; 
            $body = Auth::user()->name.' Completed his task, please check Awaiting For Approval tab for review'; 
            if($user->email_professional){
                Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

            $notification = Notifications::create([
                'title'  => ['en' => 'Task Mark as Completed', 'fr' =>'Marquer la tâche comme achevée'],
                'body'   => ['en' => Auth::user()->name.' Completed his task, please check Awaiting For Approval tab for review', 'fr' =>  Auth::user()->name.' a terminé sa tâche, veuillez vérifier l\'onglet Attente d\'approbation pour la révision.'],
                'user_id' => 1, 
                'client_id' => 0,
                ]);
            $alert = __('Task waiting for approval');
        }

        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();

        $view = view('includes.crm.view-notification', compact('notification')); 
        $response = $view->render(); 

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => $alert, 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count, 'response' => $response,
        'count'=>$count]);
    } 
    // Task Confirm 
    public function taskConfirm(Request $request){

        
        $task = Task::find($request->task_id)->update([
            'is_pending' => 0,
            'is_completed' => 1,
        ]); 
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Completed'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);
    }

    // Task Re assign 
    public function taskReassign(Request $request){
         
        $task = Task::find($request->task_id);
        $task->update([
            'is_pending' => 0,
            'is_completed' => 0,
        ]);


        $assignees = TaskAssign::where('task_id', $task->id)->get();

        foreach($assignees as $assignee){

            $user = User::find($assignee->assignee_id);
            $name = Auth::user()->name;
            $subject = 'Task Decline';
            $body = $user->name.', Your task was not approved';
            if($user->email_professional){
                Mail::to($user->email_professional)->send(new AssignMail($subject, $body));
            }

            $notification = Notifications::create([
             'title'  => ['en' => 'Task Decline', 'fr' =>'Déclin des tâches'],
             'body'   => ['en' => 'Your task was not approved ', 'fr' =>  'Votre tâche n\'a pas été approuvée'],
             'user_id' => $assignee->assignee_id, 
             'client_id' => 0,
             ]);
        } 

        


        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();
 
        $view = view('includes.crm.view-notification', compact('notification')); 
        $response = $view->render();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Decline'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count, 'response' => $response,
        'count'=>$count]);
    }

    // Task Important 
    public function taskImportant(Request $request){
        $task = Task::find($request->task_id);
        if($task->is_important == 0){
            $task->update([
                'is_important' => 1,
            ]);
        }else{
            $task->update([
                'is_important' => 0,
            ]);
        }

        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();


        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Important'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);    
    }

    // Task Search 
    public function taskSearch(Request $request){
        $search = $request->search;
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
       
        if($search){
            if(role() == 's_admin'){
                $tasks = Task::where('title', 'LIKE', '%'.$search.'%')->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::where('title', 'LIKE', '%'.$search.'%')->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::where('title', 'LIKE', '%'.$search.'%')->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::where('title', 'LIKE', '%'.$search.'%')->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::where('title', 'LIKE', '%'.$search.'%')->where('is_deleted', 1)->get(); 
            }else{
                $tasks = Task::whereIn('id', $data)->where('title', 'LIKE', '%'.$search.'%')->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->where('title', 'LIKE', '%'.$search.'%')->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->where('title', 'LIKE', '%'.$search.'%')->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->where('title', 'LIKE', '%'.$search.'%')->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->where('title', 'LIKE', '%'.$search.'%')->where('is_deleted', 1)->get();   
            }
 
           
        }else{ 
            if(role() == 's_admin'){
                $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::where('is_deleted', 1)->get();   
            }else{
                $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
            }
        }

        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();     
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Completed'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);

    }

    // task Model Update 
    public function taskModalUpdate(Request $request){
        $data = Task::find($request->id); 
        $allUsers = User::all();

        $title     = $data->title; 
        $due_date  = Carbon::parse($data->due_date)->format('Y-m-d'); 
        $client_id = $data->client_id; 
        $deleted   =  $data->is_deleted;
        $desc      = $data->description;
        $clients   = Client::where('deleted_status', 'no')->orderBy('first_name', 'asc')->get(); 
        $tags = Tag::all();
        $assigned = '';
        $users = '';
        $selectedTags = '';
        $selectedClient = ''; 
        $priority = '';


        foreach($clients as $client)
        {
            if($client_id == $client->id)
            {
                $selectedClient .= "<option selected value='".$client->id."'>".$client->first_name."</option>";
            }
            else 
            {
                $selectedClient .=  "<option value='".$client->id."'>".$client->first_name."</option>";
            }
        }


           foreach($allUsers as $user)
           {
                    if (taskAssign($user->id, $data->id))   
                    {
                        $assigned .= "<option selected value='".$user->id."'>".$user->name."</option>";
                    }
                    else 
                    {
                        $assigned .=  "<option value='".$user->id."'>".$user->name."</option>";
                    }

           }


           if($data->priority == 'High')
           {
                $priority = "<option selected value='".$data->priority."'>".$data->priority."</option>
                <option value='Medium'>Medium</option>
                <option value='Low'>Low</option> ";
           }
           elseif($data->priority == 'Medium')
           {
                $priority = "<option selected value='".$data->priority."'>".$data->priority."</option><option value='High'>High</option>
                <option value='Low'>Low</option> ";
           }
           elseif($data->priority == 'Low')
           {
                $priority = "<option selected value='".$data->priority."'>".$data->priority."</option><option value='High'>High</option>
                <option value='Medium'>Medium</option> ";
           }

           foreach ($tags as $tag)
           {
                    if (getTaskTag($tag->id, $data->id))
                    {
                      $selectedTags .=  "<option selected value='".$tag->id."'>".$tag->name."</option>";
                    }
                    else 
                    {

                        $selectedTags .=  "<option value='".$tag->id."'>".$tag->name."</option>";
                    }
           }




        return response()->json([
            'title'      => $title, 
            'due_date'   => $due_date, 
            'priority'   => $priority, 
            'desc'       => $desc,
            'assigned'   => $assigned,
            'tags'       => $selectedTags,
            'clients'    => $selectedClient,
            'deleted'    => $deleted

        ]);

    }

    // Task Update 
    public function updateTask(Request $request){
        
       $task = Task::find($request->task_id);
       $task->update([
        'title'          => $request->title,   
        'client_id'      => $request->client_id,
        'due_date'       => $request->due_date,
        'priority'       => $request->priority,
        'description'    => $request->description,
        'created_by'     => Auth::id(),
        ]);  

        $task_tag = TaskTag::where('task_id', $task->id)->get();

        if($task_tag->count() > 0){
            foreach($task_tag as $tag){
                $tag->delete();
            }
        }

        foreach($request->tags as $tag){
            TaskTag::create([
            'task_id'       => $task->id,
            'tag_id'   => $tag,
            ]);
        } 

        $task_assignee = TaskAssign::where('task_id', $task->id)->get();

        if($task_assignee->count() > 0){
            foreach($task_assignee as $assignee){
                $assignee->delete();
            }
        }

        foreach($request->assignee as $assignee){
            TaskAssign::create([
            'task_id'       => $task->id,
            'assignee_id'   => $assignee,
            ]);

            // if(checkNotificationStatus('task assign', $assignee)){
                $user = User::find($assignee);
                $name = Auth::user()->name;
                $subject = 'New Task Assign';
                $body = $user->name.', You have been assigned a task by '.$name;
                if($user->email_professional){
                    Mail::to($user->email_professional)->send(new AssignMail($subject, $body));
                }
            // }

            $notification = Notifications::create([
                'title'  => ['en' => 'Task Assign', 'fr' =>'Attribution des tâches'],
                'body'   => ['en' => 'You have been assigned a task by '.Auth::user()->name, 'fr' =>  'Vous avez été chargé d\'une tâche par '.Auth::user()->name],
                'user_id' => $assignee, 
                'client_id' => 0,
            ]);
    
        } 

        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }

        $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();
 
        $view = view('includes.crm.view-notification', compact('notification')); 
        $response = $view->render(); 

        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Updated'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count, 'response' => $response, 'count'=>$count]);

    }

    // Task Delete 
    public function taskDestroy(Request $request){
        
        $task = Task::find($request->task_id);
        if($task->is_deleted == 0){
            $task->is_deleted = 1;
            $task->save();
        }
        else{ 
            $task->delete();
        }
        
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Deleted'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast, 'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);


    }

    // Task Restore 
    public function taskRestore(Request $request){
        
        $task = Task::find($request->task_id); 

            $task->is_deleted = 0;
            $task->save();
       
        
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if(role() == 's_admin'){
            $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::where('is_deleted', 1)->get();   
        }else{
            $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
            $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
            $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
            $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
            $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
        }
        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['alert' => __('Task Restore'), 'all' => $alltask, 'complete' => $completetask, 'important' => $importanttast, 'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);


    }

    // Priority Filter 
    public function priorityFilter(Request $request){
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        
        if($request->priority == 'All'){
            if(role() == 's_admin'){
                $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::where('is_deleted', 1)->get();   
            }else{
                $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
            } 
        }
        else{ 
            if(role() == 's_admin'){
                $tasks = Task::where('priority', $request->priority)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::where('priority', $request->priority)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::where('priority', $request->priority)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::where('priority', $request->priority)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::where('priority', $request->priority)->where('is_deleted', 1)->get();
            }else{
                $tasks = Task::whereIn('id', $data)->where('priority', $request->priority)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->where('priority', $request->priority)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->where('priority', $request->priority)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->where('priority', $request->priority)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->where('priority', $request->priority)->where('is_deleted', 1)->get();   
            } 
        }

        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['all' => $alltask, 'complete' => $completetask, 'important' => $importanttast,'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);

        
    }

    // Tag Filter 
    public function tagFilter(Request $request){

        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        if($request->tag == 'All'){
            if(role() == 's_admin'){
                $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::where('is_deleted', 1)->get();   
            }else{
                $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->where('is_deleted', 1)->get();   
            } 
        }
        else{  
            $task_tag = TaskTag::where('tag_id', $request->tag)->get('task_id');  
            if(role() == 's_admin'){
                $tasks = Task::whereIn('id', $task_tag)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $task_tag)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $task_tag)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $task_tag)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $task_tag)->where('is_deleted', 1)->get();
            }else{
                $tasks = Task::whereIn('id', $data)->whereIn('id', $task_tag)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
                $complete_tasks = Task::whereIn('id', $data)->whereIn('id', $task_tag)->where('is_completed', 1)->where('is_deleted', 0)->get();
                $important_tasks = Task::whereIn('id', $data)->whereIn('id', $task_tag)->where('is_important', 1)->where('is_deleted', 0)->get();
                $pending_tasks = Task::whereIn('id', $data)->whereIn('id', $task_tag)->where('is_pending', 1)->where('is_deleted', 0)->get();
                $deleted_tasks = Task::whereIn('id', $data)->whereIn('id', $task_tag)->where('is_deleted', 1)->get();   
            }

        }

        $tags = Tag::all();
        $users =  User::all();
        $clients = Client::where('deleted_status', 'no')->get();
        $my_Task_count = $tasks->count();
        $important_Task_count = $important_tasks->count();
        $completed_Task_count = $complete_tasks->count();
        $pending_Task_count = $pending_tasks->count();
        $deleted_Task_count = $deleted_tasks->count();

        $all_task = view('includes.crm.all-task',compact('tasks','users', 'clients', 'tags'));
        $completed = view('includes.crm.complete-task',compact('complete_tasks','users', 'clients', 'tags'));
        $important = view('includes.crm.important-task',compact('important_tasks','users', 'clients', 'tags'));
        $pending = view('includes.crm.pending-task',compact('pending_tasks','users', 'clients', 'tags'));
        $deleted = view('includes.crm.deleted-task',compact('deleted_tasks','users', 'clients', 'tags'));

        $alltask = $all_task->render();
        $completetask = $completed->render();
        $importanttast = $important->render();
        $pendingtast = $pending->render();
        $deletedtask = $deleted->render();


        return response()->json(['all' => $alltask, 'complete' => $completetask, 'important' => $importanttast, 'pending' => $pendingtast, 'delete' => $deletedtask, 'my_Task_count' => $my_Task_count, 'important_Task_count'=>$important_Task_count, 'completed_Task_count'=>$completed_Task_count, 'pending_Task_count' => $pending_Task_count, 'deleted_Task_count'=>$deleted_Task_count]);

    }

    // Tag Save 
    public function taskTagStore(Request $request){
        
        if($request->existing_tag_id){
            Tag::find($request->existing_tag_id)->update([
                'name' => $request->name,
            'color' => $request->color,
            ]);
            return redirect()->back()->with('success', __('Updated Successfully'));
        }else{ 
            Tag::create([
                'name' => $request->name,
                'color' => $request->color,
            ]);
            return redirect()->back()->with('success', __('Added Successfully'));
        }
    }

    public function taskTagDelete(Request $request){

        $task_tag = TaskTag::where('tag_id', $request->task_tag_id)->get();
        if($task_tag->count() > 0){ 
            foreach($task_tag as $tag){
                $tag->delete();
            }
        }


        Tag::find($request->task_tag_id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }


    public function notificationViewTodo($id){

        $notification = Notifications::findOrFail($id);
        $notification->status = '1';
        $notification->save();

        return redirect()->route('todo.index');
    }
}

