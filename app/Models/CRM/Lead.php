<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getCompany(){
        return $this->belongsTo(Company::class, 'company_id','id');
    }
    public function getStatus(){
        return $this->belongsTo(LeadStatus::class, 'user_status', 'id');
    }
    public function getComments(){
        return $this->hasMany(LeadComment::class, 'lead_id', 'id');
    }
    public function getActivity(){
        return $this->hasMany(PannelLogActivity::class, 'feature_id', 'id')->where('feature_type', 'lead')->orderBy('id', 'desc');
    }
    public function getSubStatus(){
        return $this->belongsTo(LeadSubStatus::class, 'sub_status', 'id');
    }
}
