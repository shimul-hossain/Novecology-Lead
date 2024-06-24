<?php

namespace App\Models;

use App\Models\CRM\BaremeTravauxTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerForm extends Model
{
    use HasFactory;
    protected $guarded =  ['id'];

    public function getTravaux(){
        return $this->belongsTo(BaremeTravauxTag::class, 'travaux', 'id');
    }
}
