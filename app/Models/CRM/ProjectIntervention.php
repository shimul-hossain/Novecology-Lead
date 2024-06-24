<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIntervention extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getTravaux(){
        return $this->hasMany(InterventionTravaux::class, 'intervention_id', 'id');
    }

    public function getChargeDeEtude(){
        return $this->belongsTo(User::class, 'Chargé_dapostropheétude', 'id');
    }
    public function getTechnicalCommercial(){
        return $this->belongsTo(User::class, 'Prévisiteur_TechnicohyphenCommercial', 'id');
    }
    public function previsitor(){
        return $this->belongsTo(User::class, 'Contre_prévisiteur', 'id');
    }
    public function technicienSav(){
        return $this->belongsTo(User::class, 'Technicien_SAV', 'id');
    }
    public function getTechnicien(){
        return $this->belongsTo(User::class, 'Technicien', 'id');
    }
    public function installerTechnique(){
        return $this->belongsTo(User::class, 'Installateur_technique', 'id');
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getProject(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }

    public function getStatusPlanning(){
        return $this->belongsTo(StatusPlanningIntervention::class, 'Statut_planning', 'name');
    }

    public function technicalRefree(){
        return $this->belongsTo(TechnicalReferee::class, 'Réfèrent_technique', 'id');
    }
    
}

