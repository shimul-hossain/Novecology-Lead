<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getNavigation(){
        return $this->belongsTo(Navigation::class, 'navigation_id', 'id');
    }
    public function getNonNavigation(){
        return $this->belongsTo(NonNavigation::class, 'name', 'route');
    }
}
