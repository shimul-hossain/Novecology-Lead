<?php

namespace App\Models\CRM;

use App\Models\CRM\Scale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravauxList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getBareme(){
        return $this->belongsTo(Scale::class, 'bareme_id', 'id');
    }
}
