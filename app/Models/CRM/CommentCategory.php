<?php

namespace App\Models\CRM;

use App\Models\RoleCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function assignee(){
        return $this->belongsToMany(User::class, 'comment_category_assigns', 'comment_category_id', 'user_id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_comment_categories', 'category_id', 'role_id');
    }

    public function roleCategory(){
        return $this->belongsTo(RoleCategory::class, 'role_category_id', 'id');
    }
}
