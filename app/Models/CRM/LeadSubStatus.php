<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSubStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getLeads(){
        return $this->hasMany(LeadClientProject::class, 'sub_status', 'id')->where('lead_deleted_status', 0);
    }
    public function getStatus(){
        return $this->belongsToMany(LeadStatus::class, 'lead_status_sub_statuses', 'sub_status_id', 'status_id');
    }
}
