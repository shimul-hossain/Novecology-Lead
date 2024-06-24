<?php

namespace App\Http\Controllers;

use App\Models\Cookie;
use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function cookieStore(Request $request){

        $device = Cookie::where('device_ip', Request()->ip())->first();
        if($device){
            $device->cookie_status  = $request->data;
            $device->save();
        }else{
            Cookie::create([
                'device_ip'  => Request()->ip(),
                'cookie_status' => $request->data,
            ]);
        }

        return response('cookie updated');
    }
}
