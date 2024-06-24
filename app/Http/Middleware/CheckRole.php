<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CRM\Permission;
use App\Models\CRM\UserPermission;
use Illuminate\Support\Facades\Auth;
use App\Models\CRM\CompanyPermission;
use Illuminate\Support\Facades\Route;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $currentRoute = Route::currentRouteName();
        $permission = Permission::where('user_id', Auth::id())->where('name', $currentRoute)->first();

        if(role() != 's_admin')
        {
            if(!$permission){
                return redirect()->route('permission.none');
            }
        }


        return $next($request);
    }    
}
