<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallbackHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    
    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }
}
