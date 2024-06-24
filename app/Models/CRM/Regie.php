<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class, 'team_leader_id', 'id');
    }
    public function getAllUser(){
        return $this->hasMany(User::class, 'regie_id', 'id')->where('deleted_status', 'no')->where('status', 'active');;
    }

    public function getNonAttribueLead(){
        return $this->hasMany(LeadClientProject::class, 'import_regie', 'id')->where('lead_label', 1)->where('lead_deleted_status', 0);
    }
}
