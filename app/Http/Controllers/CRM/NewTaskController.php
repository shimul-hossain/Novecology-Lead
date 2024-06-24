<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\NewTask;
use App\Models\CRM\ProjectIntervention;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewTaskController extends Controller
{
    public function store(Request $request){

         $request->validate([
            'project_id' => 'required',
         ],[
            'project_id.required' => 'Le client est requis',
         ]);

         NewTask::create([
            'type'          => $request->task_type,
            'project_id'    => $request->project_id,
            'description'   => $request->description,
            'status'        => $request->status ?? 'En traitement',
            'user_id'       => Auth::id(),
         ]);

         return back()->with('success', __("Created Successfully"));

    }

    public function update(Request $request){

         $request->validate([
            'project_id' => 'required',
         ],[
            'project_id.required' => 'Le client est requis',
         ]);
         $task = NewTask::find($request->id);
         $task->update([
            'type'          => $request->task_type,
            'project_id'    => $request->project_id,
            'description'   => $request->description,
            'status'        => $request->status ?? 'En traitement',
         ]);

         return back()->with('success', __("Updated Succesfully"));

    }

    public function projectChange(Request $request){

        $type = $request->type;
        if($type == 'Prospect'){
           $item  = LeadClientProject::find($request->id);
           $travaux = $item->LeadTravax;
           $tags = $item->LeadTravaxTags; 
         }else if($type == 'Chantier'){
            $item  = NewProject::find($request->id);
            $travaux = $item->ProjectTravaux;
            $tags = $item->ProjectTravauxTags;
         }

         $department = getDepartment2($item->Code_Postal);

        $view = view('admin.dashboard-task-project-change', compact('item', 'travaux', 'tags', 'department'))->render();
        return response($view);
    }

    public function typeChange(Request $request){
      
         $stats_regies = Auth::user()->allRegie; 
         $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
         $type = $request->type;
         $id = $request->id;
         if($type == 'Prospect'){
            if(in_array(role(), $administrarif_role)){   
                $items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
            }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                  $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                  $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                  $items = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                  $items = Auth::user()->getLeads()->orderBy('Code_Postal', 'asc')->get();
               } 
            }  
         }else if($type == 'Chantier'){
            if(in_array(role(), $administrarif_role)){ 
               $items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
           }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                   $stats_regies = Auth::user()->allRegie; 
                   $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                   $items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else if(role() == 'team_leader'){
                   $team_users = Auth::user()->getTeamUsers;
                   $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                   $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                   if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                       $items = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   }else{
                       $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                       $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   } 
               }
           }
         }
         

        $view = view('admin.dashboard-task-type-change', compact('items', 'type', 'id'))->render();
        return response($view);
    }
    public function eventTypeChange(Request $request){
      
         $stats_regies = Auth::user()->allRegie; 
         $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
         $type = $request->type;
         $id = $request->id;
         if($type == 'Prospect'){
            if(in_array(role(), $administrarif_role)){   
                $items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
            }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                  $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                  $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                  $items = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                  $items = Auth::user()->getLeads()->orderBy('Code_Postal', 'asc')->get();
               } 
            }  
         }else if($type == 'Chantier'){
            if(in_array(role(), $administrarif_role)){ 
               $items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
           }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                   $stats_regies = Auth::user()->allRegie; 
                   $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                   $items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else if(role() == 'team_leader'){
                   $team_users = Auth::user()->getTeamUsers;
                   $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                   $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                   if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                       $items = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   }else{
                       $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                       $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   } 
               }
           }
         }
         

        $view = view('admin.dashboard-event-type-change', compact('items', 'type', 'id'))->render();
        return response($view);
    }
    public function eventTypeChange2(Request $request){
      
         $stats_regies = Auth::user()->allRegie; 
         $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
         $type = $request->type;
         $id = $request->id;
         if($type == 'Prospect'){
            $selected_item = LeadClientProject::find($request->id);
            if(in_array(role(), $administrarif_role)){   
                $items = LeadClientProject::where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
            }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                  $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                  $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
                  $items = LeadClientProject::whereIn('lead_telecommercial', $user_ids)->where('lead_deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                  $items = Auth::user()->getLeads()->orderBy('Code_Postal', 'asc')->get();
               } 
            }  
         }else if($type == 'Chantier'){
            $selected_item = NewProject::find($request->id);
            if(in_array(role(), $administrarif_role)){ 
               $items = NewProject::where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
           }else{ 
               if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                   $stats_regies = Auth::user()->allRegie; 
                   $user_ids = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->pluck('id');
                   $items = NewProject::whereIn('project_telecommercial', $user_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else if(role() == 'team_leader'){
                   $team_users = Auth::user()->getTeamUsers;
                   $intervention_project_ids = ProjectIntervention::whereIn('user_id', $team_users->pluck('id'))->whereIn('type', ['Installation', 'SAV', 'Déplacement', 'Contre Visite Technique'])->pluck('project_id')->toArray();
                   $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
               }else{
                   if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                       $items = Auth::user()->getTelecommiercialProjects()->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   }else{
                       $intervention_project_ids = ProjectIntervention::where('user_id', Auth::id())->pluck('project_id')->toArray();
                       $items = NewProject::whereIn('id', $intervention_project_ids)->where('deleted_status', 0)->orderBy('Code_Postal', 'asc')->get();
                   } 
               }
           }
         }
         

        $view = view('admin.dashboard-event-type-change2', compact('items', 'type', 'id', 'selected_item'))->render();
        return response($view);
    }
}
