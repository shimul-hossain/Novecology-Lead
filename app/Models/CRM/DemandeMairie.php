<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeMairie extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getTravaux(){
        return $this->belongsTo(BaremeTravauxTag::class, 'Demande_de_travaux', 'id');
    }
}
