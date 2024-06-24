<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediatheque extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getCategory(){
        return $this->belongsTo(MediathequeCategory::class, 'category_id', 'id');
    }
}
