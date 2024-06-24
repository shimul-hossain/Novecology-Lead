<?php

namespace App\Models\CRM;

use App\Models\User;
use App\Models\CRM\CommentCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientComment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    
    public function getCategory(){
        return $this->belongsTo(CommentCategory::class, 'category_id', 'id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function file(){
        return $this->hasMany(ClientCommentFile::class, 'comment_id', 'id');
    }
}
