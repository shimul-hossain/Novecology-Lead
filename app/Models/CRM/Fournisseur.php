<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getLead(){
        return $this->hasMany(LeadClientProject::class, '__tracking__Fournisseur_de_lead', 'id')->where('lead_deleted_status', 0);
    }

    public function getProjects(){
        return $this->hasMany(NewProject::class, '__tracking__Fournisseur_de_lead', 'id')->where('deleted_status', 0);
    }
}
