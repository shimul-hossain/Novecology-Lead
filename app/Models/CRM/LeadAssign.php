<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAssign extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getUserName(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
