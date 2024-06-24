<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function uploadedBy(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
