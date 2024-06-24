<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subvention extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function agent(){
        return $this->belongsTo(Agent::class, 'mandataire', 'id');
    }
    public function travaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'subvetion_travauxes', 'subvention_id', 'travaux_id');
    }

    public function getProject(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }
}
