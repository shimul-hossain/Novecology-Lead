<?php

namespace App\Models\CRM;

use App\Models\CRM\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTableStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getProject(){
        return $this->hasMany(Project::class, 'user_status', 'id');
    }
}
