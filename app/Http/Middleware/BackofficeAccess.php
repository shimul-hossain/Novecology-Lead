<?php

namespace App\Http\Middleware;

use App\Models\CRM\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BackofficeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRoute = 'superadmin.dashboard';
        $permission = Permission::where('user_id', Auth::id())->where('name', $currentRoute)->first();
        if(role() != 's_admin')
        {
            if(!$permission){
                return redirect('/');
            }
        }

        return $next($request);
    }
}
