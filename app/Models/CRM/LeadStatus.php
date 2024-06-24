<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function getLeads(){
        return $this->hasMany(LeadClientProject::class,'lead_label', 'id')->where('lead_deleted_status', 0);
    }
    public function getSubStatus(){
        return $this->belongsToMany(LeadSubStatus::class, 'lead_status_sub_statuses', 'status_id', 'sub_status_id')->orderBy('order', 'asc');
    }
}
