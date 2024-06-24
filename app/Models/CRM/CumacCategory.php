<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CumacCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCumac(){
        return $this->hasMany(Cumac::class, 'category_id', 'id');
    }
}
