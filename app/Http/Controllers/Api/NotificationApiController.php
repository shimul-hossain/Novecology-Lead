<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CRM\Notifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationApiController extends Controller
{
    public function index(){
        $data = Notifications::where('user_id', Auth::id())->get();
        return response()->json(['data' => $data], 200);
    }
}
