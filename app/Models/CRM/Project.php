<?php

namespace App\Models\CRM;

use App\Models\User;
use App\Models\CRM\WorkDone;
use App\Models\CRM\DevisSidebar;
use Illuminate\Database\Eloquent\Model;
use App\Models\CRM\InterventionInstallation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];






 

     public function get_report()
     {
         return $this->hasOne('\App\Models\CRM\Rapport', 'project_id', 'id');
     }
     public function get_second_report()
     {
         return $this->hasOne('\App\Models\CRM\SecondReport', 'project_id', 'id');
     }
     public function get_info()
     {
         return $this->hasOne('\App\Models\CRM\Information', 'project_id', 'id');
     }
     public function get_intervention()
     {
         return $this->hasOne('\App\Models\CRM\Intervention', 'project_id', 'id');
     }

     public function getStatus(){
        return $this->belongsTo(ProjectTableStatus::class, 'user_status', 'id');
    }  

    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function subvention(){
        return $this->hasMany(Subvention::class, 'project_id', 'id');
    }

    public function sidebar(){
        return $this->hasOne(DevisSidebar::class, 'project_id', 'id');
    }

    public function getOperation(){
        return $this->hasMany(WorkDone::class, 'project_id', 'id');
    }
    
    public function getPrestations(){
        return $this->hasMany(AdditionalProduct::class, 'project_id', 'id');
    }

    public function statusPlanningInstallation(){
        return $this->hasOne(InterventionInstallation::class, 'project_id', 'id');
    }
    public function projectInstaller(){
        return $this->belongsToMany(User::class, 'project_equipe_users', 'project_id', 'user_id');
    }

    public function getGestionnaire(){
        return $this->hasMany(ProjectGestionnaire::class, 'project_id', 'id');
    }

}
