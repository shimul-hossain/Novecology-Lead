<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDefaultHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function getProjectHeader(){
        return $this->belongsTo(ProjectHeader::class, 'header_id', 'id');
    }
}
