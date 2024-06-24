<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNewStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProjects(){
        return $this->hasMany(NewProject::class, 'project_label', 'id')->where('deleted_status', 0);
    }
    public function getSubStatus(){
        return $this->belongsToMany(ProjectSubStatus::class, 'project_status_sub_statuses', 'status_id', 'sub_status_id')->orderBy('order','asc');
    }
}
