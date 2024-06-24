<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getAssignee()
    {
        return $this->hasMany('\App\Models\CRM\TaskAssign', 'task_id', 'id');
    }

    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
