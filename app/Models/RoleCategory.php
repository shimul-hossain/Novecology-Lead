<?php

namespace App\Models;

use App\Models\CRM\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function role(){
        return $this->hasMany(Role::class, 'category_id', 'id');
    }
}


