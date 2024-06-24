<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProject extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getSubStatus(){
        return $this->belongsTo(ProjectSubStatus::class, 'project_sub_status', 'id');
    }

    public function projectStatus(){
        return $this->belongsTo(ProjectNewStatus::class, 'project_label', 'id');
    }

    public function projectGestionnaire(){
        return $this->belongsTo(User::class, 'project_gestionnaire', 'id');
    }

    public function subvention(){
        return $this->hasMany(Subvention::class, 'project_id', 'id');
    }

    public function getTicket(){
        return $this->hasMany(Ticketing::class, 'project_id', 'id');
    }

    public function ProjectBareme(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'project_baremes', 'project_id', 'barame_id');
    }

    public function ProjectTravaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'project_travauxes', 'project_id', 'travaux_id');
    }
    public function ProjectTravauxTags(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'project_travaux_tags', 'project_id', 'tag_id');
    }

    public function projectTagItem(){
        return $this->hasMany(ProjectTag::class, 'project_id', 'id')->orderBy('tag_id', 'asc');
    }

    public function projectDocumentControl(){
        return $this->hasMany(ProjectDocumentControl::class, 'project_id', 'id');
    }

    public function getIntervention(){
        return $this->hasMany(ProjectIntervention::class, 'project_id', 'id')->orderBy('id', 'desc');
    }
    public function getInterventionWithNoOrder(){
        return $this->hasMany(ProjectIntervention::class, 'project_id', 'id');
    }

    public function getTagProduct(){
        return $this->hasMany(ProjectTagProduct::class, 'project_id', 'id');
    }

    public function getFile(){
        return $this->hasMany(ProjectFile::class, 'project_id', 'id');
    }

    public function getDepot(){
        return $this->hasMany(BanqueDepot::class, 'project_id', 'id')->orderBy('id', 'desc');
    }
    public function getAudit(){
        return $this->hasMany(Audit::class, 'project_id', 'id')->orderBy('id', 'desc');
    }

    public function getSubventions(){
        return $this->hasMany(Subvention::class, 'project_id', 'id')->orderBy('id', 'desc');
    }

    public function getProjectTelecommercial(){
        return $this->belongsTo(User::class, 'project_telecommercial', 'id');
    }

    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }

    public function getControleQuality(){
        return $this->hasMany(ControleQuality::class, 'project_id',' id');
    }

    public function getFacturation(){
        return $this->hasMany(ProjectFacturation::class, 'project_id','id')->orderBy('id', 'desc');
    }
    public function getFacturationWithNoOrder(){
        return $this->hasMany(ProjectFacturation::class, 'project_id','id');
    }

    public function getGestion(){
        return $this->hasMany(ProjectGestion::class, 'project_id','id')->orderBy('id', 'desc');
    }
    public function getGestionWithNoOrder(){
        return $this->hasMany(ProjectGestion::class, 'project_id','id');
    }

    public function getSupplier(){
        return $this->belongsTo(Fournisseur::class, '__tracking__Fournisseur_de_lead', 'id');
    }

    public function callbackHistory(){
        return $this->hasMany(CallbackHistory::class, 'feature_id', 'id')->where('type', 'project');
    }

    public function primaryTax(){
        return $this->hasOne(ProjectTax::class, 'project_id', 'id')->where('primary', 'yes');
    }

    public function allTaxs(){
        return $this->hasMany(ProjectTax::class, 'project_id', 'id')->orderBy('primary', 'asc');
    }
    
    public function getDemandes(){
        return $this->hasMany(DemandeMairie::class, 'project_id', 'id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getLead(){
        return $this->belongsTo(LeadClientProject::class, 'lead_id', 'id');
    }

    public function projectSecondTable(){
        return $this->hasOne(NewProject2::class, 'project_id', 'id');
    }

    public function allCommecnts(){
        return $this->hasMany(ProjectComment::class, 'project_id', 'id');
    }
    public function pinComment(){
        return $this->hasOne(ProjectComment::class, 'project_id', 'id')->where('pin_status', 1);
    }
    public function getClient(){
        return $this->belongsTo(NewClient::class, 'client_id', 'id');
    }
}
