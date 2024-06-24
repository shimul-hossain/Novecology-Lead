<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewClient extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function getProject(){
        return $this->hasMany(NewProject::class, 'client_id', 'id')->where('deleted_status', 0);
    }

    public function getActivity(){
        return $this->hasMany(PannelLogActivity::class, 'feature_id', 'id')->where('feature_type', 'client')->orderBy('id', 'desc');
    }

    public function getComments(){
        return $this->hasMany(ClientComment::class, 'client_id', 'id');
    }

    public function getStatus(){
        return $this->belongsTo(ClientSubStatus::class, 'sub_status', 'id');
    }  
    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }
    public function getSupplier(){
        return $this->belongsTo(Fournisseur::class, '__tracking__Fournisseur_de_lead', 'id');
    }

    
    public function callbackHistory(){
        return $this->hasMany(CallbackHistory::class, 'feature_id', 'id')->where('type', 'client');
    }

    public function prospectTelecommercial(){
        return $this->belongsTo(User::class, 'lead_telecommercial', 'id');
    }
    public function clientTelecommercial(){
        return $this->belongsTo(User::class, 'client_telecommercial', 'id');
    }

    public function clientBareme(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'client_baremes', 'client_id', 'barame_id');
    }
    public function clientTravaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'client_travauxes', 'client_id', 'travaux_id');
    }
    public function clientTravauxTags(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'client_travaux_tags', 'client_id', 'tag_id');
    }
    public function primaryTax(){
        return $this->hasOne(ClientTax::class, 'client_id', 'id')->where('primary', 'yes');
    }

    public function allCommecnts(){
        return $this->hasMany(ClientComment::class, 'client_id', 'id');
    }
    public function pinComment(){
        return $this->hasOne(ClientComment::class, 'client_id', 'id')->where('pin_status', 1);
    }
}
