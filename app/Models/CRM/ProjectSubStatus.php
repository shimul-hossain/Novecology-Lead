<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProjects(){
        return $this->hasMany(NewProject::class, 'project_sub_status', 'id')->where('deleted_status', 0);
    }

    public function getStatus(){
        return $this->belongsToMany(ProjectNewStatus::class, 'project_status_sub_statuses', 'sub_status_id', 'status_id');
    }
    
}
