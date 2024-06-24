<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campagnetype extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    
    public function getLead(){
        return $this->hasMany(LeadClientProject::class, '__tracking__Type_de_campagne', 'name')->where('lead_deleted_status', 0);
    }

    public function getProjects(){
        return $this->hasMany(NewProject::class, '__tracking__Type_de_campagne', 'name')->where('deleted_status', 0);
    }
}
