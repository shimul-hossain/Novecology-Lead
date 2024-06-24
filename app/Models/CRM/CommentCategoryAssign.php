<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentCategoryAssign extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
