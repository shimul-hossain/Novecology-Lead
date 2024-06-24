<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadClientProject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function LeadBareme(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'lead_work_baremes', 'work_id', 'barame_id');
    }
    public function LeadTravax(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'lead_work_travauxes', 'work_id', 'travaux_id');
    }
    public function LeadTravaxTags(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'lead_travaux_tags', 'lead_id', 'tag_id');
    }

    public function getLeadActivity(){
        return $this->hasMany(PannelLogActivity::class, 'feature_id', 'id')->where('feature_type', 'lead')->orderBy('id', 'desc');
    }
    public function getLeadComments(){
        return $this->hasMany(LeadComment::class, 'lead_id', 'id')->orderBy('id', 'desc');
    }

    public function leadTelecommercial(){
        return $this->belongsTo(User::class, 'lead_telecommercial', 'id');
    }

    public function getSubStatus(){
        return $this->belongsTo(LeadSubStatus::class, 'sub_status', 'id');
    }

    public function getStatus(){
        return $this->belongsTo(LeadStatus::class, 'lead_label', 'id');
    }

    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }

    public function callbackHistory(){
        return $this->hasMany(CallbackHistory::class, 'feature_id', 'id')->where('type', 'lead');
    }
    
    public function getSupplier(){
        return $this->belongsTo(Fournisseur::class, '__tracking__Fournisseur_de_lead', 'id');
    }
    public function primaryTax(){
        return $this->hasOne(LeadTax::class, 'lead_id', 'id')->where('primary', 'yes');
    }

    public function getRegie(){
        return $this->belongsTo(Regie::class, 'import_regie', 'id');
    }
}
