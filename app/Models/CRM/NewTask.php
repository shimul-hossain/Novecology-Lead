<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewTask extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProject(){
        return $this->belongsTo(NewProject::class, 'project_id','id');
    }
    public function getLead(){
        return $this->belongsTo(LeadClientProject::class, 'project_id','id');
    }
}
