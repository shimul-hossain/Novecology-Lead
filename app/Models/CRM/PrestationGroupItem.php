<?php

namespace App\Models\CRM;

use App\Models\CRM\Benefit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrestationGroupItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPrestation(){
        return $this->belongsTo(Benefit::class, 'prestation_id', 'id');
    }
}
