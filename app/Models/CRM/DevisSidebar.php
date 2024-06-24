<?php

namespace App\Models\CRM;

use App\Models\CRM\Deal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevisSidebar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getDeal(){
        return $this->belongsTo(Deal::class, 'deal', 'id');
    }
    public function getEnergyType(){
        return $this->belongsTo(EnergyType::class, 'type_energy_id', 'id');
    }
}
