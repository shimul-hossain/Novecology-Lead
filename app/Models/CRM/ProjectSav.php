<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSav extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getProject (){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
