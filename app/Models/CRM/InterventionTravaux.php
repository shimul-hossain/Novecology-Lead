<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionTravaux extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProjectControl(){
        return $this->belongsToMany(ProjectControlPhoto::class, 'intervention_travaux_project_controls', 'travaux_id', 'project_control_id');
    }

    public function getTravaux(){
        return $this->belongsTo(BaremeTravauxTag::class, 'travaux_id', 'id');
    }
}
