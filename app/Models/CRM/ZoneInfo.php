<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getZone(){
        return $this->belongsTo(Zone::class, 'zone_id', 'id');
    }
}
