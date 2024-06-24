<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectControlPhoto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getTag(){
        return $this->belongsTo(BaremeTravauxTag::class, 'tag_id', 'id');
    }
}
