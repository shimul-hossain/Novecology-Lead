<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CRM\Regie;
use Illuminate\Http\Request;
use Matrix\Decomposition\LU;

class RegieController extends Controller
{
    public function userRegieAdd(Request $request){
        $request->validate([
            'regie_name' => 'required',
            'responsable_commercial' => 'required',
        ]);
        if($request->regie_id == '0'){
            Regie::create([
                'name' => $request->regie_name,
                'team_leader_id' => $request->responsable_commercial,
                'team_leader_name' => User::find($request->responsable_commercial)->name,
            ]);
            return back()->with('success', __('Added Succesfully'))->with('regie_tab_active', '1');
        }else{
            Regie::find($request->regie_id)->update([
                'name' => $request->regie_name,
                'team_leader_id' => $request->responsable_commercial,
                'team_leader_name' => User::find($request->responsable_commercial)->name,
            ]);
            return back()->with('success', __('Updated Succesfully'))->with('regie_tab_active', '1');
        }

    }
    
    public function userRegieDestroy(Request $request){
        Regie::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('regie_tab_active', '1');
    }

    public function regieUserList(Request $request){
        $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $selected = '';
        foreach($users as $user){
            if($request->team_leader == $user->id){
                $selected .= '<option selected value="'.$user->id.'">'.$user->name.'</option>';       
            }else{
                $selected .= '<option value="'.$user->id.'">'.$user->name.'</option>';       
            }
        } 
        
        return response($selected);
    }
}
