<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBareme extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getBareme(){
        return $this->belongsTo(BaremeTravauxTag::class, 'barame_id', 'id');
    }
}
