<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningFilter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
