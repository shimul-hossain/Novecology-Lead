<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediathequeCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getMediatheque(){
        return $this->hasMany(Mediatheque::class, 'category_id', 'id');
    }
}
