<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automatisation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
