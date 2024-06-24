<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadWorkBareme extends Model
{
    use HasFactory;
    protected $guareded = ['id'];
    public function getBareme(){
        return $this->belongsTo(BaremeTravauxTag::class, 'barame_id', 'id');
    }
}
