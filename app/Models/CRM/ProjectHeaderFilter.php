<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded =  [];

    public function getHeader(){
        return $this->belongsTo(ProjectHeader::class, 'project_header_id', 'id');
    }
}
