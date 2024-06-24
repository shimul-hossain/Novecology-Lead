<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getProject(){
        return $this->hasMany(Project::class, 'client_id','id');
    }
    public function getStatus(){
        return $this->belongsTo(ClientTableStatus::class, 'user_status', 'id');
    }  

    public function getComments(){
        return $this->hasMany(ClientComment::class, 'client_id', 'id');
    }
    public function getActivity(){
        return $this->hasMany(PannelLogActivity::class, 'feature_id', 'id')->where('feature_type', 'client')->orderBy('id', 'desc');
    }
}
