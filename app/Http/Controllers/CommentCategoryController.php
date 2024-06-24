<?php

namespace App\Http\Controllers;

use App\Models\CRM\CommentCategory;
use App\Models\CRM\CommentCategoryAssign;
use Illuminate\Http\Request;
use App\Models\CRM\ProjectComment;
use App\Models\RoleCategory;
use App\Models\User;

class CommentCategoryController extends Controller
{
    public function categoryAdd(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        if($request->id == 0){
           $comment = CommentCategory::create([
                'name'              => $request->name,
                'background_color'  => $request->background_color,
                'role_category_id'  => $request->role_category_id,
            ]);
            // $comment->assignee()->attach($request->comment_category_assignee);
        }else{
            $comment = CommentCategory::find($request->id);
            $comment->update([
                'name'              => $request->name,
                'background_color'  => $request->background_color,
                'role_category_id'  => $request->role_category_id,
            ]);

            // $comment->assignee()->sync($request->comment_category_assigne);
            // CommentCategoryAssign::where('comment_category_id', $comment->id)->get()->each->delete();
        }
        $comment->roles()->sync($request->role_id);
        $users_id = [];
        foreach($comment->roles as $role){
            foreach(User::where('role_id', $role->id)->get() as $user){
                $users_id[] = $user->id;
            }
        }
        $comment->assignee()->sync($users_id);

        // if($request->role_category_id){
        //     $role_category = RoleCategory::find($request->role_category_id);
        //     if($role_category){
        //         foreach($role_category->role as $role){
        //             foreach(User::where('role_id', $role->id)->get() as $user){
        //                 CommentCategoryAssign::create([
        //                     'comment_category_id' => $comment->id,
        //                     'user_id' => $user->id
        //                 ]);
        //             }
        //         }
        //     }
        // }
 
        return back()->with('success', __("Created Successfully"))->with('comment_category', 1);

        // $categories = CommentCategory::all();
        // $view = view('admin.comment_category_list', compact('categories'))->render();
        // return response($view);
    }

    public function categoryDelete(Request $request){
        
        $comments = ProjectComment::where('category_id', $request->id)->get();
        foreach($comments as $comment){
            $comment->update([
                'category_id' => null
            ]);
        }

        CommentCategory::find($request->id)->delete();

        return back()->with('success', __("Deleted Successfully"))->with('comment_category', 1);

        // $categories = CommentCategory::all();
        // $view = view('admin.comment_category_list', compact('categories'))->render();
        // return response($view);
    }
}

