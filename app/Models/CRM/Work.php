<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTag(){
        return $this->belongsTo(TravauxTag::class, 'tag', 'id');
    }

    public function LeadBareme(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'lead_work_baremes', 'work_id', 'barame_id');
    }
    // public function LeadBaremeList(){
    //     return $this->hasMany(LeadWorkBareme::class, 'work_id', 'id');
    // }
    // public function AllBareme(){
    //     return $this->belongsToMany(LeadWork::class, 'lead_work_baremes', 'work_id', 'barame_id');
    // }
    public function LeadTravax(){
        return $this->belongsToMany(Scale::class, 'lead_work_travauxes', 'work_id', 'travaux_id');
    }
}
