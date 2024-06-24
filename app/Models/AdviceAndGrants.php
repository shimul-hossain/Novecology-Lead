<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviceAndGrants extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo(GrantCategory::class, 'category_id', 'id');
    }
}
