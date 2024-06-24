<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    use HasFactory;
    protected $guarded = '';

    public function getUser(){
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
