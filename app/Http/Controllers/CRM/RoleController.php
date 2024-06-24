<?php

namespace App\Http\Controllers\CRM;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Role;
use App\Models\CRM\Company;
use Illuminate\Http\Request;
use App\Models\CRM\Permission;
use App\Models\CRM\ProjectStatus;
use App\Models\CRM\UserPermission;
use App\Http\Controllers\Controller;
// use Illuminate\Routing\Route;
use App\Models\CRM\ActionPermission;
use App\Models\CRM\CompanyPermission;
use App\Models\CRM\Document;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Models\CRM\RoleActionPermission;
use App\Models\CRM\RoleCategoryNavPermission;
use App\Models\RoleCategory;
use Illuminate\Support\Str;
use App\Models\CRM\RoleCategoryActionPermission;
use PDO;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    
    // return Role Page 
    public function roleIndex(){
        
        $roles = Role::where('status', 'active')->get();
        $inactive_roles = Role::where('status', 'inactive')->get();
        $companies = Company::all();
        $categories = RoleCategory::all();
        $documents = Document::all();
        return view('admin.role', compact('roles', 'companies', 'categories', 'inactive_roles','documents'));
    }

    
    // Role Store 
    public function roleStore(Request $request){ 
        
        $role = Role::create([
            'name' => ['en' => $request->name, 'fr' => $request->name],
            'category_id' => $request->category_id,
            'value' => str_replace(' ','_', $request->name).'_'.time(),
        ]);

        $navPermission = RoleCategoryNavPermission::where('category_id', $request->category_id)->get();
        foreach($navPermission as $permission){
            UserPermission::create([
                'role_id' => $role->id,
                'navigation_id' => $permission->navigation_id,
                'route' => $permission->route,
            ]);
        }

        $actionPermission = RoleCategoryActionPermission::where('category_id', $request->category_id)->get();
        foreach($actionPermission as $perm){
            RoleActionPermission::create([
                'role_id' => $role->id,
                'module_name' => $perm->module_name,
                'action_name' => $perm->action_name,
            ]);
        }
        
        return back()->with('success', __('Role Added Successfully'));
    }

    // role Update 
    public function roleUpdate(Request $request){
        
        $data = Role::findOrFail($request->role_id);
        $x_role_category = $data->category_id;
        $data->name = ['en' => $request->name, 'fr' => $request->name];
        $data->category_id = $request->category_id;
        $data->save(); 
        if($x_role_category != $data->category_id)
        { 
            $users = User::where('role_id', $request->role_id)->get(); 

            $x_navPermission = UserPermission::where('role_id', $request->role_id)->get();
            foreach($x_navPermission as $x_permission){
                $x_permission->delete();
            }
            $x_permissions = Permission::where('role_id', $request->role_id)->get();
            foreach($x_permissions as $x_pers){
                $x_pers->delete();
            }
            $navPermission = RoleCategoryNavPermission::where('category_id', $request->category_id)->get();
            foreach($navPermission as $permission){
                UserPermission::create([
                    'role_id' => $request->role_id,
                    'navigation_id' => $permission->navigation_id,
                    'route' => $permission->route,
                ]);
            }
            $userPerms = UserPermission::where('role_id', $request->role_id)->get();
            foreach($userPerms as $userPerm){
                foreach($users as $user){
                    Permission::create([ 
                        'role_id'       =>  $request->role_id,
                        'name'          => $userPerm->route,
                        'navigation_id' => $userPerm->navigation_id,
                        'user_id'       => $user->id,
                    ]);
                }

            }
            $x_role_perms = RoleActionPermission::where('role_id', $request->role_id)->get();
            foreach($x_role_perms as $x_role){
                $x_role->delete();
            }
 
            foreach($users as $user){
                $x_actionPermission = ActionPermission::where('user_id', $user->id)->get();
                foreach($x_actionPermission as $x_perm){
                    $x_perm->delete();
                }
            }
            $actionPermission = RoleCategoryActionPermission::where('category_id', $request->category_id)->get();
            foreach($actionPermission as $perm){
                RoleActionPermission::create([
                    'role_id' => $request->role_id,
                    'module_name' => $perm->module_name,
                    'action_name' => $perm->action_name,
                ]);
            }

            $actionPerms = RoleActionPermission::where('role_id', $request->role_id)->get();
            foreach($actionPerms as $actionPerm){
                foreach($users as $user){
                    ActionPermission::create([
                        'user_id' => $user->id,
                        'module_name' => $actionPerm->module_name,
                        'action_name' => $actionPerm->action_name,
                    ]);
                }
            }
        } 

        return back()->with('success', __('Role Update Successfullly'));
    }

    // Role Delete 
    public function roleDelete(Request $request){
        
        $role = Role::find($request->role_id)->delete();
        $permission = UserPermission::where('role_id', $request->role_id)->get();
        if($permission->count() > 0){
            foreach($permission as $item){
                $item->delete();
            }
        }
        
        return back()->with('success', __('Role Deleted Successfuly'));

    }

    // Add permission 
    public function addPermission(Request $request){
        $users  = User::where('role_id', $request->role_id)->get(); 
        if($users->count()>0){
            foreach($users as $user){
                $permission = Permission::where('role_id', $request->role_id)->where('name', $request->route)->where('user_id', $user->id)->first();
                if(!$permission){
                    Permission::create([ 
                        'role_id' =>  $request->role_id,
                        'name'    => $request->route,
                        'navigation_id' => $request->navigation_id,
                        'user_id'      => $user->id,
                    ]);
                }
            }
        }
        if($request->navigation_id){
            UserPermission::create($request->except('_token') + ['created_at' => Carbon::now()]);
            
        }
        else {
            
            UserPermission::create($request->except('_token', 'navigation_id') + ['created_at' => Carbon::now()]);
        }


        return response(__('Permission Updated'));
    }

    // remove Permission
    public function removePermission(Request $request){

        $users  = User::where('role_id', $request->role_id)->get(); 
        if($users->count()>0){
            foreach($users as $user){
                $permission = Permission::where('role_id', $request->role_id)->where('name', $request->route)->where('user_id', $user->id)->first();
                if($permission){
                    $permission->delete();
                }
            }
        }
        if($request->navigation_id){
            UserPermission::where('navigation_id', $request->navigation_id)->where('role_id', $request->role_id)->delete();
        }
        else{
            UserPermission::where('route', $request->route)->where('role_id', $request->role_id)->delete();
            
        }
        return response(__('Permission Removed'));
    }

    // Add Company Permission 
    public function addCompanyPermission(Request $request){

        CompanyPermission::create($request->except('_token') + ['created_at' => Carbon::now()]);
        return response(__('Permission Updated'));

    }

    // Remove Company Permission 
    public function removeCompanyPermission(Request $request){

        CompanyPermission::where('company_id', $request->company_id)->delete();

        return response(__('Permission Removed'));
    }

    // Search Compnay Form Role 
    public function searchCompanyPermission(Request $request){ 
        $role_id = $request->role_id;
        $search = $request->search; 
        
        if ($search != '') {
            $companies = Company::where('company_name', 'LIKE',  '%'.$search.'%')->get();
        } else {
            $companies = Company::all(); 
        } 
     
        $view = view('includes.crm.company-permission', compact('companies', 'role_id'));
        $response = $view->render(); 
        return response()->json(['response' => $response]);
    }

    // Action permission 
    public function permissionAction(Request $request){
        
        $permission = ActionPermission::where('user_id', $request->user_id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first();
        if($permission){
            $permission->delete();
        }else{
            ActionPermission::create($request->except('_token'));
        }
         
        return response(__('Permission Updated'));
    }

    public function rolePermissionAction(Request $request){
                
        $permission = RoleActionPermission::where('role_id', $request->role_id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first();
        $users  = User::where('role_id', $request->role_id)->get();
        if($users->count()>0){
            foreach($users as $user){
                $perm = ActionPermission::where('user_id', $user->id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first();
                if($perm){
                    $perm->delete();
                }
            }
        }
        if($permission){
            $permission->delete();
        }else{
            RoleActionPermission::create($request->except('_token'));
            if($users->count()>0){
                foreach($users as $user){
                    ActionPermission::create([
                        'user_id' => $user->id,
                        'module_name' => $request->module_name,
                        'action_name' => $request->action_name,
                    ]);
                }
            }
        }
         
        return response(__('Permission Updated'));
    }

    public function userPermission(Request $request){
        $permission = Permission::where('user_id', $request->user_id)->where('name', $request->name)->first(); 
        if($permission){
            $permission->delete();
        }else{
            Permission::create($request->except('_token'));
        }
         
        return response(__('Permission Updated'));
    }

        // return Role Category Page 
        public function roleCategory(){
            $permission = Permission::where('user_id', Auth::id())->where('name', 'role.index')->first();

            if(role() != 's_admin')
            {
                if(!$permission){
                    return redirect()->route('permission.none');
                }
            }
    
            $roles = Role::where('status', 'active')->get();
            $companies = Company::all();
            $categories = RoleCategory::all();
            $documents = Document::all();
            return view('admin.role_category', compact('roles', 'companies', 'categories','documents'));
        }

        public function categoryStore(Request $request){
            $request->validate([
                'name' => 'required',
            ]);

            RoleCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);


            return back()->with('success', __('Created Successfully'));
        }

        public function categoryUpdate(Request $request){
            $request->validate([
                'name' => 'required',
            ]);

            RoleCategory::find($request->role_id)->update([
                'name' => $request->name
            ]);

            return back()->with('success', __('Updated Succesfully'));
        }

        public function permissionUpdate(Request $request){
            if($request->value == 'yes'){
                $roles = Role::where('category_id', $request->category_id)->get();
                foreach($roles as $role){
                    $rolePermission = UserPermission::where('role_id', $role->id)->where('route', $request->route)->first();
                    if(!$rolePermission){
                        UserPermission::create([
                            'role_id' => $role->id,
                            'navigation_id' => $request->navigation_id,
                            'route' => $request->route,
                        ]);
                    }
                    $users  = User::where('role_id', $role->id)->get();
                    if($users->count()>0){
                        foreach($users as $user){
                            $permission = Permission::where('role_id', $role->id)->where('name', $request->route)->where('user_id', $user->id)->first();
                            if(!$permission){
                                Permission::create([ 
                                    'role_id' =>  $role->id,
                                    'name'    => $request->route,
                                    'navigation_id' => $request->navigation_id,
                                    'user_id'      => $user->id,
                                ]);
                            }
                        }
                    } 
                }
                if($request->navigation_id){
                    RoleCategoryNavPermission::create($request->except(['_token', 'value']) + ['created_at' => Carbon::now()]);
                }
                else {
                    RoleCategoryNavPermission::create($request->except(['_token', 'navigation_id', 'value']) + ['created_at' => Carbon::now()]);
                }
            }else{
                $roles = Role::where('category_id', $request->category_id)->get();
                foreach($roles as $role){
                    $rolePermission = UserPermission::where('role_id', $role->id)->where('route', $request->route)->first();
                    if($rolePermission){
                        $rolePermission->delete();
                    }
                    $users  = User::where('role_id', $role->id)->get();
                    if($users->count()>0){
                        foreach($users as $user){
                            $permission = Permission::where('role_id', $role->id)->where('name', $request->route)->where('user_id', $user->id)->first();
                            if($permission){
                               $permission->delete();
                            }
                        }
                    } 
                }
                if($request->navigation_id){
                    RoleCategoryNavPermission::where('navigation_id', $request->navigation_id)->where('category_id', $request->category_id)->delete();
                }
                else{
                    RoleCategoryNavPermission::where('route', $request->route)->where('category_id', $request->category_id)->delete();   
                }
            }


            return response(__('Permission Updated'));

        }

        public function categoryPermissionAction(Request $request){
                            
            $permission = RoleCategoryActionPermission::where('category_id', $request->category_id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first();

            $roles = Role::where('category_id', $request->category_id)->get();
            foreach($roles as $role){
                $role_perm = RoleActionPermission::where('role_id', $role->id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first(); 
                if($role_perm){
                    $role_perm->delete();
                }
                $users  = User::where('role_id', $role->id)->get();
                if($users->count()>0){
                    foreach($users as $user){
                        $perm = ActionPermission::where('user_id', $user->id)->where('module_name', $request->module_name)->where('action_name', $request->action_name)->first();
                        if($perm){
                            $perm->delete();
                        }
                    }
                }
            }
            if($permission){
                $permission->delete();
            }else{

                RoleCategoryActionPermission::create($request->except('_token'));
                foreach($roles as $role){
                    RoleActionPermission::create([
                        'role_id'     => $role->id,
                        'module_name' => $request->module_name,
                        'action_name' => $request->action_name,
                    ]);
                    $users = User::where('role_id', $role->id)->get();
                    if($users->count()>0){
                        foreach($users as $user){
                            ActionPermission::create([
                                'user_id' => $user->id,
                                'module_name' => $request->module_name,
                                'action_name' => $request->action_name,
                            ]);
                        }
                    }
                }
            }
            
            return response(__('Permission Updated'));
        }


        public function roleDuplicate(Request $request){

            $x_role = Role::find($request->id);
            if($x_role){
                $new_role = $x_role->replicate();
                $new_role->value = $x_role->value.'_copy_'.time();
                $new_role->created_at = Carbon::now();
                $new_role->save();
                $permissions = Permission::where('role_id', $x_role->id)->get();
                $user_permissions = UserPermission::where('role_id', $x_role->id)->get();
                $all_permissions = RoleActionPermission::where('role_id', $x_role->id)->get();
                foreach($permissions as $permission1){
                    Permission::create([
                        'name' => $permission1->name, 
                        'navigation_id' => $permission1->navigation_id, 
                        'user_id' => $permission1->user_id, 
                        'status' => $permission1->status, 
                        'role_id'     => $new_role->id,
                    ]);
                }
                foreach($user_permissions as $permission2){
                    UserPermission::create([ 
                        'navigation_id' => $permission2->navigation_id, 
                        'route' => $permission2->route,  
                        'role_id'     => $new_role->id,
                    ]);
                }
                foreach($all_permissions as $permission){
                    RoleActionPermission::create([
                        'module_name' => $permission->module_name,
                        'action_name' => $permission->action_name,
                        'role_id'     => $new_role->id,
                    ]);
                }

            }

            return back()->with('success', 'Rôle dupliqué avec succès');
        }

        public function roleInactive(Request $request){
            $role = Role::find($request->id);
            if($role){
                $role->status = 'inactive';
                $role->save();
            }

            return back()->with('success', 'Rôle inactif avec succès');
        }
        
        public function roleActive(Request $request){
            $role = Role::find($request->id);
            if($role){
                $role->status = 'active';
                $role->save();
            }
    
            return back()->with('success', 'Rôle actif avec succès');
        }


    // END
}
