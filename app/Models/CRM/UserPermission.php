<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Get Navigation 
    public function getNavigation(){
        return $this->belongsTo(Navigation::class, 'navigation_id', 'id');
    }
    public function getNonNavigation(){
        return $this->belongsTo(NonNavigation::class, 'route', 'route');
    }
}
