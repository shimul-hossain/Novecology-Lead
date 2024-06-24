<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTax extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }

    public function getProject(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }
    
    public function getDeclarant(){
        return $this->hasMany(ProjectTaxDeclarant::class, 'tax_id', 'id');
    }
}
