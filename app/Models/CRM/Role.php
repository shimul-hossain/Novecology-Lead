<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $guarded = [];
    
    public $translatable = ['name'];

    public function getUsers(){
        return $this->hasMany(User::class, 'role_id', 'id')->where('deleted_status', 'no')->where('status', 'active');
    }

    public function commentCategory(){
        return $this->belongsToMany(CommentCategory::class, 'role_comment_categories', 'role_id', 'category_id');
    }
}
