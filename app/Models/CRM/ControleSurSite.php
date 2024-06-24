<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleSurSite extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getReason(){
        return $this->hasMany(NonConfirmReason::class, 'controle_sur_site_id', 'id');
    }

    public function getAction(){
        return $this->hasMany(CompleteAction::class, 'controle_sur_site_id', 'id');
    }

    public function getBureau(){
        return $this->belongsTo(Control::class, 'Bureau_de_contrôle_id', 'id');
    }

    public function getTravaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'controle_sur_site_travauxes','controle_sur_site_id', 'travaux_id');
    }
    public function getSelectedTravaux(){
        return $this->hasMany(ControleSurSiteTravaux::class, 'controle_sur_site_id', 'id');
    }

    public function getMes(){
        return $this->belongsTo(Control::class, 'Société_MES', 'id');
    }
}
