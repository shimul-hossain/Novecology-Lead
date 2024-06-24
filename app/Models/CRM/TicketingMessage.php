<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketingMessage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    
    public function sender(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file(){
        return $this->hasMany(TicketFile::class, 'message_id', 'id');
    }
}
