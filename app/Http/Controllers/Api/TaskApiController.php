<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CRM\Task;
use App\Models\CRM\TaskAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskApiController extends Controller
{
    public function index(){
        
        $tasks = Task::where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
        return response()->json(['data' => $tasks], 200);
    }

    public function userTask(){
        $data = TaskAssign::where('assignee_id', Auth::id())->pluck('task_id'); 
        $tasks = Task::whereIn('id', $data)->where('is_completed', 0)->where('is_pending', 0)->where('is_deleted', 0)->get();
        return response()->json(['data' => $tasks], 200);
    }
}
