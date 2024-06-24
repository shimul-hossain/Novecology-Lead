<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PannelLogActivity extends Model
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

    public function getLeadName(){
        return $this->belongsTo(LeadClientProject::class, 'feature_id', 'id');
    }
    public function getClientName(){
        return $this->belongsTo(NewClient::class, 'feature_id', 'id');
    }
    public function getProjectName(){
        return $this->belongsTo(NewProject::class, 'feature_id', 'id');
    }

    public function leadStatus(){
        return $this->belongsTo(LeadStatus::class, 'label_id', 'id');
    }
    public function leadPrevStatus(){
        return $this->belongsTo(LeadStatus::class, 'label_prev_id', 'id');
    }

    public function leadSubStatus(){
        return $this->belongsTo(LeadSubStatus::class, 'status_id', 'id');
    }
    public function leadPrevSubStatus(){
        return $this->belongsTo(LeadSubStatus::class, 'status_prev_id', 'id');
    }

    public function projectStatus(){
        return $this->belongsTo(ProjectNewStatus::class, 'label_id', 'id');
    }
    public function projectPrevStatus(){
        return $this->belongsTo(ProjectNewStatus::class, 'label_prev_id', 'id');
    }
    public function projectSubStatus(){
        return $this->belongsTo(ProjectSubStatus::class, 'status_id', 'id');
    }
    public function projectPrevSubStatus(){
        return $this->belongsTo(ProjectSubStatus::class, 'status_prev_id', 'id');
    }

    public function assignUser(){
        return $this->belongsTo(User::class, 'value', 'id');
    }

}
