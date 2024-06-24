<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientActivityLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tag(){
        return $this->belongsTo(TravauxTag::class, 'value', 'id');
    }
    public function barames(){
        return $this->belongsTo(Scale::class, 'value', 'id');
    }
    public function travaux(){
        return $this->belongsTo(TravauxList::class, 'value', 'id');
    }
}
