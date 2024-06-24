<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFacturation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getDelegataire(){
        return $this->belongsTo(Delegate::class, 'Délégataire', 'id');
    }

    public function getAgent(){
        return $this->belongsTo(Agent::class, 'Mandataire', 'id');
    }

    public function getBanque(){
        return $this->belongsTo(Banque::class, 'Banque', 'id');
    }

    public function facturationEntreprise(){
        return $this->belongsToMany(Installer::class, 'facturation_entreprises', 'facturation_id', 'entreprise_id');
    }
}
